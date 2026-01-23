function validateLogin() {
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    let emailError = document.getElementById("emailError");
    let passwordError = document.getElementById("passwordError");

    let valid = true;

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d^_!@#$%&*]{8,16}$/;


    if(!emailRegex.test(email)){
        emailError.style.display = "block";
        valid = false;
    } 
    else{
        emailError.style.display = "none";
    }

    if(!passwordRegex.test(password)){
        passwordError.style.display = "block";
        valid = false;
    } 
    else{
        passwordError.style.display = "none";
    }

    if(valid){
        window.location.href = "home.php";
    }
}

function togglePasswordVisibility(){
    let passwordField = document.getElementById("password");
    let eyeIcon = document.querySelector(".eye-icon");

    if(passwordField.type === "password"){
        passwordField.type = "text";
        eyeIcon.name = "eye-off-outline";
    } 
    else{
        passwordField.type = "password";
        eyeIcon.name = "eye-outline";
    }
}