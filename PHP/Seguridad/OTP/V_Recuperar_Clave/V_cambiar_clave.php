<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equivs="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../../../EstilosLogin/css/EstilosValidaciones.css">
    <link rel="stylesheet" href="../../../../EstilosLogin/css/Estilosrecovery/Recuperarcontra.css">
    <link rel="shortcut icon" href="../../../../EstilosLogin/images/pestana.png" type="image/x-icon">

    <title>Recuperar Contraseña</title>
</head>
<body>
    <main>
        <div>
            <?php if(isset($error)) { echo "<p>$error</p>";} ?>
            <form action="../C_Recuperar_Clave/C_actualizar_bd.php" method="POST" class="OTP" id="formCambiarClave" >
            <img src="../../../../EstilosLogin/images/logo.png" alt="">
                <label for="password2"><strong>Ingresa tu nueva contraseña:</strong></label><br>
                <br>
                <div class="input-wrapper">
                          <!-- GRUPO CONTRASEÑA -->
                          <div class="formulario__grupo" id="grupo__password2">
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password2" id="password2" placeholder="Contraseña" maxlength="30">
                            <img class="input-icon" src="../../../../Imagenes/password.svg" alt="">
                            <i class="ver_password fas fa-eye" id="eye"></i>
                        </div>
                        <p class="formulario__input-error"></p>
                    </div><br>
                    <!-- GRUPO CONFIRMACION CONTRASEÑA -->
                    <div class="formulario__grupo" id="grupo__password3">
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password3" id="password3"
                                placeholder="Confirmar contraseña" maxlength="30">
                                <img class="input-icon" src="../../../../Imagenes/password.svg" alt="">
                            <i class="ver_password fas fa-eye" id="eye"></i>
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>
                </div>
                <input class="btn" type="submit" name="register" value="Enviar"><br> 
               
                 <a href="/index.php">Regresar al Login</a>
            </form>
        </div>
    </main>

    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="module"src="../../../javascript/validacionCambiarClave.js"></script>
</body>
</html>