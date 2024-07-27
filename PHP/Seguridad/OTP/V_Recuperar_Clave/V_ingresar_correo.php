<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
// Incluir el script verificarOTP.php
include('../C_Recuperar_Clave/C_enviar_token_clave.php');
include("../../../Controladores/Conexion/Conexion_be.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equivs="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../EstilosLogin/css/Estilosrecovery/V_Correorecovery.css">
    <link rel="stylesheet" href="../../../../EstilosLogin/css/EstilosValidaciones.css">
    <link rel="shortcut icon" href="../../../../EstilosLogin/images/pestana.png" type="image/x-icon">
    <title>Recuperar Contrasena</title>
    
    <script src="https://www.google.com/recaptcha/api.js" ></script>
</head>
<body>
    <main>
        <div>
            <?php if(isset($error)) { echo "<p>$error</p>";} ?>
            <form action="../C_Recuperar_Clave/C_recovery_controller.php" method="POST" class="OTP" id="formCorreoCambioClave" >
            <img src="../../../../EstilosLogin/images/logo.png" alt="">
                <H4>¿No Recuerdas tu Contraseña?</h4><br>
                <div class="" id="">
                        <!-- <label for="correo3">Ingrese su Correo Electrónico:</label> -->
                        <div class="">
                    <!-- GRUPO CORREO ELECTRÓNICO -->
                    <div class="formulario__grupo" id="grupo__correo3">
                        <!-- <label for="correo3" class="formulario__label">Confirmar Contraseña</label> -->
                        <div class="formulario__grupo-input">
                            <input type="email" class="input_mail" name="correo3" id="correo3" placeholder="Ingresa el correo electrónico" required maxlength="40" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>
                        </div>
                    </div>
                    <input class="btn" type="submit" name="register" id="botonEnviar" value="Enviar" >
                <br>
                <div class= "g-recaptcha" data-sitekey="6LclhcgpAAAAAHoe1nZb2Tlln0LYFawAKqpVI93z" id="captcha" ></div>
                <br>
                <div style="text-align: center;"><a href="/index.php">Regresar al Login</a> </div>
                <br>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="module"src="../../../javascript/validacionCorreoCambioClave.js"></script>

</body>
</html>