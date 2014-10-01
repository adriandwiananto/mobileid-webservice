<?php
session_start();
if(isset($_POST["no_ktp"])){
    $_SESSION["no_ktp"] = $_POST["no_ktp"];
    $_SESSION["nama"] = $_POST["nama"];
    // print $_POST["no_ktp"];
}
else{
    header("Location: ./");
    die();
}
?>