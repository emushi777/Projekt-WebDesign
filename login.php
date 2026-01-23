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
            <input id="email" type="email" placeholder="Email">
            <p class="error" id="emailError">Please enter a valid email.</p>

            <div class="password-wrapper">
                <input id="password" type="password" placeholder="Password">
                <ion-icon class="eye-icon" name="eye-outline" onclick="togglePasswordVisibility()"></ion-icon>
            </div>
            <p class="error" id="passwordError">Password must be at least 6 characters.</p>

            <button onclick="validateLogin()">Login</button>

            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </div>

<script src="login.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</body>
</html>