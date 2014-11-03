<?php
/**
 * Setelah mendapat hmac yang benar dari device, webservice mengirim pdf yang akan ditandatangan ke docfile-receive.php di SI
 * 
 */
 
require_once('rb.php');
require_once('./lib/docsign-lib.php');
include('./addr-path.php');

$id_number = $_POST["userid"];
$updating_index = $_POST["id"];
$filename = $_POST["title"];
$filehash = $_POST["hash"];
// echo $id_number."\n".$websignature;

// cek terlebih dahulu ke database
if ($_POST["info"]="docsign") {
    //ubah link callback
    $_POST["callbackpath"] = $DocReceiverPath;
    //kirim file
    $result = sendfile($_POST,$SignDocAddr);
	echo '{"Success":true}';
} else {
	echo '{"Success":false}';
}

?>