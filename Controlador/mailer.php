<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

// Cargar PHPMailer correctamente
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// 🔐 VARIABLES DE ENTORNO (MEJOR SEGURIDAD)
$smtp_host = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
$smtp_user = getenv('SMTP_USER') ?: 'soportjada@gmail.com';
$smtp_pass = getenv('SMTP_PASS') ?: '%%$7$m@@MBa1^&'; // ⚠️ Mueve 
$smtp_port = getenv('SMTP_PORT') ?: 587;

$mail->Username = 'soportjada@gmail.com'; 
$mail->Password = '%%$7$m@@MBa1^&$';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;


function enviarCorreo($destino, $asunto, $mensaje) {
    global $smtp_host, $smtp_user, $smtp_pass, $smtp_port;

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = $smtp_host; 
        $mail->SMTPAuth = true;
        $mail->Username = $smtp_user; 
        $mail->Password = $smtp_pass; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = $smtp_port;

        // Configuración del correo
        $mail->setFrom($smtp_user, 'Soporte JADA'); // El remitente debe coincidir con el usuario SMTP
        $mail->addAddress($destino);
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        // Enviar correo
        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Error al enviar correo: " . $mail->ErrorInfo); // Para depuración
        return false;
    }
}
?>
