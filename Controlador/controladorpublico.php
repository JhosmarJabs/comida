<?php
include_once 'Modelo/clslogin.php';

class controladorpublico
{
    private $vista;

    public function inicio()
    {
        // $registroZonas = new clsregistros();
        // $zonas = $registroZonas->ConsultaZona();    

        // $registroMesas = new clsregistros();
        // $mesas = $registroMesas->ConsultaMesas();   
            
        $vista = "Vistas/publica/frmcontenidopublico.php";
        include_once("Vistas/frmpublica.php");
    }    

    public function iniciarsesion(){
        $vista = "Vistas/Publica/frmlogin.php";
        include_once("Vistas/frmpublica.php");
    }

    public function login() // aqui esta tu funcion que se manda a llamar desde tu frm
    {
        $acceso = new clslogin();
        if (!empty($_POST))
        {
            $email = isset($_POST['txtEmailI']) ? $_POST['txtEmailI'] : NULL;
            $password = isset($_POST['txtPasswordI']) ? $_POST['txtPasswordI'] : NULL;
            $result = $acceso->ConsultaUsuario($email, $password);
            $datos = $acceso->ConsultarDatos($email);
    
            if ($result !== null && $datos !== null) {
                $resultado = $result['respuesta'];
                $tipoUsuario = $datos['TipoUsuario'];

                // aqui estoy diciendole que me imprima los datos que esta resibiendo las variables
                echo '<pre>';
                print_r($resultado, $tipoUsuario);
                echo '</pre>';
    
                // Comprobamos el tipo de usuario
                if ($tipoUsuario == 'Cliente') {
                    if ($resultado == true)
                    {
                        session_start();
                        $_SESSION['id'] = $datos['idUsuario'];
                        $_SESSION['nombre'] = $datos['vchNombre'];
                        header('Location: /comida/index?clase=controladorcliente&metodo=inicio');
                        exit();
                        
                    }
                    else
                    {
                        $vista = "Vistas/Publica/frmlogin.php";
                        include_once("Vistas/frmpublica.php");
                    }
                } elseif ($tipoUsuario == 'Administrador') {
                    if ($resultado == true)
                    {
                        session_start();
                        $_SESSION['id'] = $datos['idUsuario'];
                        $_SESSION['nombre'] = $datos['vchNombre'];
                        header('Location: /comida/index?clase=controladoradministrador&metodo=inicio');
                        exit();
                    }
                    else
                    {
                        $vista = "Vistas/Publica/frmlogin.php";
                        include_once("Vistas/frmpublica.php");
                    }
                } else {
                    $vista = "Vistas/Publica/frmlogin.php";
                    include_once("Vistas/frmpublica.php");
                }
            } else {
                $vista = "Vistas/Publica/frmlogin.php";
                include_once("Vistas/frmpublica.php");
            }
        } else {
            $vista = "Vistas/Publica/frmlogin.php";
            include_once("Vistas/frmpublica.php");
        }
    }

    public function register() {
        $acceso = new clslogin();
        if (!empty($_POST)) {
            $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : NULL;
            $apellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : NULL;
            $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : NULL;
            $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : NULL;
            $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : NULL;
            $registro = $acceso->RegistrarUsuario($nombre, $apellido, $telefono, $email, $password);
            $result = $acceso->ConsultaUsuario($email, $password);
            $datos = $acceso->ConsultarDatos($email);

            $resultado =  $result['respuesta'];

            if ($resultado == true)
            {
                session_start();
                $_SESSION['id'] = $datos['idUsuario'];
                $_SESSION['nombre'] = $datos['vchNombre'];
                header('Location: /comida/index?clase=controladorcliente&metodo=inicio');
                exit();
            }
            else
            {
                $vista = "Vistas/Publica/frmlogin.php";
                include_once("Vistas/frmpublica.php");
            }
        } else {
            $vista = "Vistas/Publica/frmlogin.php";
            include_once("Vistas/frmpublica.php");
        }
    }

    public function menu()
	{	
    //     $registroComida = new clsregistros();
    //     $Comidas = $registroComida->ConsultaComidas(); 
    //     $registroBebidas = new clsregistros();
    //     $Bebidas = $registroBebidas->ConsultaBebidas(); 
    //     $registroPostres = new clsregistros();
    //     $Postres = $registroPostres->ConsultaPostres(); 
		$vista="Vistas/Publica/frmmenu.php";
        include_once("Vistas/frmpublica.php");
    }

    // public function Detalles()
    // {   
    //     $idCon = isset($_GET['id']) ? $_GET['id'] : null; // Captura el ID de la URL
    //     $tipo = isset($_GET['Tipo']) ? $_GET['Tipo'] : null; // Captura el Tipo de de comida o postre o bebida
    //     $ConsultaProductos = new clsregistros();
        
    //     if($idCon && $tipo) { // Verificamos que ambos parámetros estén presentes
    //         $producto = $ConsultaProductos->ConsultaProductosDetalle($idCon, $tipo);// los manda al la bd
    //     } else {
    //         echo "No se proporcionó un ID o Tipo válido.";
    //     }
    //     $vista = "Vistas/Publica/frmdetalles.php";
    //     include_once("Vistas/frmpublica.php");
    // }
    
    
    
}
?>
