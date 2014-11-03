<?php
require_once('rb.php');
require_once('./lib/docsigningdb-lib.php');
require_once('./lib/docsign-lib.php');

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

$pid = $_POST["pid"];
$docindex = caridocindex($pid);
$doc = loaddocdb($docindex);
//hapus entry docsigner
R::trash( $doc );

$findid  = R::find('signer',' pid = ? ', [ $pid ] );
foreach($findid as $id_index => $value) {
        $index = $id_index;
        $signer = loadsignerdb($index);
        R::trash( $signer );
}

echo "Entry ".$doc->title."dihapus";

//R::wipe( 'signer' );

header("Location: document-list.php");

?>