<?php
require_once "classes/Database.php";
require_once "classes/News.php";

$conn = Database::connect();
$newsModel = new News($conn);

$result = $newsModel->getAllWithAuthor();
$about = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
</head>
<body>

<h1><?php echo htmlspecialchars($about['title']); ?></h1>

<p>
    <?php echo nl2br(htmlspecialchars($about['content'])); ?>
</p>

</body>
</html>
