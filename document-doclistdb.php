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

R::setup('sqlite:database/docsigning.s3db');

if ($_POST["intend"] == "changestatus") {
    $pid = $_POST["pid"];
    $intendedstatus = $_POST["status"];
    $doc = caridocdgnpid($pid);
    //status boleh diganti hanya oleh legal
    if ((isset($doc->legal)) &&($id_number == $doc->legal)) {
        $doc->docstatus = $intendedstatus;
        R::store($doc);
        echo "status diubah";
    }
    var_dump($doc);
}

header("Location: ./document-list.php");

?>