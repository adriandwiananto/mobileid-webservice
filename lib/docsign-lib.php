<?php

function hitunghashfile($file) {
    $algo = "sha256";
    return hash_file($algo,$file);
}

function hitunghashdata($string) {
    $algo = "sha256";
    return hash($algo,$string);
}

function hash_compare($a, $b) {
    if (!is_string($a) || !is_string($b)) { 
        return false; 
    } 
    $len = strlen($a); 
    if ($len !== strlen($b)) { 
        return false; 
    } 
    $status = 0; 
    for ($i = 0; $i < $len; $i++) { 
        $status |= ord($a[$i]) ^ ord($b[$i]); 
    } 
    return $status === 0; 
}

function checktodatabase($id_number,$id,$filename,$hash) {
    //belum dipakai
    
    //pastikan data dari CA dan database sama
    R::setup('sqlite:./database/'.$id_number.'.s3db');
    $docsig = R::load('docsigning',$id);
    $databasename = $docsig["title"];
    $databasehash = $docsig["hash"];
    if ( (hash_compare($hash,$databasehash)) && (hash_compare($filename,$databasename))) {
       //return true jika nama file dan hash benar
       return 1; 
    }
    else return 0;
}

function sendfile($data,$target_url) {
    //This needs to be the full path to the file you want to send.
	echo $file_name_with_full_path = realpath('./documents/'.$data["userid"].'/'.$data["title"].'.'.$data["id"]);
	$data['file_contents'] = '@'.$file_name_with_full_path;
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$target_url);
	curl_setopt($ch, CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result=curl_exec ($ch);
	curl_close ($ch);
	$result;
}

function sendencodedpost($url,$data) {
    $options = array(
        'http' => array(
            'method'  => 'POST',
            'content' => http_build_query($data),
            'header'=>  "Content-type: application/x-www-form-urlencoded"
          )
    );

    $context     = stream_context_create($options);
    $result      = file_get_contents($url, false, $context);
    $response    = json_decode($result, true);
    return $response;
    // return $result;
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


?>