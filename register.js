function togglePassword(id, icon){
    const input = document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
        icon.setAttribute("name", "eye-off-outline");
    } 
    else{
        input.type = "password";
        icon.setAttribute("name", "eye-outline");
    }
}

function validateRegister(){
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();

    let valid = true;

    const nameRegex = /^[A-Za-zÀ-ž\s]{2,}$/;
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const passwordRegex =
        /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d])[A-Za-z\d^_!@#$%&*]{8,16}$/;

    if(!nameRegex.test(name)){
        document.getElementById("nameError").style.display = "block";
        valid = false;
    } 
    else{
        document.getElementById("nameError").style.display = "none";
    }

    if(!emailRegex.test(email)){
        document.getElementById("emailError").style.display = "block";
        valid = false;
    }
    else{
        document.getElementById("emailError").style.display = "none";
    }

    if(!passwordRegex.test(password)){
        document.getElementById("passwordError").style.display = "block";
        valid = false;
    } 
    else{
        document.getElementById("passwordError").style.display = "none";
    }

    if(confirmPassword !== password){
        document.getElementById("confirmPasswordError").style.display = "block";
        valid = false;
    } 
    else{
        document.getElementById("confirmPasswordError").style.display = "none";
    }

    if(valid){
        window.location.href = "home.php";
    }
}