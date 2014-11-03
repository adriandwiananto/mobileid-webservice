<?php
require_once('../rb.php');
require_once('../lib/docsigningdb-lib.php');
require_once('../lib/docsign-lib.php');
include('../addr-path.php');

R::setup('sqlite:../database/docsigning.s3db');

$legal = "1231230509890002";
$signerid = "1231230509890001";
$pid = "1569517552";

$signerlist = carisignerdaripid($pid);
$signercount = count($signerlist);
//var_dump($signerlist);
$sigstatus = cekjumlahsignature($pid);
        if ($sigstatus) {
            $docindex = caridocindex($pid);
            $doc = loaddocdb($docindex);
            $doc->docstatus=2;
            var_dump($doc);
            //R::store($doc);
        }
?>