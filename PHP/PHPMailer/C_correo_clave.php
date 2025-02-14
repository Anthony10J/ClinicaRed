<?php
// Requerir archivos de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Requerir archivos de PHPMailer
require_once 'Exception.php';
require_once 'PHPMailer.php';
require_once 'SMTP.php';
    
// Función para enviar correo electrónico con OTP
function enviarCorreo2($destinatario, $otp2) {
  // Crear una instancia de PHPMailer
  $mail = new PHPMailer(true);

  try {
    // Configuración del servidor
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Habilitar salida de depuración detallada
    $mail->isSMTP(); // Enviar usando SMTP
    $mail->Host = 'smtp.gmail.com'; // Establecer el servidor SMTP para enviar a través de
    $mail->SMTPAuth = true; // Habilitar la autenticación SMTP
    $mail->Username = 'redelectrodiagnostico@gmail.com'; // Nombre de usuario SMTP
    $mail->Password = 'dxhw qqnv jxql zseh'; // Contraseña SMTP
    $mail->SMTPSecure = "SSL"; // Habilitar el cifrado TLS implícito
    $mail->Port = 587; // Puerto TCP para conectarse; use 587 si ha establecido `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    // Configuración del correo electrónico
    $mail->setFrom('redelectrodiagnostico@gmail.com', 'Clinica RED'); // Remitente
    $mail->addAddress($destinatario); // Destinatario
    $mail->Subject = 'RECUPERAR CONTRASENA';
    $mail->Body = "Bienvenido\n\n Su código OTP para recuperar la contraseña es: " . $otp2 . "\n\nEste código caduca en 5 minutos.";
    //"Bienvenido\n\n Su código OTP para iniciar sesión es: 
    //" . $otp . "\n\nEste código caduca en 5 minutos."; // Mensaje

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