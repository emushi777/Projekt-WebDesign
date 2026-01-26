<?php
require "config/db.php";

if(isset($_SESSION['user_id'])){
    header("Location: home.php");
    exit;
}

if(isset($_POST['register'])){
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $pass  = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password)
            VALUES ('$name','$email','$pass')";

    if(mysqli_query($conn, $sql)){

        $user_id = mysqli_insert_id($conn);

        $_SESSION['user_id'] = $user_id;
        $_SESSION['role']    = 'user';

        header("Location: home.php");
        exit;

    } 
    else{
        $error = "Email already exists!";
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
        <div class="form-group" method="POST" action="register.php">

            <div class="field">
                <input id="name" type="text" placeholder="Full Name">
                <p class="error" id="nameError">Name must be at least 3 characters.</p>
            </div>

            <div class="field">
                <input id="email" type="email" placeholder="Email">
                <p class="error" id="emailError">Please enter a valid email.</p>
            </div>

            <div class="field">
                <div class="password-wrapper">
                    <input id="password" type="password" placeholder="Password">
                    <ion-icon class="eye-icon" name="eye-outline" onclick="togglePassword('password', this)"></ion-icon>
                </div>
            <p class="error" id="passwordError">Password must contain 8–16 characters, including uppercase, lowercase, number, and special character.</p>
            </div>

            <div class="field">
                <div class="password-wrapper">
                    <input id="confirmPassword" type="password" placeholder="Confirm Password">
                    <ion-icon class="eye-icon" name="eye-outline" onclick="togglePassword('confirmPassword', this)"></ion-icon>
                </div>
                <p class="error" id="confirmPasswordError">Passwords do not match.</p>
            </div>

            <div class="field">
                <button type="submit" onclick="validateRegister()">Register</button>
            </div>

        </div>

        <p class="link-text">Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="register.js"></script>
</body>
</html>