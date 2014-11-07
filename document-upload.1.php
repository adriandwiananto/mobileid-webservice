<?php
require_once('rb.php');
require_once('./lib/docsigningdb-lib.php');
require_once('./lib/docsign-lib.php');
include('./addr-path.php');

session_start();
if($_SESSION["userclass"]==2){
    $id_number = $_SESSION["no_ktp"];
    $nama = $_SESSION["nama"];
    $userclass = $_SESSION["userclass"];
    $textuserclass = $_SESSION["textuserclass"];
    
}
else{
    header("Location: ./");
    die();
}

//var_dump($_POST);

R::setup('sqlite:database/docsigning.s3db');

$target_dir = "documents/".$id_number."/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
$uploadOk=1;

if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
    $message = "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
} else {
    $message = "Sorry, there was an error uploading your file.";
}

$filename = $_FILES["uploadFile"]["name"];
$dochash = hitunghashfile($target_dir);
$content = $_POST["doccontent"];
$signercount = $_POST["signercount"];

$caripid = caripiddokumen();

if ($caripid[0]) {

    $doc = R::dispense('doclist');
    $doc->legal = $id_number;
    $doc->title = $filename;
    $doc->content = $content;
    $doc->hash = $dochash;
    $doc->docstatus = 0;
    $doc->pid = $caripid[1];
    $doc->modified = R::isoDateTime();
    R::store($doc);
    //echo "database dibuat";

    $final_file = $target_dir.".".$doc->pid;
    rename($target_dir,$final_file);

    for ($p=1;$p<=$signercount;$p++) {
        $signervar = "docsigner".$p;
        $signerid = $_POST[$signervar];
        
        //kirim permintaan identitas
        $request = json_decode(file_get_contents("./template.json"), true);
        $request["ASK"]["NIK"] = $signerid;
        $sendquery  = sendpost($CAaddr,$request);
        $askCAid = $sendquery["STATUS"]["PID"]; //simpan CA PID untuk lihat identitas

        buatentrysigner($doc,$signerid,$askCAid);
        
        $copy_dir = "documents/".$signerid."/";
        
        //cek jika folder belum ada
        if (!file_exists($copy_dir)) {
            mkdir($copy_dir, 0755, true);
        }
        
        $copy_dir = $copy_dir . basename( $_FILES["uploadFile"]["name"]).".".$doc->pid;
        copy($final_file, $copy_dir);
        //echo "signer dibuat";
    }
}
//rename file dengan format file+pid

header("Location: ./document-verify-list.php");

?>