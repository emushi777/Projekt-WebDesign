<?php
session_start();
require "config/db.php";

if(isset($_SESSION['user_id'])){
    header("Location: home.php");
    exit;
}

$error = "";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name     = $_POST['name'] ?? '';
    $email    = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirmPassword'] ?? '';

    if(strlen($name) < 3){
        $error = "Name must be at least 3 characters.";
    } 
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Invalid email format.";
    } 
    elseif($password !== $confirm){
        $error = "Passwords do not match.";
    } 
    else{
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashedPassword);

        if($stmt->execute()){
            $_SESSION['user_id'] = $stmt->insert_id;
            $_SESSION['name'] = $name;
            $_SESSION['role'] = 'user';

            header("Location: home.php");
            exit;
        } 
        else{
            $error = "Email already exists or database error.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>

<div class="container">
    <div class="left-side">
        <h2>Create Account</h2>
        <p>Join us to explore your favorite books.</p>
    </div>

    <div class="right-side">
        <form class="form-group" method="POST" action="register.php" onsubmit="return validateRegister()">

            <div class="field">
                <input id="name" name="name" type="text" placeholder="Full Name" required>
                <p class="error" id="nameError">Name must be at least 3 characters.</p>
            </div>

            <div class="field">
                <input id="email" name="email" type="email" placeholder="Email" required>
                <p class="error" id="emailError">Please enter a valid email.</p>
            </div>

            <div class="field">
                <div class="password-wrapper">
                    <input id="password" name="password" type="password" placeholder="Password" required>
                    <ion-icon class="eye-icon" name="eye-outline" onclick="togglePassword('password', this)"></ion-icon>
                </div>
                <p class="error" id="passwordError">Password must contain 8–16 characters, including uppercase, lowercase, number, and special character.</p>
            </div>

            <div class="field">
                <div class="password-wrapper">
                    <input id="confirmPassword" name="confirmPassword" type="password" placeholder="Confirm Password" required>
                    <ion-icon class="eye-icon" name="eye-outline" onclick="togglePassword('confirmPassword', this)"></ion-icon>
                </div>
                <p class="error" id="confirmPasswordError">Passwords do not match.</p>
            </div>

            <div class="field">
                <button type="submit">Register</button>
            </div>
        </form>

        <?php if(!empty($error)): ?>
            <p style="color:red; margin-top: 10px;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <p class="link-text">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="register.js"></script>

</body>
</html>