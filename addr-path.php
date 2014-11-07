<?php

// $CAglobaladdr = "http://localhost/ca/mobileid-CA/";
$CAglobaladdr = "https://mobileid-ca-c9-bramleksono.c9.io/";

// $SIaddr = "http://192.168.2.101/SI/mobileid-SI/";
$SIaddr = "https://mobileid-si-c9-bramleksono.c9.io/";

// $Webaddr = "http://localhost/webservice/";
$Webaddr = "https://mobileid-webservice-c9-bramleksono.c9.io/";

$CAaddr = $CAglobaladdr."tanyaidentitas/daftarrequestCA.php";
$Polladdr = $CAglobaladdr."tanyaidentitas/poll-server.php";
$SignWebAddr = $CAglobaladdr."tanyaidentitas/signweb.php";
$CAdocsignaddr = $CAglobaladdr."tanyaidentitas/daftardocsign.php";
$CAaskuserinitial = $CAglobaladdr."tanyaidentitas/tanyainisial.php";
$CAdocsignconfirm = $CAglobaladdr."tanyaidentitas/daftarkonfirmasidocsignCA.php";


$SignDocAddr = $SIaddr."terimadocfile.php";

$DBWriterPath = $Webaddr."writedbdata.php";
$DocSenderPath = $Webaddr."docsign-sender.php";
$DocReceiverPath = $Webaddr."docsign-receiver.php";
?>