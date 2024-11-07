document.addEventListener('DOMContentLoaded', () => {
    
    // Validamos el nombre de usuario
    const usernameInput = document.getElementById("username");
    usernameInput.addEventListener('input', () => {
        validateUsername(usernameInput.value) ? usernameInput.setCustomValidity('') : usernameInput.setCustomValidity('Este campo debe tener al menos 3 caracteres.');
    });

    // Validamos los requisitos de contraseña
    const passwordInput = document.getElementById("password");
    passwordInput.addEventListener('input', () => {
        validatePassword(passwordInput.value) ? passwordInput.setCustomValidity('') : passwordInput.setCustomValidity('La contraseña debe cumplir con ciertos requisitos.');
    });

    const form = document.querySelector('.needs-validation');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        form.classList.add('was-validated');
        if (form.checkValidity())
        {
            const formData = new FormData(this);
            try {
                const response = await fetch("http://localhost/NewRaccoonXpress/api/usersAPI.php?action=login", {
                    method: "POST",
                    body: formData
                });

                const result = await response.json();
                document.getElementById("auth_status_msg").classList.toggle("d-none", result.auth_status);
                if(result.auth_status)
                {
                    window.location.href = 'home.html';
                }
                else
                {
                    form.classList.remove('was-validated');
                }
            } catch (error) {
                console.error("Error:", error);
            }
        }        
    }, false);

    document.getElementById('registerButton').addEventListener('click', function() {
        window.location.href = 'register.html';
    });

    
});


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