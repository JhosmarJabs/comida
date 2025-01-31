<?php
// session_start();
include_once 'modelo/ClsCliente.php';

class ControladorCliente
{
    private $vista;
    
    public function inicio()
    {
        $vista = "vistas/cliente/contenido.php";
        include_once("vistas/frm-cliente.php");
    }

    public function cerrar()
    {        
        session_destroy();
        header('Location: index.php');
    }

    public function menu()
    {    
        $vista = "vistas/publica/menu.php";
        include_once("vistas/frm-cliente.php");
    }

    public function perfil()
    {
        $Datos = new ClsCliente();
        $IdCliente = isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
        $respuesta = $Datos->ExtraerDatos($IdCliente);       

        $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : NULL;
        $apellidos = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : NULL;
        $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : NULL;
        $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : NULL;
        $pregunta = isset($_POST['txtPregRecup']) ? $_POST['txtPregRecup'] : NULL;
        $resp = isset($_POST['txtRespRecup']) ? $_POST['txtRespRecup'] : NULL;

        $vista = "vistas/cliente/perfil.php";
        include_once("vistas/frm-cliente.php");
    }
}
?>