<div class="contenedor-recuperacion">
    <div class="recuperacion-container">
        <h2>Ingresa tu nueva contraseña</h2>

        <!-- Formulario con action y método POST -->
        <form id="recuperacionForm" action="/comida/index?clase=ControladorPublico&metodo=contraseña" method="POST">
            <input type="password" class="recuperacion-input" id="nuevaPassword" name="txtnuevaContraseña" placeholder="Nueva contraseña" required>
            <br>
            <input type="password" class="recuperacion-input" id="confirmarPassword" name="confirmarContraseña" placeholder="Confirmar contraseña" required>
            <br>
            <button type="submit" class="recuperacion-button">Siguiente</button>
        </form>
    </div>

    <script>
        // Agregar evento al formulario para validar antes de enviar
        document.getElementById("recuperacionForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío automático del formulario

            const nuevaPass = document.getElementById("nuevaPassword").value;
            const confirmarPass = document.getElementById("confirmarPassword").value;

            // Validación de la contraseña
            if (nuevaPass.length < 6) {
                alert("La contraseña debe tener al menos 6 caracteres.");
                return;
            }

            if (nuevaPass !== confirmarPass) {
                alert("Las contraseñas no coinciden.");
                return;
            }

            this.submit(); // Envía el formulario si las validaciones son correctas
        });

        // Mostrar mensaje desde PHP si existe
        <?php if (isset($_SESSION['msj'])): ?>
            alert("<?= $_SESSION['msj'] ?>");
            <?php unset($_SESSION['msj']); ?>
        <?php endif; ?>
    </script>
</div>
