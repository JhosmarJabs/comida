document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form[action*='register']");
    const inputs = form.querySelectorAll("input[required]");
    
    inputs.forEach(input => {
        const message = document.createElement("span"); // Crea el mensaje de validación
        message.classList.add("validation-message");
        input.parentNode.appendChild(message);

        input.addEventListener("focus", function () {
            message.style.display = "block";
            validateField(input, message);
        });

        input.addEventListener("input", function () {
            validateField(input, message);
        });

        input.addEventListener("blur", function () {
            if (input.value.trim() === "") {
                message.style.display = "none";
            }
        });
    });

    function validateField(input, message) {
        const value = input.value.trim();
        let valid = true;
        let msg = "";

        if (input.name === "txtNombre" || input.name === "txtApellido") {
            valid = /^[a-zA-Z\s]+$/.test(value);
            msg = valid ? "✓ Nombre válido" : "✖ Solo se permiten letras y espacios.";
        } else if (input.name === "txtTelefono") {
            valid = /^\d{10}$/.test(value);
            msg = valid ? "✓ Número válido" : "✖ Debe contener 10 dígitos.";
        } else if (input.name === "txtEmail") {
            valid = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/.test(value);
            msg = valid ? "✓ Correo válido" : "✖ Ingrese un correo válido.";
        } else if (input.name === "txtPassword") {
            let requirements = [];
            if (value.length < 8) requirements.push("Al menos 8 caracteres");
            if (!/[A-Z]/.test(value)) requirements.push("Una letra mayúscula");
            if (!/[a-z]/.test(value)) requirements.push("Una letra minúscula");
            if (!/\d/.test(value)) requirements.push("Un número");

            valid = requirements.length === 0;
            msg = valid ? "✓ Contraseña segura" : "✖ " + requirements.join(", ");
        } else if (input.id === "passwordConfirm") {
            const password = document.getElementById("passwordRegister").value;
            valid = value === password && value !== "";
            msg = valid ? "✓ Contraseñas coinciden" : "✖ Las contraseñas no coinciden.";
        }

        message.textContent = msg;
        message.style.color = valid ? "green" : "red";
    }
});

// Función para mostrar/ocultar contraseña
function togglePassword(inputId, eyeIcon) {
    const passwordInput = document.getElementById(inputId);
    const icon = eyeIcon.querySelector("ion-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.setAttribute("name", "eye-outline");
    } else {
        passwordInput.type = "password";
        icon.setAttribute("name", "eye-off-outline");
    }
}
