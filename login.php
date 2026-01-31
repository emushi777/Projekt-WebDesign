<?php
session_start();
require "config/db.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $user = $result->fetch_assoc();

        if(password_verify($password, $user["password"])){
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["name"] = $user["name"];
            $_SESSION["role"] = $user["role"];
            header("Location: home.php");
            exit;
        }
        else{
            $error = "Password i gabuar";
        }
    } 
    else{
        $error = "Email nuk ekziston";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

    <div class="container">
        <div class="left-side">
            <h2>Welcome Back</h2>
            <p>Log in to continue exploring your favorite books.</p>
        </div>

        <div class="right-side">
            <form action="login.php" method="POST" id="loginForm" onsubmit="return validateLogin(event)">
                <input id="email" name="email" type="email" placeholder="Email" required>
                <p class="error" id="emailError">Ju lutem shënoni një email valid.</p>

                <div class="password-wrapper">
                    <input id="password" name="password" type="password" placeholder="Password" required>
                    <ion-icon class="eye-icon" name="eye-outline" onclick="togglePasswordVisibility()"></ion-icon>
                </div>
                <p class="error" id="passwordError">Passwordi duhet të jetë 8-16 karaktere.</p>

                <button type="submit">Login</button>
            </form>
            
            <?php if(isset($_SESSION['error'])): ?>
                <p style="color: red; margin-top: 10px;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
            <?php endif; ?>

            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

<script src="login.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>