<?php
require('rb.php');
session_start();

if(isset($_SESSION["no_ktp"])){
	$id_number = $_SESSION["no_ktp"];
	R::setup('sqlite:./database/'.$id_number.'.s3db');
	if(isset($_POST["clicked"])){
	    $clicked_index = $_POST["clicked"];
	    echo R::load('docsigning',$clicked_index);
	}

	if(isset($_POST["docsign"])){
		$index = $_POST["id"];
		$bean = R::load('docsigning',$index);
		$bean->signature = '';
		$bean->signer = '';
        	$bean->modified = R::isoDateTime();
		R::store($bean);
		echo "done!";
	}
}
?>