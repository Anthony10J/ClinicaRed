<?php
function generarCodigoOTP2() {
  $otp2 = random_int(100000, 999999);
  return $otp2;
}

// // Iniciar sesión
// if (isset($_POST['iniciar_sesion'])) {
//   $correo = $_POST['correo'];
// // Generar código OTP
// $otp2 = generarCodigoOTP2();
// // Enviar código OTP por correo electrónico
// // ...
// // Almacenar código OTP en la variable de sesión
// //$_SESSION['otp2'] = $otp2;
// }
?>
