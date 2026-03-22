<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

require_once "classes/Database.php";
require_once "classes/Item.php";

$conn = Database::connect();
$itemModel = new Item($conn);

$items = $itemModel->getByPage('comics');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
</head>
<body>

<h1>Products</h1>

<?php while ($item = $items->fetch_assoc()): ?>
    <div style="margin-bottom: 20px;">
        <h3><?php echo htmlspecialchars($item['title']); ?></h3>

        <?php if (!empty($item['image_url'])): ?>
            <img src="<?php echo htmlspecialchars($item['image_url']); ?>" width="120">
        <?php endif; ?>

        <p><?php echo htmlspecialchars($item['description']); ?></p>
    </div>
<?php endwhile; ?>

</body>
</html>
