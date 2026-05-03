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

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM items ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->get_result();
    }

    public function update($id, $title, $author, $genre, $pages, $rating, $description, $imageUrl = null) {
        if ($imageUrl) {
            $stmt = $this->conn->prepare(
                "UPDATE items SET title=?, author=?, genre=?, pages=?, rating=?, description=?, image_url=? WHERE id=?"
            );
            $stmt->bind_param("sssssssi", $title, $author, $genre, $pages, $rating, $description, $imageUrl, $id);
        } else {
            $stmt = $this->conn->prepare(
                "UPDATE items SET title=?, author=?, genre=?, pages=?, rating=?, description=? WHERE id=?"
            );
            $stmt->bind_param("ssssssi", $title, $author, $genre, $pages, $rating, $description, $id);
        }
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM items WHERE id=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM items WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
}