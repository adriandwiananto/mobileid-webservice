<?php
require('rb.php');
session_start();

if(isset($_SESSION["no_ktp"])){
	$id_number = $_SESSION["no_ktp"];
	R::setup('sqlite:./database/'.$id_number.'.s3db');
	if(isset($_POST["clicked"])){
	    $clicked_index = $_POST["clicked"]+1;
	    echo R::load('approval',$clicked_index);
	}

	if(isset($_POST["websign"])){
		$index = $_POST["id"];
		$bean = R::load('approval',$index);
		$bean->signature = '';
		$bean->signer = '';
		R::store($bean);
		echo "done!";
	}
}
?>