<?php

class Database {
    public static function connect() {
        require __DIR__ . '/../config/db.php';
        $mysqli = new mysqli($host, $user, $pass, $db, $port);

        if ($mysqli->connect_error) {
            die("DB connection failed: " . $mysqli->connect_error);
        }

        $mysqli->set_charset("utf8mb4");
        return $mysqli;
    }
}
