<?php
session_start();
include_once 'Modelo/clscliente.php';

class controladorcliente
{
	private $vista;
	
	public function inicio()
	{
		$vista="Vistas/Cliente/frmcontenidocliente.php";
        include_once("Vistas/frmCliente.php");
	}
	public function cerrar()
	{		
		session_destroy();
		header('location:index.php');
	}
    public function menu()
	{	
		$vista="Vistas/Publica/frmmenu.php";
        include_once("Vistas/frmCliente.php");
    }


    public function perfil(){
        $Datos = new clscliente();
        $IdCliente= isset($_SESSION['id']) ? $_SESSION['id'] : NULL;
        $respuesta = $Datos->ExtraerDatos($IdCliente);       
        if (empty($_POST)){
            $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : NULL;
            $apellidos = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : NULL;
            $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : NULL;
            $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : NULL;
            $pregunta = isset($_POST['txtPregRecup']) ? $_POST['txtPregRecup'] : NULL;
            $resp = isset($_POST['txtRespRecup']) ? $_POST['txtRespRecup'] : NULL;
        }
        $vista="Vistas/Cliente/frmPerfil.php";
        include_once("Vistas/frmCliente.php");
    }
}
?>


