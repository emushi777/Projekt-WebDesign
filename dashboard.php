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
$items = $itemModel->getAll();
$uploader = new FileUpload();

$successMsg = "";
$errorMsg = "";

$editItem = null;
if (isset($_GET['edit'])) {
    $editItem = $itemModel->getById((int)$_GET['edit']);
}

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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_item'])) {
    try {
        $path = null;
        if (!empty($_FILES['update_item_file']['name'])) {
            $path = $uploader->upload($_FILES['update_item_file'], "item");
        }
        $itemModel->update(
            (int)$_POST['item_id'],
            $_POST['item_title'],
            $_POST['item_author'],
            $_POST['item_genre'],
            $_POST['item_pages'],
            $_POST['item_rating'],
            $_POST['item_description'],
            $path
        );
        $successMsg = "Item updated successfully!";
    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_item'])) {
    try {
        $itemModel->delete((int)$_POST['item_id']);
        $successMsg = "Item deleted successfully!";
    } catch (Exception $e) {
        $errorMsg = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            padding: 20px; 
            max-width: 1200px; 
            margin: 0 auto; 
        }
        h1 { 
            text-align: center; 
            margin-bottom: 20px; 
        }
        h2 { 
            margin-top: 40px; 
            border-bottom: 2px solid #333; 
            padding-bottom: 10px; 
        }
        .logout { 
            float: right; 
            text-decoration: none; 
            color: red; 
            font-weight: bold; 
        }
        .message { 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
        }
        .success { color: green; background-color: #d4edda; border: 1px solid #c3e6cb; }
        .error { color: red; background-color: #f8d7da; border: 1px solid #f5c6cb; }
        
        /* Table styles */
        .table-container { 
            overflow-x: auto; 
            margin-top: 10px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            min-width: 600px; 
        }
        th, td { 
            border: 1px solid #ccc; 
            padding: 8px; 
            text-align: left; 
        }
        th { 
            background-color: #f2f2f2; 
            font-weight: bold; 
        }
        
        /* Form styles */
        form { 
            background-color: #f9f9f9; 
            padding: 20px; 
            border-radius: 5px; 
            margin-top: 20px; 
        }
        input, textarea, select { 
            width: 100%; 
            padding: 8px; 
            margin: 5px 0; 
            border: 1px solid #ccc; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        button { 
            background-color: #007bff; 
            color: white; 
            padding: 10px 15px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            margin: 5px; 
        }
        button:hover { background-color: #0056b3; }
        .delete-btn { background-color: #dc3545; }
        .delete-btn:hover { background-color: #c82333; }
        .edit-btn { background-color: #28a745; }
        .edit-btn:hover { background-color: #218838; }
        
        /* Form layout */
        .form-row {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        .form-row input,
        .form-row select {
            flex: 1;
        }
        .form-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        /* Responsive design */
        @media (max-width: 768px) {
            body { padding: 10px; }
            h1 { font-size: 1.5em; }
            h2 { font-size: 1.2em; margin-top: 30px; }
            .table-container { 
                overflow-x: auto; 
                -webkit-overflow-scrolling: touch;
                margin: 0 -10px;
            }
            table { 
                font-size: 0.9em; 
                min-width: 600px;
                margin: 0;
            }
            th, td { padding: 6px; }
            form { 
                padding: 15px; 
                margin: 20px -10px;
            }
            button { 
                padding: 8px 12px; 
                font-size: 0.9em; 
                margin: 2px;
            }
            .logout { 
                float: none; 
                display: block; 
                text-align: center; 
                margin-bottom: 10px; 
            }
            .actions { 
                min-width: 120px;
            }
            .actions button {
                display: block;
                width: 100%;
                margin: 2px 0;
            }
        }
        
        @media (max-width: 480px) {
            body { padding: 5px; }
            h1 { font-size: 1.3em; }
            h2 { font-size: 1.1em; margin-top: 25px; }
            .table-container { 
                margin: 0 -5px;
            }
            table { 
                font-size: 0.8em; 
                min-width: 600px;
            }
            th, td { 
                padding: 4px; 
                font-size: 0.8em; 
            }
            /* Hide less important columns on very small screens */
            .table-container table th:nth-child(4), 
            .table-container table td:nth-child(4), /* Genre */
            .table-container table th:nth-child(5), 
            .table-container table td:nth-child(5)  /* Pages */
            { display: none; }
            form { 
                padding: 10px; 
                margin: 15px -5px;
            }
            input, textarea, select { 
                font-size: 0.9em; 
                padding: 6px;
            }
            button { 
                padding: 6px 10px; 
                font-size: 0.8em; 
                margin: 2px;
            }
        /* Mobile card layout */
        @media (max-width: 480px) {
            .table-container {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
                margin: 0 -5px;
            }
            table { 
                font-size: 0.7em; 
                min-width: 600px;
                margin: 0;
            }
            th, td { 
                padding: 3px; 
                font-size: 0.7em; 
            }
            /* Hide less important columns on very small screens */
            .table-container table th:nth-child(4), 
            .table-container table td:nth-child(4), /* Genre */
            .table-container table th:nth-child(5), 
            .table-container table td:nth-child(5)  /* Pages */
            { display: none; }
            .actions button {
                padding: 4px 6px;
                font-size: 0.7em;
                margin: 1px;
            }
        }
        
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 90%;
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
        }
        .modal-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 20px;
        }
        .modal-buttons button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }
        .confirm-btn {
            background-color: #dc3545;
            color: white;
        }
        .cancel-btn {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>

<h1>Dashboard - Welcome</h1>
<a href="logout.php" class="logout">[Dil]</a>
<?php if ($successMsg) echo "<p class='message success'>" . htmlspecialchars($successMsg) . "</p>"; ?>
<?php if ($errorMsg) echo "<p class='message error'>" . htmlspecialchars($errorMsg) . "</p>"; ?>


<h2>Përdoruesit</h2>
<div class="table-container">
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
</div>

<h2>Lajmet / Produktet</h2>
<div class="table-container">
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
</div>

<h2>Mesazhet nga Kontakti</h2>
<div class="table-container">
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
</div>

<h2>Items (Comics/Authors)</h2>
<div class="table-container">
<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Author</th>
        <th>Genre</th>
        <th>Pages</th>
        <th>Rating</th>
        <th>Page</th>
        <th>Actions</th>
    </tr>
    <?php while($row = $items->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= htmlspecialchars($row['title']) ?></td>
        <td><?= htmlspecialchars($row['author']) ?></td>
        <td><?= htmlspecialchars($row['genre']) ?></td>
        <td><?= htmlspecialchars($row['pages']) ?></td>
        <td><?= htmlspecialchars($row['rating']) ?></td>
        <td><?= $row['page'] ?></td>
        <td class="actions">
            <a href="?edit=<?= $row['id'] ?>"><button class="edit-btn">Edit</button></a>
            <button class="delete-btn" onclick="confirmDelete(<?= $row['id'] ?>)">Delete</button>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>
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

<h2>Edit Item</h2>
<form method="POST" enctype="multipart/form-data" id="editForm" style="display:<?= $editItem ? 'block' : 'none' ?>;">
  <input type="hidden" name="item_id" value="<?= $editItem ? $editItem['id'] : '' ?>">
  <input name="item_title" value="<?= $editItem ? htmlspecialchars($editItem['title']) : '' ?>" placeholder="Title" required><br>
  <input name="item_author" value="<?= $editItem ? htmlspecialchars($editItem['author']) : '' ?>" placeholder="Author" required><br>
  <input name="item_genre" value="<?= $editItem ? htmlspecialchars($editItem['genre']) : '' ?>" placeholder="Genre" required><br>
  <input name="item_pages" value="<?= $editItem ? htmlspecialchars($editItem['pages']) : '' ?>" placeholder="Pages" required><br>
  <input name="item_rating" value="<?= $editItem ? htmlspecialchars($editItem['rating']) : '' ?>" placeholder="Rating" required><br>
  <textarea name="item_description" placeholder="Description" required><?= $editItem ? htmlspecialchars($editItem['description']) : '' ?></textarea><br>
  <select name="item_page" required>
    <option value="comics" <?= $editItem && $editItem['page'] == 'comics' ? 'selected' : '' ?>>Comics</option>
    <option value="authors" <?= $editItem && $editItem['page'] == 'authors' ? 'selected' : '' ?>>Authors</option>
  </select><br>
  <input type="file" name="update_item_file" accept="image/*,.pdf"><br>
  <button type="submit" name="update_item">Update Item</button>
  <a href="dashboard.php"><button type="button">Cancel</button></a>
</form>


