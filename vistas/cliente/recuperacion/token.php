<div class="contenedor-recuperacion">
    <div class="recuperacion-container">
        <h2>Recuperación de Contraseña</h2>
        
        <button type="button" class="recuperacion-button" onclick="enviarToken()">Enviar Token de Recuperación</button>
        <br>

        <!-- FORMULARIO PARA ENVIAR EL CÓDIGO -->
        <form id="formCodigo" action="/comida/index?clase=ControladorPublico&metodo=token" method="POST">
            <div class="codigo-container">
                <input type="text" class="codigo-input" maxlength="1" oninput="moverFoco(0, this)" name="codigo[]">
                <input type="text" class="codigo-input" maxlength="1" oninput="moverFoco(1, this)" name="codigo[]">
                <input type="text" class="codigo-input" maxlength="1" oninput="moverFoco(2, this)" name="codigo[]">
                <span class="codigo-separador">-</span>
                <input type="text" class="codigo-input" maxlength="1" oninput="moverFoco(3, this)" name="codigo[]">
                <input type="text" class="codigo-input" maxlength="1" oninput="moverFoco(4, this)" name="codigo[]">
                <input type="text" class="codigo-input" maxlength="1" oninput="moverFoco(5, this)" name="codigo[]">
            </div>

            <!-- Input oculto donde se almacenará el código -->
            <input type="hidden" name="txtToken" id="txtToken">

            <button type="submit" class="recuperacion-button" id="btnSiguiente" disabled>Siguiente</button>
        </form>
    </div>
</div>

<script>
    function moverFoco(index, input) {
        let inputs = document.querySelectorAll(".codigo-input");

        if (input.value && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
        if (!input.value && index > 0) {
            inputs[index - 1].focus();
        }
        
        // Habilitar botón solo si están todos los campos llenos
        let codigoCompleto = Array.from(inputs).every(inp => inp.value);
        document.getElementById("btnSiguiente").disabled = !codigoCompleto;

        // Unir el código en el input oculto
        document.getElementById("txtToken").value = Array.from(inputs).map(inp => inp.value).join("");
    }

    function enviarToken() {
        alert("Se ha enviado un token de recuperación a tu correo.");
        window.location.href = "/comida/index?clase=controladorPublico&metodo=enviarToken";
    }
</script>

<?php if (isset($_SESSION['msj'])): ?>
    <script>
        alert("<?= $_SESSION['msj'] ?>");
    </script>
    <?php unset($_SESSION['msj']); ?>
<?php endif; ?>
