<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "web_project";
$port = 3307;

$conn = mysqli_connect($host, $user, $pass, $db, $port);
if (!$conn) {
    die("DB connection failed");
}

session_start();
?>