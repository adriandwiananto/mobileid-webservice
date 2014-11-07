<?php
require('../rb.php');
require('../lib/docsign-lib.php');
require('../lib/docsigningdb-lib.php');

$legal = "1231230509890005";

R::addDatabase('docsigningdb','sqlite:../database/docsigning.s3db');
R::addDatabase('legaldb','sqlite:../database/'.$legal.'.s3db');
R::selectDatabase('docsigningdb');

//$list = carilegal($legal,2);
//var_dump($list);

$pid = "331366165";
$result = buatapproval($pid);

?>