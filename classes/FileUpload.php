<?php

class FileUpload {
    private $uploadDir;
    private $allowed;
    private $maxSize;

    public function __construct() {
        $this->uploadDir = __DIR__ . '/../uploads/';
        $this->allowed = ['jpg','jpeg','png','gif','pdf'];
        $this->maxSize = 5 * 1024 * 1024;

        if (!is_dir($this->uploadDir)) {
            mkdir($this->uploadDir, 0777, true);
        }
    }

    public function upload($file, $prefix) {
        if (!isset($file['error']) || $file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Upload failed.");
        }

        if ($file['size'] > $this->maxSize) {
            throw new Exception("File too large.");
        }

        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $this->allowed)) {
            throw new Exception("File type not allowed.");
        }

        $name = $prefix . "_" . time() . "_" . uniqid() . "." . $ext;
        $dest = $this->uploadDir . $name;

        if (!move_uploaded_file($file['tmp_name'], $dest)) {
            throw new Exception("Could not save file.");
        }

        return "uploads/" . $name;
    }
}
