<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

$conn = new mysqli("localhost", "root", "", "web_project");

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$createdBy = 5;

$books = [
    [
        "title" => "The Poppy War",
        "author" => "R.F. Kuang",
        "genre" => "Fantasy",
        "pages" => 544,
        "rating" => "4.6 / 5",
        "description" => "A grimdark military fantasy inspired by Chinese history.",
        "image_url" => "https://m.media-amazon.com/images/I/715XKcO4qZL._AC_UF894,1000_QL80_.jpg",
        "page" => "home"
    ],
    [
        "title" => "A Thousand Splendid Suns",
        "author" => "Khaled Hosseini",
        "genre" => "Historical Fiction",
        "pages" => 384,
        "rating" => "4.7 / 5",
        "description" => "The story of two Afghan women whose lives intersect amid war and hope.",
        "image_url" => "https://m.media-amazon.com/images/I/81xIPfJ6iUL._AC_UF1000,1000_QL80_.jpg",
        "page" => "home"
    ],
    [
        "title" => "Fearless",
        "author" => "Lauren Roberts",
        "genre" => "Romantasy",
        "pages" => 448,
        "rating" => "4.9 / 5",
        "description" => "Continuation of the Powerless series. Secrets rise, loyalties fracture.",
        "image_url" => "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1730558434i/214907249.jpg",
        "page" => "home"
    ],
    [
        "title" => "Young Justice (1998)",
        "author" => "DC Comics",
        "genre" => "Comic / Superhero",
        "pages" => 32,
        "rating" => "4.8 / 5",
        "description" => "Young Justice team faces new threats and emotional challenges.",
        "image_url" => "https://imgix-media.wbdndc.net/ingest/book/preview/53847b24-bff0-4d69-aa5e-535614b58fcf/fc91f061-8209-45a1-bfcf-953cbc909699/0.jpg",
        "page" => "home"
    ],
    [
        "title" => "Once Upon a Broken Heart",
        "author" => "Stephanie Garber",
        "genre" => "Romantasy",
        "pages" => 416,
        "rating" => "4.8 / 5",
        "description" => "Evangeline strikes a deal with the Prince of Hearts.",
        "image_url" => "https://m.media-amazon.com/images/I/81cNHxU3pzL._AC_UF1000,1000_QL80_.jpg",
        "page" => "home"
    ],
    [
        "title" => "The Cruel Prince",
        "author" => "Holly Black",
        "genre" => "Fantasy",
        "pages" => 370,
        "rating" => "4.5 / 5",
        "description" => "A mortal girl fights for power and survival in the world of the Fae.",
        "image_url" => "https://m.media-amazon.com/images/S/compressed.photo.goodreads.com/books/1574535986i/26032825.jpg",
        "page" => "home"
    ]
];

foreach($books as $book){
    $stmt = $conn->prepare("
        INSERT INTO items (title, author, genre, pages, rating, description, image_url, page, created_by)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "sssissssi",
        $book['title'],
        $book['author'],
        $book['genre'],
        $book['pages'],
        $book['rating'],
        $book['description'],
        $book['image_url'],
        $book['page'],
        $createdBy
    );

    $stmt->execute();
}

echo "Librat u futën me sukses!";
$conn->close();
?>