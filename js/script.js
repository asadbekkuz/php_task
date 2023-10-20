document.addEventListener("DOMContentLoaded", (event) => {
     let rememberedUsername = getCookie("remembered_username");
     let rememberedPassword = getCookie("remembered_password");
     if (rememberedUsername) {
        document.getElementById("username_login_input").value = rememberedUsername;
        document.getElementById("password_login_input").value = rememberedPassword;
        document.getElementById("checkbox_login_input").checked = true;
     }
    togglePassword('password_input');
    togglePassword('password_login_input');
    togglePasswordConfirm('password_confirm_input')

});

function getCookie(name) {
    let cookieName = name + "=";
    let cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i].trim();
        if (cookie.indexOf(cookieName) === 0) {
            return cookie.substring(cookieName.length, cookie.length);
        }
    }
    return "";
}

function togglePassword(passwordId)
{
    let password = document.getElementById('password');
    let password_icon = document.querySelector('#password i');
    password.addEventListener('click',() => {
        let passwordInput = document.getElementById(passwordId)
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            password_icon.className = 'bi bi-eye';
        } else {
            passwordInput.type = "password";
            password_icon.className = 'bi bi-eye-slash';
        }
    })
}

function togglePasswordConfirm(passwordId)
{
    let password_confirm  = document.getElementById('password_confirm');
    let password_confirm_icon = document.querySelector('#password_confirm i');
    password_confirm.addEventListener('click',() => {
        let passwordConfirmInput = document.getElementById(passwordId)
        if (passwordConfirmInput.type === "password") {
            passwordConfirmInput.type = "text";
            password_confirm_icon.className = 'bi bi-eye'
        } else {
            passwordConfirmInput.type = "password";
            password_confirm_icon.className = 'bi bi-eye-slash'
        }
    })
}