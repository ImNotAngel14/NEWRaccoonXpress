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

    const form = document.querySelector('.needs-validation')
    let errorTOTAL;
    form.addEventListener('submit', async function(event) {
        if (!form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        // Recoge todos los datos del formulario automáticamente
        const formData = new FormData(this);
        try {
            // Envía la solicitud a la API
            const response = await fetch("http://localhost/NewRaccoonXpress/api/usersAPI.php?action=register", {
                method: "POST",
                body: formData
            });

            alert("breakpoint2");
            const result = await response.json(); // Obtener respuesta en JSON
            
            alert("breakpoint3");
            if (result.success) 
            {
                // Mostrar mensaje de éxito (puedes redirigir o mostrar un mensaje)
                alert("¡Registro exitoso!");
                console.log(result.message);
            } 
            else 
            {
                // Mostrar mensaje de error
                alert("Fallo");
                console.log(result);
            }
        } catch (error) {
            console.error("Error:", error);
            alert("breakpoint error");
        }
        form.classList.add('was-validated');
    }, false);
});


function validateUsername(username)
{
    return (username.trim().length >= 3);
}

function validatePassword(password)
{
    let validPassword = true;
    document.getElementById("id_req_length").classList.add("valid");
    document.getElementById("id_req_upper").classList.add("valid");
    document.getElementById("id_req_lower").classList.add("valid");
    document.getElementById("id_req_number").classList.add("valid");
    document.getElementById("id_req_special").classList.add("valid");
    // Verificar si la contraseña tiene al menos 8 caracteres
    if (password.length < 8)
    {
        validPassword = false;
        document.getElementById("id_req_length").classList.remove("valid");
    }

    // Verificar si hay al menos una letra mayúscula
    if (!/[A-Z]/.test(password)) {
        validPassword = false;
        document.getElementById("id_req_upper").classList.remove("valid");
    }

    // Verificar si hay al menos una letra minúscula
    if (!/[a-z]/.test(password)) {
        validPassword = false;
        document.getElementById("id_req_lower").classList.remove("valid");
    }

    // Verificar si hay al menos un número
    if (!/[0-9]/.test(password)) {
        validPassword = false;
        document.getElementById("id_req_number").classList.remove("valid");
    }

    // Verificar si hay al menos un carácter especial
    if (!/[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/.test(password)) {
        validPassword = false;
        document.getElementById("id_req_special").classList.remove("valid");
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