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

if ($sendquery["STATUS"]["Success"] == true) {
    $pid = $sendquery["STATUS"]["PID"];
}

sleep(2);

?>
<html>
	<head>
		<script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <script type="text/javascript">
            function getContent(timestamp)
            {
                var file_id = '<?php echo "$id_number.$pid"; ?>';
                $.ajax(
                    {
                        type: 'GET',
                        url: "http://localhost/ca/mobileid-CA/tanyaidentitas/poll-server.php?timestamp="+timestamp+"&file_id="+file_id,
                        success: function(data){
                            // put result data into "obj"
                            var obj = jQuery.parseJSON(data);
                            console.log(obj);
                            // put the data_from_file into #response
                            if(obj.data_from_file[0] === "Menunggu konfirmasi.."){
	                            $('#response').html(obj.data_from_file.join("<br/>"));
	                            // call the function again, this time with the timestamp we just got from server.php
	                            getContent(obj.timestamp);
	                        } else {
	                        	$('#response').html("Log in berhasil!");
	                        	//delay >> redirect
	                        }
                        }
                    }
                );
            }
            // initialize jQuery
            $(function() {
                getContent(0);
            });
        </script>
	</head>
	<body>
		<h1>Memproses autentikasi:</h1>
        <div id="response"></div>
	</body>
</html>