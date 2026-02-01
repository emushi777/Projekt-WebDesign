<?php
require_once __DIR__ . '/Database.php';

class News {
    private $conn;
    public function __construct($conn) { $this->conn = $conn; }

    public function create($title, $content, $filePath, $createdBy) {
        $stmt = $this->conn->prepare(
            "INSERT INTO news (title, content, file_path, created_by) VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("sssi", $title, $content, $filePath, $createdBy);
        return $stmt->execute();
    }

    public function getAllWithAuthor() {
        $sql = "SELECT n.*, u.name AS author
                FROM news n
                JOIN users u ON n.created_by = u.id
                ORDER BY n.created_at DESC";
        return $this->conn->query($sql);
    }
}
