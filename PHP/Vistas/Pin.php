<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Si ya existe una sesión autenticada, redirigir al usuario a la página principal
if (isset($_SESSION['autenticado']) && $_SESSION['correo'] === true) {
    header("Location: Main.php");
    exit();
}
// Incluir el script verificarOTP.php
include('../Controladores/EnvioOTP/verificarOTP.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equivs="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../EstilosLogin/css/EstilosPin.css">
    <link rel="stylesheet" href="../../EstilosLogin/css/EstilosValidaciones.css">
    <title>Verificacion OTP</title>
    <link rel="shortcut icon" href="../../EstilosLogin/images/pestana.png" type="image/x-icon">
</head>
<body>
    <main>
        <div>
            <?php if(isset($error)) { echo "<p>$error</p>";} ?>
            
            <form action="../Controladores/EnvioOTP/verificarOTP.php" method="POST" class="OTP" id="form_OTPMain">
            <img src="../../../EstilosLogin/images/logo.png" alt="">
                <h4 for="codigo_otp">Ingrese el código OTP recibido por correo electrónico:</h4><br>
                <div class="input-wrapper">
                    <!-- GRUPO CODIGO OTP -->
                    <div class="formulario__grupo" id="grupo__codigo_otp">
                        <!-- <label for="codigo_otp" class="formulario__label">Confirmar Contraseña</label> -->
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="codigo_otp" id="codigo_otp"
                                placeholder="Ingresa el código OTP" required maxlength="6" autocomplete="off">
                                <img class="input-icon" src="../../../Imagenes/password.svg" alt="">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>
                </div>
                <input class="btn" type="submit" name="register" value="Enviar"><br>
                 <a href="/index.php">Regresar al Login</a>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module" src="../javascript/validacionOTPMain.js"></script>
</body>
</html>