function togglePassword(id, icon){
    const input = document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
        icon.setAttribute("name", "eye-off-outline"); // closed eye
    } 
    else{
        input.type = "password";
        icon.setAttribute("name", "eye-outline"); // open eye
    }
}

function validateRegister(){
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();

    let valid = true;

    document.getElementById("nameError").style.display = name.length < 2 ? "block" : "none";
        if(name.length < 2){ 
            valid = false;
        }

    document.getElementById("emailError").style.display = (!email.includes("@") || !email.includes(".")) ? "block" : "none";
        if(!email.includes("@") || !email.includes(".")){ 
            valid = false;
        }

    document.getElementById("passwordError").style.display = password.length < 6 ? "block" : "none";
        if(password.length < 6){
            valid = false;
        }

    document.getElementById("confirmPasswordError").style.display = (confirmPassword !== password) ? "block" : "none";
        if(confirmPassword !== password){
            valid = false;
        }

    if(valid){
        window.location.href = "home.html";
    }
}