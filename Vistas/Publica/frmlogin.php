<div class="container-login">
        <div class="wrapper">
            <span class="icon-close">
                <ion-icon name="close"></ion-icon>
            </span>
            
            <div class="form-box login">
                <h2>Iniciar sesion</h2>
                <form action="/comida/index?clase=controladorpublico&metodo=login" method="POST">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" name="txtEmailI" id="" class="patron-correo requerido">
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
                        <label><input type="checkbox" name="txtremember" id=""> Recordar</label>
                        <a href="#">Olvidaste la contraseña?</a>
                    </div>
                    <button type="submit" class="btn">Iniciar Sesion</button>
                    <div class="login-register">
                        <p>Aun no tienes cuenta? <a href="#" class="register-link">Resgistrate</a></p>
                    </div>
                </form>
            </div>
            <div class="form-box register">
                <h2>Registro</h2>
                <form action="/comida/index?clase=controladorpublico&metodo=register" method="POST">
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="txtNombre" id="nombre" required maxlength="20">
                        <label>Nombre</label>
                    </div>
                    
                    <div class="input-box">
                        <span class="icon"><ion-icon name="person"></ion-icon></span>
                        <input type="text" name="txtApellido" id="apellido" required maxlength="20">
                        <label>Apellidos</label>
                    </div>
                    
                    <div class="input-box">
                        <span class="icon"><ion-icon name="call-outline"></ion-icon></span>
                        <input type="tel" name="txtTelefono" id="telefono" required maxlength="13">
                        <label>Teléfono</label>
                    </div>
                    
                    <div class="input-box">
                        <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                        <input type="email" name="txtEmail" id="correo" required maxlength="25">
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
                    
                    
                    <!-- Mensaje de error si las contraseñas no coinciden -->
                    <p id="passwordError" style="color: red; font-size: 0.9em; display: none;">Las contraseñas no coinciden</p>
                    
                    <div class="remember-forgot">
                    <label><input type="checkbox" name="txtconditions" id="" required> Acepto los términos y condiciones</label>
                    </div>
                        <button type="submit" class="btn">Registrarme</button>
                    <div class="login-register">
                        <p>¿Ya tienes una cuenta? <a href="#" class="login-link">Iniciar sesión</a></p>
                    </div>
                </form>
            </div>
            </div>
        </div>
        </div>
        <script src="script/verificador.js"></script>
        <script>
            const wrapper = document.querySelector('.wrapper');
            const loginLink = document.querySelector('.login-link');
            const registerLink = document.querySelector('.register-link');
            const btnPopup = document.querySelector('.btnLogin-popup');
            const iconClose = document.querySelector('.icon-close');
    
            registerLink.addEventListener('click', () => {
            wrapper.classList.add('active');
            });
    
            loginLink.addEventListener('click', () => {
            wrapper.classList.remove('active');
            });
            document.addEventListener("DOMContentLoaded", function () {
                const inputs = document.querySelectorAll(".input-box input");
        
                inputs.forEach(input => {
                    input.addEventListener("input", function () {
                        if (this.value.trim() !== "") {
                            this.classList.add("filled");
                        } else {
                            this.classList.remove("filled");
                        }
                    });
                });
            });

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

        document.addEventListener("DOMContentLoaded", function () {
            const password = document.getElementById("passwordRegister");
            const confirmPassword = document.getElementById("passwordConfirm");
            const errorMessage = document.getElementById("passwordError");
            const form = document.querySelector("form[action*='register']");

            function validatePasswords() {
                if (password.value !== confirmPassword.value) {
                    errorMessage.style.display = "block";
                    return false;
                } else {
                    errorMessage.style.display = "none";
                    return true;
                }
            }

            confirmPassword.addEventListener("input", validatePasswords);

            form.addEventListener("submit", function (event) {
                if (!validatePasswords()) {
                    event.preventDefault(); // Evita el envío si las contraseñas no coinciden
                }
            });
        });
        </script>
        
        
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    