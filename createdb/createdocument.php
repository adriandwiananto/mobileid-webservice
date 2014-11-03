<?php
require('../rb.php');

$id_number_legal="3271231008950005";
$id_number="1231230509890001";

/*
function hitunghashdata($file) {
    $algo = "sha256";
    return hash_file($algo,$file);
}

$file = '../documents/'.$id_number.'.samples.pdf';
echo hitunghashdata($file);
*/

R::setup('sqlite:../database/'.$id_number.'.s3db');

/*
$updating_index = 1;
//$doc = R::dispense('docsigning');
//overwriting database
$doc = R::load('docsigning',$updating_index);

$doc->legal = $id_number_legal;
$doc->title = 'samples.pdf';
$doc->content = 'pdf contoh';
$doc->hash = '36547f22533af1d676e8beb4de56a206fff397481bf95fc9c95924cd8184ff8a';
$doc->signature = null;
$doc->signer = '1231230509890001';
$doc->modified = R::isoDateTime();

$id = R::store( $doc );

echo $numOfDoc = R::count('docsigning');
*/

//nomor database mulai dari 1.
//$doc = R::load('docsigning',1);
//echo $doc["signature"];

$doc = R::load('docsigning',1);
$doc->hash = '36547f22533af1d676e8beb4de56a206fff397481bf95fc9c95924cd8184ff8a';
$doc->signature = null;
$id = R::store( $doc );
echo $doc["signature"];
?>