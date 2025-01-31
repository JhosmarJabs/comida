<?php
include_once 'modelo/ClsLogin.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class ControladorPublico
{
    private $vista;

    public function inicio()
    {
        $vista = "vistas/publica/contenido.php";
        include_once("vistas/frm-publica.php");
    }    

    public function iniciarsesion()
    {
        $vista = "vistas/publica/login.php";
        include_once("vistas/frm-publica.php");
    }

    public function login()
    {
        $acceso = new ClsLogin();
        if (!empty($_POST)) {
            $email = isset($_POST['txtEmailI']) ? $_POST['txtEmailI'] : NULL;
            $password = isset($_POST['txtPasswordI']) ? $_POST['txtPasswordI'] : NULL;
            $result = $acceso->ConsultaUsuario($email, $password);
            $datos = $acceso->ConsultarDatos($email);

            if ($result !== null && $datos !== null) {
                $resultado = $result['respuesta'];
                $tipoUsuario = $datos['TipoUsuario'];

                if ($tipoUsuario == 'Cliente' && $resultado == true) {
                    session_start();
                    $_SESSION['id'] = $datos['idUsuario'];
                    $_SESSION['nombre'] = $datos['vchNombre'];
                    header('Location: /comida/index?clase=ControladorCliente&metodo=inicio');
                    exit();
                } elseif ($tipoUsuario == 'Administrador' && $resultado == true) {
                    session_start();
                    $_SESSION['id'] = $datos['idUsuario'];
                    $_SESSION['nombre'] = $datos['vchNombre'];
                    header('Location: /comida/index?clase=ControladorAdministrador&metodo=inicio');
                    exit();
                }
            }
        }

        $vista = "vistas/publica/login.php";
        include_once("vistas/frm-publica.php");
    }

    public function register() {
        $acceso = new clslogin();
        
        if (!empty($_POST)) {
            $nombre = isset($_POST['txtNombre']) ? $_POST['txtNombre'] : NULL;
            $apellido = isset($_POST['txtApellido']) ? $_POST['txtApellido'] : NULL;
            $telefono = isset($_POST['txtTelefono']) ? $_POST['txtTelefono'] : NULL;
            $email = isset($_POST['txtEmail']) ? $_POST['txtEmail'] : NULL;
            $password = isset($_POST['txtPassword']) ? $_POST['txtPassword'] : NULL;
            $pregunta = isset($_POST['txtPreguntaSecreta']) ? $_POST['txtPreguntaSecreta'] : NULL;
            $respuesta = isset($_POST['txtRespuestaSecreta']) ? $_POST['txtRespuestaSecreta'] : NULL;
    
            if ($acceso->ConsultaEmail($email)) {
                $mensaje = "Error: El correo ya está registrado.";
                $tipo = "error";
            } else {
                $registro = $acceso->RegistrarUsuario($nombre, $apellido, $telefono, $email, $password, $pregunta, $respuesta);
                $result = $acceso->ConsultaUsuario($email, $password);
                $datos = $acceso->ConsultarDatos($email);
    
                if ($result['respuesta'] == true) {
                    session_start();
                    $_SESSION['id'] = $datos['idUsuario'];
                    $_SESSION['nombre'] = $datos['vchNombre'];
                    $mensaje = "¡Registro exitoso! Bienvenido a Restaurante JADA.";
                    $tipo = "exito";
                    header('Location: /comida/index?clase=ControladorCliente&metodo=inicio');
                } else {
                    $mensaje = "Error: No se pudo completar el registro.";
                    $tipo = "error";
                }
            }
        }
    
        $vista = "vistas/publica/login.php";
        include_once("vistas/frm-publica.php");
    }
    
    public function menu()
    {
        $vista = "vistas/publica/menu.php";
        include_once("vistas/frm-publica.php");
    }
    // -----------------------------------------Modulo de Recuperación-----------------------------------------

    public function correo()
    {
        session_start();
        $acceso = new ClsLogin();

        if (!empty($_POST['txtCorreo'])) {
            $email = $_POST['txtCorreo'];
            
            if ($acceso->ConsultaEmail($email)) {
                $_SESSION['email_recuperacion'] = $email;
                header('Location: /comida/index?clase=ControladorPublico&metodo=pregunta');
                exit();
            } else {
                $_SESSION['error'] = "El correo no está registrado.";
            }
        }

        $vista = "vistas/cliente/recuperacion/correo.php";
        include_once("vistas/frm-publica.php");
    }

    public function pregunta()
    {
        session_start();
        $acceso = new ClsLogin();

        if (isset($_SESSION['email_recuperacion'])) {
            $email = $_SESSION['email_recuperacion'];
            $datos = $acceso->ObtenerPreguntaSecreta($email);
            

            if ($datos) {
                $_SESSION['pregunta_secreta'] = $datos['vchPreguntaRecup'];
                // header('Location: /comida/index?clase=controladorPublico&metodo=token');
            } else {
                $_SESSION['error'] = "Error al recuperar la pregunta secreta";
                header('Location: /comida/index?clase=controladorPublico&metodo=pregunta');
                exit();
            }
        }

        $vista = "vistas/cliente/recuperacion/pregunta.php";
        include_once("vistas/frm-publica.php");
    }

    public function verificarPregunta()
    {
        session_start();
        $acceso = new ClsLogin();
    
        if (isset($_SESSION['email_recuperacion'])) {
            $email = $_SESSION['email_recuperacion'];
    
            if (isset($_POST['pregunta']) && isset($_POST['respuesta'])) {
                $pregunta = $_POST['pregunta'];
                $respuesta = strtolower(trim($_POST['respuesta'])); // Convierte a minúsculas y elimina espacios
    
                $datos = $acceso->ObtenerPreguntaSecreta($email);
                
                if ($datos && strtolower(trim($datos['vchRespuestaRecup'])) === $respuesta) {
                    $_SESSION['pregunta_validada'] = true;
                    header('Location: /comida/index?clase=ControladorPublico&metodo=token');
                    exit();
                } else {
                    $_SESSION['error'] = "Respuesta incorrecta. $";
                    header('Location: /comida/index?clase=ControladorPublico&metodo=pregunta');
                    exit();
                }
            } else {
                $_SESSION['error'] = "Debes completar todos los campos.";
                header('Location: /comida/index?clase=ControladorPublico&metodo=pregunta');
                exit();
            }
        } else {
            $_SESSION['error'] = "No hay sesión activa.";
            header('Location: /comida/index?clase=ControladorPublico&metodo=login');
            exit();
        }
    }    
    
public function enviarToken(){
    session_start();
    $acceso = new ClsLogin();
    $email = $_SESSION['email_recuperacion'];
    $token = $acceso->GenerarCodigoRecuperacion($email);

    if ($token) {
        try {
            require 'modelo/phpMailer/PHPMailer.php';
            require 'modelo/phpMailer/SMTP.php';
            require 'modelo/phpMailer/Exception.php';

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer(true);

            $mail->SMTPDebug = 2;

            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.hostinger.com'; 
            $mail->SMTPAuth = true;
            $mail->Username = 'floreria@floribella.com'; 
            $mail->Password = 'sM9JGwA3$';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;
            $mail->CharSet = 'UTF-8';

            // Remitente y destinatario
            $mail->setFrom('floreria@floribella.com', 'floreria');
            $mail->addAddress($email);

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = 'Recuperación de Contraseña De JADA Company';
            $mail->Body = "<p>Recibimos una solicitud para recuperar tu contraseña. Si no solicitaste esto, ignora este correo. $token . Este es tu código no lo compartas.</p>";

            // Enviar el correo
            $mail->send();
            $mensaje = 'Correo enviado con éxito. Revisa tu bandeja de entrada.';
            $_SESSION['msj'] = "Exito. '$mensaje', $email";
        } catch (Exception $e) {
            $mensaje = "Error al enviar el correo: {$mail->ErrorInfo}";
            $_SESSION['msj'] = "Código incorrecto o expirado. '$mensaje'";
        }
    } else {
        $mensaje = "El correo ingresado no está registrado.";
        $_SESSION['msj'] = "Código incorrecto o expirado. '$mensaje'";
    }
    $vista = "vistas/cliente/recuperacion/token.php";
    include_once("vistas/frm-publica.php");
}

    public function token()
    {
        session_start();
        $acceso = new ClsLogin();
        $email = $_SESSION['email_recuperacion'];

        if (!empty($_POST['txtToken'])) {
            $codigo = trim($_POST['txtToken']); // Asegurarse de eliminar espacios en blanco
    
            $_SESSION['msj'] = "Este es tu código: '$codigo'.";

            if ($acceso->ValidarCodigoRecuperacion($email, $codigo)) {
                $_SESSION['codigo_validado'] = true;
                header('Location: /comida/index?clase=ControladorPublico&metodo=contraseña');
                exit();
            } else {
                $_SESSION['msj'] = "Código incorrecto o expirado. '$codigo'";
                header('Location: /comida/index?clase=ControladorPublico&metodo=token');
                exit();
            }
        } else {
            $vista = "vistas/cliente/recuperacion/token.php";
            include_once("vistas/frm-publica.php");
        }
    }

    public function contraseña()
    {
        session_start();
        $acceso = new ClsLogin();

        if (!empty($_POST['txtnuevaContraseña'])) {
            $email = $_SESSION['email_recuperacion'] ?? null;
            $nuevaPassword = $_POST['txtnuevaContraseña'];

            if ($email) {
                $acceso->ActualizarPassword($email, $nuevaPassword);
                $_SESSION['msj'] = "¡Contraseña actualizada exitosamente!";
                header('Location: /comida/index?clase=ControladorPublico&metodo=iniciarsesion');
                exit();
            }else{
                $_SESSION['msj'] = "Error! '$email', '$nuevaPassword'";
            }
            $_SESSION['msj'] = "Error! '$email', '$nuevaPassword'";
        }

        $vista = "vistas/cliente/recuperacion/contraseña.php";
        include_once("vistas/frm-publica.php");
    }
}
?>
