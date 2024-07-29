<?php
// Requerir archivos de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// Requerir archivos de PHPMailer
require_once '../PHPMailer/Exception.php';
require_once '../PHPMailer/PHPMailer.php';
require_once '../PHPMailer/SMTP.php';
require_once('../Controladores/EnvioOTP/EnviarOTP.php');
require_once '../Controladores/Parametros/Parametros_mail.php';

// Función para enviar correo electrónico con OTP
function enviarCorreo($destinatario, $otp) {
    // Obtener los parámetros desde la base de datos
    $parametros = Parametro::dataServer();

    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilitar salida de depuración detallada
        $mail->isSMTP(); // Enviar usando SMTP
        $mail->Host = $parametros['Servidor_SMTP']; // Establecer el servidor SMTP para enviar a través de
        $mail->SMTPAuth = true; // Habilitar la autenticación SMTP
        $mail->Username = $parametros['Correo_SMTP']; // Nombre de usuario SMTP
        $mail->Password = $parametros['Clave_SMTP']; // Contraseña SMTP
        $mail->SMTPSecure = $parametros['Cifrado_SMTP']; // Habilitar el cifrado TLS implícito
        $mail->Port = $parametros['Puerto_SMTP']; // Puerto TCP para conectarse

        // Configuración del correo electrónico
        $mail->setFrom($parametros['Correo_SMTP'], $parametros['Nombre_Sistema']); // Remitente
        $mail->addAddress($destinatario); // Destinatario
        $mail->Subject = 'Verificación de OTP'; // Asunto
        $mail->Body = "Bienvenido\n\nSu código OTP para iniciar sesión es: " . $otp . "\n\nEste código caduca en 5 minutos."; // Mensaje

        // Enviar correo electrónico
        if (!$mail->send()) {
            echo "Error al enviar el correo electrónico: " . $mail->ErrorInfo;
        } else {
            echo "Correo electrónico enviado correctamente";
        }
    } catch (Exception $e) {
        echo "Error al enviar el correo electrónico: " . $e->getMessage();
    }
}
?>
