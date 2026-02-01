<?php
$host = "127.0.0.1";
$user = "root";
$pass = "";
$db   = "web_project";
$port = 3306;

$conn = mysqli_connect($host, $user, $pass, $db, $port);
if (!$conn) {
    die("DB connection failed");
}

?>