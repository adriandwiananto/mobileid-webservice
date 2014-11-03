<?php
session_start();
if(isset($_SESSION["no_ktp"])){
    $id_number = $_SESSION["no_ktp"];
    $nama = $_SESSION["nama"];
}
else{
    header("Location: ./");
    die();
}

$target_dir = "documents/".$id_number."/";

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0755, true);
}

$target_dir = $target_dir . basename( $_FILES["uploadFile"]["name"]);
$uploadOk=1;

if (move_uploaded_file($_FILES["uploadFile"]["tmp_name"], $target_dir)) {
    $message = "The file ". basename( $_FILES["uploadFile"]["name"]). " has been uploaded.";
} else {
    $message = "Sorry, there was an error uploading your file.";
}

echo "<script type='text/javascript'>alert('$message');</script>";

header("location:javascript://history.go(-1)");
//die();
?>