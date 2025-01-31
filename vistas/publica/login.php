<div class="container-login">
    <div class="wrapper">
        <span class="icon-close">
            <ion-icon name="close"></ion-icon>
        </span>

        <!-- FORMULARIO DE LOGIN -->
        <div class="form-box login">
            <h2>Iniciar sesión</h2>
            <form action="/comida/index?clase=ControladorPublico&metodo=login" method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="txtEmailI" required>
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPasswordI" id="passwordLogin" required>
                    <label>Contraseña</label>
                    <span class="toggle-password" onclick="togglePassword('passwordLogin', this)">
                        <ion-icon name="eye-off-outline"></ion-icon>
                    </span>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="txtremember"> Recordar</label>
                    <a href="/comida/index?clase=ControladorPublico&metodo=correo">Olvidaste la contraseña?</a>
                </div>
                <button type="submit" class="btn">Iniciar Sesión</button>
                <div class="login-register">
                    <p>Aún no tienes cuenta? <a href="#" class="register-link">Regístrate</a></p>
                </div>
            </form>
        </div>

        <!-- FORMULARIO DE REGISTRO -->
        <div class="form-box register">
            <h2>Registro</h2>
            <form action="/comida/index?clase=ControladorPublico&metodo=register" method="POST" onsubmit="return validarRegistro()">
                <div class="name-container">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="txtNombre" required maxlength="20">
                        <label>Nombre</label>
                    </div>
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="txtApellido" required maxlength="20">
                        <label>Apellidos</label>
                    </div>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                    <input type="tel" name="txtTelefono" required maxlength="13">
                    <label>Teléfono</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="txtEmail" required maxlength="25">
                    <label>Correo</label>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" name="txtPassword" id="passwordRegister" required maxlength="25">
                    <label>Contraseña</label>
                    <span class="toggle-password" onclick="togglePassword('passwordRegister', this)">
                        <ion-icon name="eye-off-outline"></ion-icon>
                    </span>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="bag-outline"></ion-icon></span>
                    <input type="password" id="passwordConfirm" required maxlength="25">
                    <label>Confirmar Contraseña</label>
                    <span class="toggle-password" onclick="togglePassword('passwordConfirm', this)">
                        <ion-icon name="eye-off-outline"></ion-icon>
                    </span>
                </div>

                <!-- IMPLEMENTACIÓN DEL SELECT EN PREGUNTA SECRETA -->
                <div class="input-box">
                    <span class="icon"><ion-icon name="help-circle-outline"></ion-icon></span>
                    <select name="txtPreguntaSecreta" id="preguntaSecreta" required>
                        <option value="" disabled selected>Selecciona una pregunta</option>
                        <option value="mascota">¿Cuál es el nombre de tu primera mascota?</option>
                        <option value="escuela">¿Cómo se llama la escuela donde estudiaste?</option>
                        <option value="madre">¿Cuál es el segundo nombre de tu madre?</option>
                        <option value="ciudad">¿En qué ciudad naciste?</option>
                        <option value="mejoramigo">¿Cómo se llama tu mejor amigo/a de la infancia?</option>
                        <option value="comida">¿Cuál es tu comida favorita?</option>
                    </select>
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="key-outline"></ion-icon></span>
                    <input type="text" name="txtRespuestaSecreta" required maxlength="50">
                    <label>Respuesta Secreta</label>
                </div>
                
                <p id="passwordError" style="color: red; font-size: 0.9em; display: none;">Las contraseñas no coinciden</p>
                
                <div class="remember-forgot">
                    <label><input type="checkbox" name="txtconditions" required> Acepto los términos y condiciones</label>
                </div>

                <button type="submit" class="btn">Registrarme</button>

                <div class="login-register">
                    <p>¿Ya tienes una cuenta? <a href="#" class="login-link">Iniciar sesión</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function togglePassword(id, element) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
            element.innerHTML = '<ion-icon name="eye-outline"></ion-icon>';
        } else {
            input.type = "password";
            element.innerHTML = '<ion-icon name="eye-off-outline"></ion-icon>';
        }
    }

    function validarRegistro() {
        const pass1 = document.getElementById("passwordRegister").value;
        const pass2 = document.getElementById("passwordConfirm").value;
        const mensajeError = document.getElementById("passwordError");

        if (pass1 !== pass2) {
            mensajeError.style.display = "block";
            return false;
        } else {
            mensajeError.style.display = "none";
            return true;
        }
    }
</script>

<link rel="stylesheet" href="estilos/notificaciones.css">
<script src="scripts/verificador.js"></script>
<script src="scripts/login.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<?php if (isset($_SESSION['mensaje'])): ?>
    <script>alert("<?= $_SESSION['mensaje'] ?>");</script>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>