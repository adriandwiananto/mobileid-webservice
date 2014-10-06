<?php
require('rb.php');
// if(isset($_POST["websignature"])){
// 	echo '{"Success":true}';
// }else{
// 	echo "no websignature";
// }

// $setor = R::dispense('approval');
// $setor->title = 'Bolos';
// $setor->content = 'Izin bolos karena males kerja';
// $setor->hash = '494874d6f13caa86f69b0a59c7dce6312ea1066b012ea1b5afd6da905843f913';
// R::store($setor);

$id_number = $_POST["userid"];
$updating_index = $_POST["id"];
$websignature = $_POST["websignature"];
// echo $id_number."\n".$websignature;
R::setup('sqlite:./database/'.$id_number.'.s3db');
if(isset($_POST["websignature"])){
    $updating_index = $_POST["id"];
    $websig = R::load('approval',$updating_index);
	$websig->signature = $websignature;
	$websig->signer = $id_number;
	R::store($websig);
	echo '{"Success":true}';
} else {
	echo '{"Success":false}';
}

?>