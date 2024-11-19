/*async function deactivate_account()
{
    event.preventDefault();
    try {
        const response = await fetch("http://localhost/NewRaccoonXpress/index.php?controller=user&action=deactivateUser", {
            method: "POST"
        });
        const result = await response.json();
        if (result.deactivated) {
            // Redirige al usuario a la página de inicio o de login
            window.location.href = "landing_page.php";
            localStorage.removeItem('user_id');
            localStorage.removeItem('user_role');
            return true;
        } else {
            console.error("Error al eliminar la cuenta:", response.statusText);
            return false;
        }
    }
    catch (error) {
        console.error("Error:", error);
        return false;
    }
}*/

document.addEventListener('DOMContentLoaded', () => {
    // Validamos el nombre de usuario
    const usernameInput = document.getElementById("username");
    usernameInput.addEventListener('input', () => {
        validateUsername(usernameInput.value) ? usernameInput.setCustomValidity('') : usernameInput.setCustomValidity('Este campo debe tener al menos 3 caracteres.');
    });

    // Validamos que sea un email correctamente estructurado
    const emailInput = document.getElementById("email");
    emailInput.addEventListener('input', () => {
        validateEmail(emailInput.value) ? emailInput.setCustomValidity('') : emailInput.setCustomValidity('Ingrese una dirección de correo electrónico válida.');
    });

    // Validamos los requisitos de contraseña
    const passwordInput = document.getElementById("password");
    passwordInput.addEventListener('input', () => {
        validatePassword(passwordInput.value) ? passwordInput.setCustomValidity('') : passwordInput.setCustomValidity('La contraseña debe cumplir con ciertos requisitos.');
    });

    const form = document.getElementById('updateForm');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        form.classList.add('was-validated');
        if (form.checkValidity())
        {
            const formData = new FormData(this);
            try {
                const response = await fetch("http://localhost/NewRaccoonXpress/index.php?controller=user&action=updateUser", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();
                console.log(result);
                if (result.success) 
                {
                    location.reload();
                } 
                else 
                {
                    // Mostrar mensaje de error
                    console.error("Error al actualizar la cuenta: ", response.statusText);
                }
            } catch (error) {
                console.log("Error:", error);
            }
        }        
    }, false);
});

function validateUsername(username)
{
    return (username.trim().length >= 3);
}

function validatePassword(password)
{
    let validPassword = true;
    document.getElementById("req_length").classList.add("valid");
    document.getElementById("req_upper").classList.add("valid");
    document.getElementById("req_lower").classList.add("valid");
    document.getElementById("req_number").classList.add("valid");
    document.getElementById("req_special").classList.add("valid");
    // Verificar si la contraseña tiene al menos 8 caracteres
    if (password.length < 8)
    {
        validPassword = false;
        document.getElementById("req_length").classList.remove("valid");
    }

    // Verificar si hay al menos una letra mayúscula
    if (!/[A-Z]/.test(password)) {
        validPassword = false;
        document.getElementById("req_upper").classList.remove("valid");
    }

    // Verificar si hay al menos una letra minúscula
    if (!/[a-z]/.test(password)) {
        validPassword = false;
        document.getElementById("req_lower").classList.remove("valid");
    }

    // Verificar si hay al menos un número
    if (!/[0-9]/.test(password)) {
        validPassword = false;
        document.getElementById("req_number").classList.remove("valid");
    }

    // Verificar si hay al menos un carácter especial
    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        validPassword = false;
        document.getElementById("req_special").classList.remove("valid");
    }
    // Si pasa todas las validaciones, la contraseña es válida
    return validPassword;
}

function validateEmail(email)
{
    // Expresión regular para validar un correo electrónico
    var pattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

    // Utilizamos el método test de la expresión regular para verificar si la cadena coincide con el patrón
    return pattern.test(email);
}

function togglePassword() {
    const passwordField = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    } else {
        passwordField.type = 'password';
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    }
}