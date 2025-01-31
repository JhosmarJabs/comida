<?php
session_start();

class ControladorAdministrador
{
    private $vista;

    public function inicio()
    {
        $vista = "vistas/administrador/altas.php";
        include_once("vistas/frm-administrador.php");
    }

    public function cerrar()
    {        
        session_destroy();
        header('Location: index.php');
    }
}
