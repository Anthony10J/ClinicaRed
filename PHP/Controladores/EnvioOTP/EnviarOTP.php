<?php  
function enviarOTP($conexion, $correo) {
    require_once('GenerarOTP.php');
    require_once('../PHPMailer/controllermail.php');
    
$otp = generarCodigoOTP(); // Generar OTP
// Almacenar OTP en la sesión
$otp_encriptado = md5($otp);
$_SESSION['otp'] = $otp_encriptado;
// Actualizar código OTP y fecha de expiración en la base de datos
$update_codigo_otp = "UPDATE tbl_ms_usuario SET CodigoOTP = '$otp_encriptado', FechaExpiracionOTP = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE Correo = '$correo'";
$resultado_update = mysqli_query($conexion, $update_codigo_otp);  
if ($resultado_update) {
    header("location: ../Vistas/Pin.php"); // Redirigir a la página de verificación de pin
    // Enviar correo electrónico con el OTP
    enviarCorreo($correo, $otp);
    
} else {
    echo '<script>alert("Error al actualizar el código OTP en la base de datos.");</script>';
}
}
?>