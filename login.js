function validateLogin() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");

    let valid = true;

    // Email validation
    if (!email.includes("@") || !email.includes(".")) {
        emailError.style.display = "block";
        valid = false;
    } else {
        emailError.style.display = "none";
    }

    // Password validation
    if (password.length < 6) {
        passwordError.style.display = "block";
        valid = false;
    } else {
        passwordError.style.display = "none";
    }

    // If valid → redirect to home page
    if (valid) {
        window.location.href = "home.html";
    }
}