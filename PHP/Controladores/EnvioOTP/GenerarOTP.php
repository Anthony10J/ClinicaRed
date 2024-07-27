<?php
// Función para generar un código OTP aleatorio
function generarCodigoOTP() {
  $otp = random_int(100000, 999999);
  return $otp;
}

// Iniciar sesión
if (isset($_POST['iniciar_sesion'])) {
    $correo = $_POST['correo'];
    $clave = $_POST['password'];
    $clave_encriptada = md5($clave);
  // Validar usuario y contraseña
  // ...

  // Generar código OTP
  $otp = generarCodigoOTP();

  // Enviar código OTP por correo electrónico
  // ...

  // Almacenar código OTP en la variable de sesión
  $_SESSION['otp'] = $otp;
}
?>
