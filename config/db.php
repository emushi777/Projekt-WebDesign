<?php
$serverName = "EMUSHI";
$connectionOptions = [
    "Database" => "projekti_login",
    "Uid" => "",
    "PWD" => ""
];

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}