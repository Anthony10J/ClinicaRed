<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../EstilosLogin/css/Estilosrecovery/V_verificarOTP.css">
    <link rel="stylesheet" href="../../../../EstilosLogin/css/EstilosValidaciones.css">
    <title>Recuperar Contraseña</title>
    <link rel="shortcut icon" href="../../../../EstilosLogin/images/pestana.png" type="image/x-icon">
</head>
<body>
    <main>
        <div>
            <?php 
            include("../C_Recuperar_Clave/C_validar_token_clave.php");
            ?>
            <form action="../V_Recuperar_Clave/V_cambiar_clave.php" method="POST" class="OTP" id="formOTP" >
            <img src="../../../../EstilosLogin/images/logo.png" alt="">
                <h4 for="codigo_otp2">Ingrese el código OTP recibido por correo electrónico:</h4><br>
                <div class="input-wrapper">
                    <!-- <input type="text" id="codigo_otp2" name="codigo_otp2" required maxlength="6" autocomplete="off"><br> -->

                    <!-- GRUPO CODIGO OTP -->
                    <div class="formulario__grupo" id="grupo__codigo_otp2">
                        <!-- <label for="codigo_otp2" class="formulario__label">Confirmar Contraseña</label> -->
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input" name="codigo_otp2" id="codigo_otp2"
                                placeholder="Ingresa el código OTP" required maxlength="6" autocomplete="off">
                                <img class="input-icon" src="../../../../Imagenes/password.svg" alt="">
                            <i class="ver_password fas fa-eye" id="eye"></i>
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>
                </div>
                <input class="btn" type="submit" name="register" value="Enviar">
                <a href="/index.php">Regresar al Login</a>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="module"src="../../../javascript/validacionOTPCambioClave.js"></script>

</body>
</html>
