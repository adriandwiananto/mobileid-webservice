<?php
require('../rb.php');

$id_number = "1231230509890005";

$dbfilepath = "../database/".$id_number.".s3db";
unlink($dbfilepath);
//R::wipe( 'approval' );
echo "Tabel approval ".$id_number." dihapus";
?>