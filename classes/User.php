<?php
require_once __DIR__ . '/Database.php';

class User {
    private $conn;
    public function __construct($conn) { $this->conn = $conn; }

    public function getAll() {
        return $this->conn->query("SELECT id, name, email, role FROM users ORDER BY id DESC");
    }

    public function findByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}
