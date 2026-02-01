<?php
require_once "classes/Database.php";
require_once "classes/News.php";

$conn = Database::connect();
$newsModel = new News($conn);
$newsList = $newsModel->getAllWithAuthor();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>News</title>
</head>
<body>

<h1>Latest News</h1>

<?php while ($news = $newsList->fetch_assoc()): ?>
  <article>
    <h2><?php echo htmlspecialchars($news['title']); ?></h2>
    <p><?php echo nl2br(htmlspecialchars($news['content'])); ?></p>

    <?php if (!empty($news['file_path'])): ?>
      <p>
        <a href="<?php echo htmlspecialchars($news['file_path']); ?>" target="_blank">
          View attachment
        </a>
      </p>
    <?php endif; ?>

    <hr>
  </article>
<?php endwhile; ?>

</body>
</html>
