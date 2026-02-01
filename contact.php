<?php
session_start();

require_once "classes/Database.php";
require_once "classes/Contact.php";

$conn = Database::connect();
$contactModel = new Contact($conn);

$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $message = trim($_POST["message"] ?? "");

    if ($name === "" || $email === "" || $message === "") {
        $error = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address.";
    } else {
        if ($contactModel->create($name, $email, $message)) {
            $success = "Message sent successfully!";
        } else {
            $error = "Failed to send message.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
</head>
<body>

<h1>Contact Us</h1>

<?php if ($error): ?>
  <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if ($success): ?>
  <p style="color:green;"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<form method="POST" action="">
  <div>
    <label>Name</label><br>
    <input type="text" name="name" required>
  </div>

  <div>
    <label>Email</label><br>
    <input type="email" name="email" required>
  </div>

  <div>
    <label>Message</label><br>
    <textarea name="message" rows="5" required></textarea>
  </div>

  <button type="submit">Send</button>
</form>

</body>
</html>
