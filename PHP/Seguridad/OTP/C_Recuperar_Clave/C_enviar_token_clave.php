<?php
ob_start(); // Iniciar el buffer de salida para capturar toda la salida y evitar este tipo de errores.
function enviarOTP2($conexion, $correo2) {
    require_once './C_generar_token_clave.php';
    require_once('../../../PHPMailer/C_correo_clave.php');
    
    // Iniciar sesión si no está iniciada
$otp2 = generarCodigoOTP2(); // Generar OTP
// Almacenar OTP en la sesión
$_SESSION['otp2'] = $otp2;
// Actualizar código OTP y fecha de expiración en la base de datos
$update_codigo_otp2 = "UPDATE tbl_ms_usuario SET CodigoOTP = '$otp2', FechaExpiracionOTP = DATE_ADD(NOW(), INTERVAL 5 MINUTE) WHERE Correo = '$correo2'";
$resultado_update2 = mysqli_query($conexion, $update_codigo_otp2);  
if ($resultado_update2) {
      // Enviar correo electrónico con el OTP
      enviarCorreo2($correo2, $otp2);
      header("location: ../V_Recuperar_Clave/V_verificar_token.php"); // Redirigir a la página de verificación de pin
} else {
    echo '<script>alert("Error al actualizar el código OTP en la base de datos.");</script>';
}
}
?>
