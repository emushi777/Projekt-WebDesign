<?php
require_once __DIR__ . '/Database.php';

class Item {
    private $conn;
    public function __construct($conn) { $this->conn = $conn; }

    public function create($title,$author,$genre,$pages,$rating,$description,$imageUrl,$page,$createdBy) {
        $stmt = $this->conn->prepare(
            "INSERT INTO items (title, author, genre, pages, rating, description, image_url, page, created_by)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("ssssssssi",
            $title,$author,$genre,$pages,$rating,$description,$imageUrl,$page,$createdBy
        );
        return $stmt->execute();
    }

    public function getByPage($page) {
        $stmt = $this->conn->prepare("SELECT * FROM items WHERE page = ? ORDER BY created_at DESC");
        $stmt->bind_param("s", $page);
        $stmt->execute();
        return $stmt->get_result();
    }
}
