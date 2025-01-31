<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Iconos Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Estilos -->
    <link rel="stylesheet" href="estilos/principal.css">
    <link rel="stylesheet" href="estilos/navbar.css">
    <link rel="stylesheet" href="estilos/footer.css">
    <link rel="stylesheet" href="estilos/inicio.css">
    <link rel="stylesheet" href="estilos/menu.css"> 
    <link rel="stylesheet" href="estilos/login.css">
    <link rel="stylesheet" href="estilos/recuperacion.css">
    <title>Restaurante JADA</title>
</head>
<body>
    <header>
        <div class="navbar">
            <div class="logo"><a class="amarillo" href="#">Restaurante JADA</a></div>
            <ul class="links">
                <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=inicio">Inicio</a></li>
                <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=menu">Menú</a></li>
                <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=iniciarsesion">Reservas</a></li>
                <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=contacto">Contáctanos</a></li>
            </ul>
            <a href="/comida/index?clase=controladorpublico&metodo=iniciarsesion" class="action_btn">Iniciar Sesión</a>
            <div class="toggle_btn">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>

        <div class="dropdown_menu">
            <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=inicio">Inicio</a></li>
            <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=menu">Menú</a></li>
            <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=iniciarsesion">Reservas</a></li>
            <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=contacto">Contáctanos</a></li>
            <li class="link-navbar"><a class="amarillo" href="/comida/index?clase=controladorpublico&metodo=iniciarsesion" class="action_btn">Iniciar Sesión</a></li>
        </div>
    </header>

    <main>
        <?php include_once($vista); ?> 
    </main>

    <footer class="pie-pagina">
        <p>&copy; 2024 Restaurante Gourmet. Página desarrollada por alumnos de la UTHH con fines educativos.</p>
        <nav class="navegacion-pie-pagina">
            <a href="#">Política de Privacidad</a>
            <a href="#">Términos y Condiciones</a>
        </nav>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.querySelector('.toggle_btn');
            const toggleBtnIcon = document.querySelector('.toggle_btn i');
            const dropDownMenu = document.querySelector('.dropdown_menu');

            toggleBtn.addEventListener('click', function () {
                dropDownMenu.classList.toggle('open');
                toggleBtnIcon.classList = dropDownMenu.classList.contains('open') 
                    ? 'fa-solid fa-xmark' 
                    : 'fa-solid fa-bars';
            });
        });
    </script>
</body>
</html>
