document.addEventListener("DOMContentLoaded", function () {
    // Alternar entre formulario de login y registro
    const wrapper = document.querySelector('.wrapper');
    const loginLink = document.querySelector('.login-link');
    const registerLink = document.querySelector('.register-link');

    registerLink.addEventListener('click', () => wrapper.classList.add('active'));
    loginLink.addEventListener('click', () => wrapper.classList.remove('active'));

    // Efectos en los campos de entrada (input)
    document.querySelectorAll(".input-box input").forEach(input => {
        input.addEventListener("input", function () {
            this.value.trim() !== "" ? this.classList.add("filled") : this.classList.remove("filled");
        });
    });

    // Mostrar/Ocultar contraseñas
    window.alternarContrasena = function (inputId, iconoOjo) {
        const campoContrasena = document.getElementById(inputId);
        const icono = iconoOjo.querySelector("ion-icon");

        if (campoContrasena.type === "password") {
            campoContrasena.type = "text";
            icono.setAttribute("name", "eye-outline");
        } else {
            campoContrasena.type = "password";
            icono.setAttribute("name", "eye-off-outline");
        }
    };

    // Validar que las contraseñas coincidan en el registro
    const contrasena = document.getElementById("passwordRegister");
    const confirmarContrasena = document.getElementById("passwordConfirm");
    const mensajeError = document.getElementById("passwordError");
    const formulario = document.querySelector("form[action*='register']");

    function validarContrasenas() {
        mensajeError.style.display = contrasena.value !== confirmarContrasena.value ? "block" : "none";
        return contrasena.value === confirmarContrasena.value;
    }

    confirmarContrasena?.addEventListener("input", validarContrasenas);

    formulario?.addEventListener("submit", function (event) {
        if (!validarContrasenas()) {
            event.preventDefault();
        }
    });

    // Mostrar notificación de éxito si el usuario se registró
    function mostrarNotificacion(mensaje, tipo = "error") {
        const notificacion = document.createElement("div");
        notificacion.className = `notificacion ${tipo}`;
        notificacion.innerHTML = `<span>${mensaje}</span>`;
    
        document.body.appendChild(notificacion);
    
        setTimeout(() => {
            notificacion.classList.add("desvanecer");
            setTimeout(() => notificacion.remove(), 500);
        }, 3000);
    }
    
    // Detectar si hubo error en el registro
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
    
        if (urlParams.has("registrado")) {
            mostrarNotificacion("¡Registro exitoso! Bienvenido a Restaurante JADA.", "exito");
        } else if (urlParams.has("error") && urlParams.get("error") === "registro") {
            mostrarNotificacion("Error: No se pudo completar el registro.", "error");
        }
    });
    
});
