<?php
//jika belum diload page php
//R::setup('sqlite:../database/docsigning.s3db');

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

function caridocdgnpid($pid) {
    $findid  = R::find('doclist',' pid = ? ', [ $pid ] );
        foreach($findid as $id_index => $value) {
        $result = $findid[$id_index];
    }
    return $result;
}

function caridocindex($pid) {
    $findid  = R::find('doclist',' pid = ? ', [ $pid ] );
    foreach($findid as $id_index => $value) {
        $index = $id_index;
    }
    if (isset($index)) {
        return $index;
    } else return 0;
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

function carilegal($id_number,$status) {
    return $docpid = R::find("doclist","legal=? AND docstatus=?",array($id_number,$status));
}

function carilegaldanverifieddoc($id_number) {
    return $docpid = R::find("doclist","legal=? AND docstatus > 0",[ $id_number ]);
}

function carisigner($id_number) {
    return $docpid  = R::find('signer',' signer_id LIKE ? ', [ $id_number ] );
}

function carisignerdaripid($pid) {
    return $doc  = R::find('signer',' pid LIKE ? ', [ $pid ] );
}

function ceksigner($pid,$id_number) {
    return $doc = R::find("signer","pid=? AND signer_id=?",array($pid,$id_number));
}

function buatentrysigner($doc,$id_number,$askCAid) {
    $signer = R::dispense('signer');
    $signer->pid = $doc->pid;
    $signer->ca_id = $askCAid;
    $signer->own = $doc->legal;
    $signer->signer_id = $id_number;
    $signer->orig_hash = $doc->hash;
    $signer->signed_hash = null;
    $signer->signature = null;
    R::store($signer);
}

function cekjumlahsignature($pid) {
    $signerlist = carisignerdaripid($pid);
    $signercount = count($signerlist);
    //var_dump($signerlist);
    $sigcount=0;
    foreach($signerlist as $signer) {
        if (isset($signer->signature)) {
            $sigcount++;
        }
    }
    if ($sigcount == $signercount) {
        //jumlah sama, tandatangan lengkap
        return 1;
    } else return 0;
}

?>