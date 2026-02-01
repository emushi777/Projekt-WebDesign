<?php
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";
require_once "classes/News.php";
require_once "classes/Contact.php";
require_once "classes/FileUpload.php";
require_once "classes/Item.php";


$conn = Database::connect();


if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit;
}

$users    = $conn->query("SELECT id, name, email, role FROM users");
$news     = $conn->query("SELECT n.id, n.title, n.created_at, u.name as author FROM news n JOIN users u ON n.created_by = u.id");
$contacts = $conn->query("SELECT id, name, email, message, created_at FROM contacts");

$userModel = new User($conn);
$newsModel = new News($conn);
$contactModel = new Contact($conn);

$users = $userModel->getAll();
$news = $newsModel->getAllWithAuthor();
$contacts = $contactModel->getAll();
$itemModel = new Item($conn);
$uploader = new FileUpload();

$successMsg = "";
$errorMsg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item'])) {
    try {
        $path = $uploader->upload($_FILES['item_file'], "item");
        $itemModel->create(
            $_POST['item_title'],
            $_POST['item_author'],
            $_POST['item_genre'],
            $_POST['item_pages'],
            $_POST['item_rating'],
            $_POST['item_description'],
            $path,
            $_POST['item_page'],
            (int)$_SESSION['user_id']
        );
        $successMsg = "Item added successfully!";
    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_news'])) {
    try {
        $path = null;
        if (!empty($_FILES['news_file']['name'])) {
            $path = $uploader->upload($_FILES['news_file'], "news");
        }
        $newsModel->create(
            $_POST['news_title'],
            $_POST['news_content'],
            $path,
            (int)$_SESSION['user_id']
        );
        $successMsg = "News added successfully!";
    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        h2 { margin-top: 40px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a.logout { float: right; text-decoration: none; color: red; }
    </style>
</head>
<body>

<h1>Dashboard - Welcome</h1>
<a href="logout.php" class="logout">[Dil]</a>
<?php if ($successMsg) echo "<p style='color:green;'>" . htmlspecialchars($successMsg) . "</p>"; ?>
<?php if ($errorMsg) echo "<p style='color:red;'>" . htmlspecialchars($errorMsg) . "</p>"; ?>


<h2>Përdoruesit</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Emri</th>
        <th>Email</th>
        <th>Roli</th>
    </tr>
    <?php while($row = $users->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= $row['role'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h2>Lajmet / Produktet</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Titulli</th>
        <th>Autori</th>
        <th>Data</th>
    </tr>
    <?php while($row = $news->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['author']) ?></td>
        <td><?= $row['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<h2>Mesazhet nga Kontakti</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Emri</th>
        <th>Email</th>
        <th>Mesazhi</th>
        <th>Data</th>
    </tr>
    <?php while($row = $contacts->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['message']) ?></td>
        <td><?= $row['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>
<h2>Add Comic/Author Item</h2>
<form method="POST" enctype="multipart/form-data">
  <input name="item_title" placeholder="Title" required><br>
  <input name="item_author" placeholder="Author" required><br>
  <input name="item_genre" placeholder="Genre" required><br>
  <input name="item_pages" placeholder="Pages" required><br>
  <input name="item_rating" placeholder="Rating" required><br>
  <textarea name="item_description" placeholder="Description" required></textarea><br>

  <select name="item_page" required>
    <option value="comics">Comics</option>
    <option value="authors">Authors</option>
  </select><br>

  <input type="file" name="item_file" accept="image/*,.pdf" required><br>
  <button type="submit" name="add_item">Add Item</button>
</form>

<h2>Add News</h2>
<form method="POST" enctype="multipart/form-data">
  <input name="news_title" placeholder="Title" required><br>
  <textarea name="news_content" placeholder="Content" required></textarea><br>
  <input type="file" name="news_file" accept="image/*,.pdf"><br>
  <button type="submit" name="add_news">Add News</button>
</form>

</body>
</html>
