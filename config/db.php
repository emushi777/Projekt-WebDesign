<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "web_project";

$portOptions = [3307, 3306];
$conn = null;

foreach ($portOptions as $port) {
    $conn = mysqli_connect($host, $user, $pass, $db, $port);
    if($conn){
        break;
    }
}

if(!$conn){
    die("Database connection failed on all ports.");
}
?>