<form action="/comida/index?clase=ControladorPublico&metodo=correo" method="POST">
    <div class="contenedor-recuperacion">
        <div class="recuperacion-container">
            <h2>Ingresa tu correo</h2>
            <input type="email" class="recuperacion-input" name="txtCorreo" placeholder="Correo electrónico" required>
            <br>
            <button type="submit" class="recuperacion-button">Siguiente</button>
        </div>
    </div>
</form>

<?php if (isset($_SESSION['error'])): ?>
    <script>
        alert("<?= $_SESSION['error'] ?>");
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>