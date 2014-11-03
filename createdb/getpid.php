<?php
require_once('../rb.php');
require_once('../lib/docsigningdb-lib.php');
require_once('../lib/docsign-lib.php');
include('../addr-path.php');

function sendpost($url,$data) {
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => json_encode( $data ),
            'header'=>  "Content-Type: application/json\r\n" .
                        "Accept: application/json\r\n"
          )
    );

    $context     = stream_context_create($options);
    $result      = file_get_contents($url, false, $context);
    $response    = json_decode($result, true);
    return $response;
}

R::setup('sqlite:../database/docsigning.s3db');

$legal = "1231230509890002";
$signerid = "1231230509890001";

$legallist = carilegal($legal,0);
//echo json_encode($legallist);

$request = json_decode(file_get_contents("../template.json"), true);
$request["ASK"]["NIK"] = $signerid;

$sendquery  = sendpost($CAaddr,$request);
echo $askCAid = $sendquery["STATUS"]["PID"]; //simpan CA PID untuk lihat identitas
        
        //$signervar = "docsigner".$p;
        
        //$signerid = $_POST[$signervar];
        //buatentrysigner($doc,$signerid,$askCAid);
        
?>