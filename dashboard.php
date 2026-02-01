<?php
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";
require_once "classes/News.php";
require_once "classes/Contact.php";

$conn = Database::connect();


if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin'){
    header("Location: login.php");
    exit;
}

// Merr të dhënat nga databaza
$userModel = new User($conn);
$newsModel = new News($conn);
$contactModel = new Contact($conn);

$users = $userModel->getAll();
$news = $newsModel->getAllWithAuthor();
$contacts = $contactModel->getAll();

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

<h1>Dashboard - Mirë se vjen, <?php echo htmlspecialchars($_SESSION['name']); ?> 👋</h1>
<a href="logout.php" class="logout">[Dil]</a>

<!-- 👥 Tabela e Përdoruesve -->
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

<!-- 📰 Tabela e Lajmeve / Produkteve -->
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

<!-- ✉️ Tabela e Kontaktit -->
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

</body>
</html>
