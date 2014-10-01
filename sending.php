<?php
// require_once('../lib/filemanipulation.php');
include('./addr-path.php');

if(isset($_POST["no_ktp"])){
    $id_number = $_POST["no_ktp"];
}
else{
    header("Location: ./");
    die();
}

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
?>

<html>
    <head>
        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
        <!--<script type="text/javascript" src="client.js"></script>-->
        <script type="text/javascript">
            // function getContent(file_id,timestamp)
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
                            // put the data_from_file into #response
                            $('#response').html(obj.data_from_file.join("<br/>"));
                            // call the function again, this time with the timestamp we just got from server.php
                            getContent(obj.timestamp);
                        }
                    }
                );
            }
            // initialize jQuery
            $(function() {
                // var pid = '<?php echo $id_number.$pid;?>';
                // $('#response').html(pid);
                // getContent(pid,0);
                getContent(0);
            });
        </script>
    </head>
    <body>
        <h1>Response from server:</h1>
        <div id="response"></div>
    </body>
</html>