<?php
require('../rb.php');

R::setup('sqlite:../database/docsigning.s3db');

function cariuserclass($id_number) {
    $findid  = R::find('userclass',' id_number = ? ', [ $id_number ] );
    foreach($findid as $id_index => $value) {
        $result = $findid[$id_index]->user_class;
    }
    return array($id_index,$result);
}

function loaduserdb($index) {
    return $user = R::load('userclass',$index);
}

function loaddocdb($index) {
    return $doc = R::load('doclist',$index);
}

function loadsignerdb($index) {
    return $doc = R::load('signer',$index);
}

function caridocindex($pid) {
    $findid  = R::find('doclist',' pid = ? ', [ $pid ] );
    foreach($findid as $id_index => $value) {
        $index = $id_index;
    }
    return $index;
}

function caripiddokumen() {
    $pidtrylimit = 100;
    $i=0; //var sukses/belum sukses
    $j=0; //var jumlah retry
    
    while ($i<1 && $j<$pidtrylimit) {
        $pid=rand();
        $docpid  = R::find('doclist',' pid LIKE ? ', [ $pid ] );
        
        if (count($docpid) == 0) {
            //echo "Catat sebagai proses baru. PID = $pid".PHP_EOL;
            $i++;
            $result=1;
        }
        if ($j>$pidtrylimit-2) {
            echo "tidak mendapat PID unik";
            $result=0;
        }
        $j++;
    }
    return array ($result,$pid);
}

function carilegal($id_number) {
    return $docpid  = R::find('doclist',' legal LIKE ? ', [ $id_number ] );
}

function carisigner($id_number) {
    return $docpid  = R::find('signer',' signer_id LIKE ? ', [ $id_number ] );
}

function buatentrysigner($doc,$id_number) {
    $signer = R::dispense('signer');
    $signer->pid = $doc->pid;
    $signer->own = $doc->legal;
    $signer->signer_id = $id_number;
    $signer->orig_hash = $doc->hash;
    $signer->signed_hash = null;
    $signer->signature = null;
    R::store($signer);
}

$legal="1231230509890002";
$signer1="1231230509890003";
$signer2="1231230509890004";

//$kelasuserlegal = cariuserclass($legal);
//$kelasuserlegal[1];

//$userlegal = loaduserdb($kelasuserlegal[0]);

/*
$caripid = caripiddokumen();
if ($caripid[0]) {
    $doc = R::dispense('doclist');
    $doc->legal = $userlegal->id_number;
    $doc->title = 'samples.pdf';
    $doc->content = 'pdf contoh';
    $doc->hash = '36547f22533af1d676e8beb4de56a206fff397481bf95fc9c95924cd8184ff8a';
    $doc->docstatus = 0;
    $doc->pid = $caripid[1];
    $doc->modified = R::isoDateTime();
    createdocdb($doc);
    R::store($doc);
}
*/

//$doc = loaddocdb(1);
//var_dump($doc);

/*
$doclist = carilegal($legal);
foreach($doclist as $doc) {
    //tampilkan property doc dari legal
    echo $doc->id;
}
*/

//buat tabel signer
//buatentrysigner($doc,$signer1);
//buatentrysigner($doc,$signer2);

//$doc = R::findAll( 'signer' );

//$doc = loadsignerdb(1);
//echo $indexdoc = caridocindex($doc->pid);
//$doc->signer_id = "1231230509890001";
//R::store($doc);
//echo $doc;

function carisignerdaripid($id) {
    return $doc  = R::find('signer',' own LIKE ? ', [ $id ] );
}

$pid = "1002981287";
$id = "1231230509890002";
$listsigner = carisignerdaripid($id);
var_dump($listsigner);
?>