<?php
require_once('rb.php');
require_once('addr-path.php');
require_once('./lib/docsigningdb-lib.php');
require_once('./lib/docsign-lib.php');

$id_number = $_POST["userid"];

$uploaddir = realpath('./') . '/documents/'.$id_number.'/signed/';

if (!file_exists($uploaddir)) {
    mkdir($uploaddir, 0755, true);
}

$uploadfile = $uploaddir . basename($_FILES['file_contents']['name']);

if (move_uploaded_file($_FILES['file_contents']['tmp_name'], $uploadfile)) {
	// echo "File is valid, and was successfully uploaded.\n";
	$filename = basename($_FILES['file_contents']['name']);
	
    $pid = $_POST["id"];
    $filename = $_POST["title"];
    $filehash = $_POST["hash"];
    $docsignature = $_POST["docsignature"];
    
    // cek terlebih dahulu ke database
    //if ( ($_POST["info"]="docsign") && (checktodatabase($id_number,$updating_index,$filename,$filehash)) ) {
        //jika benar, perbarui database
        R::addDatabase('docsigningdb','sqlite:./database/docsigning.s3db');
        R::selectDatabase('docsigningdb');

        $docsig = reset(ceksigner($pid,$id_number));
        $docsig->signed_hash = $filehash;
    	$docsig->signature = $docsignature;
        $id = R::store( $docsig );
        
        //cek apakah signature lengkap
        $sigstatus = cekjumlahsignature($pid);
        if ($sigstatus) {
            $docindex = caridocindex($pid);
            $doc = loaddocdb($docindex);
            $doc->docstatus=2;
            R::store($doc);
            
            //buat approval
            $legal = $doc->legal;
            R::addDatabase('legaldb','sqlite:./database/'.$legal.'.s3db');
            $result = buatapproval($pid);
            
            //kirim pesan notifikasi
            $senddata["id"] = $legal;
            $senddata["content"] = "Dokumen ".$filename." dengan berita ".$doc->content." sudah selesai ditandatangan";
            sendencodedpost($CAdocsignconfirm,$senddata);
        }
    //}
    //else echo "Header invalid";
    
} else {
	echo "Possible file upload attack!\n";
}

?>