<?php
require_once __DIR__ . '/Database.php';

class Contact {
    private $conn;
    public function __construct($conn) { $this->conn = $conn; }

    public function create($name, $email, $message) {
        $stmt = $this->conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);
        return $stmt->execute();
    }

    public function getAll() {
        return $this->conn->query("SELECT * FROM contacts ORDER BY created_at DESC");
    }
}
