<div class="contenedor-recuperacion">
    <div class="recuperacion-container">
        <h2>Selecciona tu pregunta secreta</h2>
        <form action="/comida/index?clase=ControladorPublico&metodo=verificarPregunta" method="POST">
            <select class="recuperacion-select" name="pregunta" id="pregunta">
                <option value="" disabled selected>Selecciona una pregunta</option>
                <option value="mascota">¿Cuál es el nombre de tu primera mascota?</option>
                <option value="escuela">¿Cómo se llama la escuela donde estudiaste?</option>
                <option value="madre">¿Cuál es el segundo nombre de tu madre?</option>
                <option value="ciudad">¿En qué ciudad naciste?</option>
                <option value="mejoramigo">¿Cómo se llama tu mejor amigo/a de la infancia?</option>
                <option value="comida">¿Cuál es tu comida favorita?</option>
            </select>
            <br>
            <h2>Ingresa la respuesta</h2>
            <input type="text" class="recuperacion-input" name="respuesta" id="respuesta" placeholder="Escribe tu respuesta">
            <br>
            <button type="submit" class="recuperacion-button">Siguiente</button>
        </form>
    </div>
</div>
<?php if (isset($_SESSION['error'])): ?>
    <script>
        alert("<?= $_SESSION['error'] ?>");
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
