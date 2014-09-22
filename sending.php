<?php
// require_once('../lib/filemanipulation.php');

$id_number = $_POST["no_ktp"];
$CAaddr = "http://localhost/ca/mobileid-CA/tanyaidentitas/daftarrequestCA.php";

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

$request = json_decode(file_get_contents("template.json"), true);
$request["ASK"]["NIK"] = $id_number;
$sendquery  = sendpost($CAaddr,$request);

foreach ($sendquery as $key => $value) {
    echo "Key: $key; Value: $value"; 
}

if ($sendquery["STATUS"]["Success"] == true) {
    //catat query di file pid
    $pid = $sendquery["STATUS"]["PID"];
    // $daftar = catatpid($IDNumber,$pid,$postdata);
    //kirim data ke SI
    // echo "Permintaan berhasil";
}
?>

<html>
    <head>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript" src="client.js"></script>
    </head>
    <body>
        <h1>Response from server:</h1>
        <div id="response"><?php echo "$id_number.$pid";?></div>
    </body>
</html>