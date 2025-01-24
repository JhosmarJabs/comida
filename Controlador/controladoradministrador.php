<?php
include_once 'Modelo/clsregistros.php';
include_once 'Modelo/clsreportes.php';

session_start();

class controladoradministrador
{
	private $vista;
	
    public function inicio()
    {

        $vista = "Vistas/Administrador/frmAltas.php";
        include_once("Vistas/frmadministrador.php");
    }

    public function inventario(){
        
    }

    public function cerrar()
	{		
		session_destroy();
		header('location:index.php');
	}
}