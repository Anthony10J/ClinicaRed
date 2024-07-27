<?php
// Sí existe una sesión iniciada, no permite regresar al login sin antes cerrar la sesión
session_start();

if (isset($_SESSION["correo"])) {
    header("location: Main.php");
}
include('../Controladores/Conexion/Conexion_be.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica RED</title>
    <link rel="shortcut icon" href="../../EstilosLogin/images/pestana.png" type="image/x-icon">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../../EstilosLogin/css/estilos.css">

   <!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

</head>

<body>
    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>¿Ya tienes una cuenta?</h3>
                    <p>Inicia sesión para entrar en la página</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Aún no tienes una cuenta?</h3>
                    <p>Regístrate para que puedas iniciar sesión</p>
                    <button id="btn__registrarse">Registrarme</button>
                </div>
            </div>

            <!--Formulario de Login y registro-->
            <div class="contenedor__login-register" id="formulario">
                <!--Login-->
                <form action="../Controladores/LoginController_be.php" method="POST" class="formulario__login"id="loginForm" >
                    <img src="../../EstilosLogin/images/logo.png" alt="Logo" class="logo">
                    <h2>Iniciar Sesión</h2>
                    <!-- Grupo: Correo -->
                    <div class="formulario__grupo" id="grupo__correo">
                        <label for="correo" class="formulario__label">Correo Electrónico</label>
                        <div class="formulario__grupo-input">
                            <input type="email" class="formulario__input" name="correo" id="correo"
                                placeholder="usuario@dominio.com" maxlength="40" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- Grupo: Contraseña -->
                    <div class="formulario__grupo" id="grupo__password">
                        <label for="password" class="formulario__label">Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password" id="password"
                                placeholder="Contraseña" maxlength="30" autocomplete="off">
                            <i class="ver_password fas fa-eye"></i>
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- Mensaje de error -->
                    <?php
                    if (isset($_GET['error'])) {
                        $mensajeError = urldecode($_GET['error']);
                        echo '<h6 id="mensajeError" class="alert alert-danger">' . $mensajeError . '</h6>';
                    }
                    ?>

                    <script>
                        // Esperar 5 segundos y ocultar el mensaje de error
                        setTimeout(function() {
                            var mensajeError = document.getElementById('mensajeError');
                            if (mensajeError) {
                                mensajeError.style.display = 'none';
                            }
                        }, 5000); // 5000 milisegundos = 5 segundos
                    </script>

                    <!--codigo del recaptcha  de google -->
					
                    <div id="captcha" class="text-center captcha">
						<div class="g-recaptcha"
							data-sitekey="6LfmNZMpAAAAADQBJ9ntgbG6Nb0Oyqar7qeF6UQ0">
						</div>
					</div>
					<!-- fin del recaptcha-->
                    
                    <!-- Botón entrar -->
                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                        <button type="submit" class="formulario__btn" id="btn_login">Entrar</button>
                    </div>

                    <div>  
                    <a href="../Seguridad/OTP/V_Recuperar_Clave/V_ingresar_correo.php">¿No recuerdas tu contraseña?</a>
                    </div>
                </form>

                <!--Register-->
                <form action="../Controladores/Registro_Usuario_be.php" method="POST" class="formulario__register" id="registerForm">
                    <h2>Regístrate</h2>
                    <!-- GRUPO DNI -->
                    <div class="formulario__grupo" id="grupo__dni">
                        <label for="dni" class="formulario__label">DNI</label>
                        <div class="formulario__grupo-input">
                            <input type="int" class="formulario__input" name="dni" id="dni" placeholder="DNI"
                                maxlength="13" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- GRUPO NOMBRE COMPLETO -->
                    <div class="formulario__grupo" id="grupo__nombre">
                        <label for="nombre" class="formulario__label">Nombre Completo</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input mayuscula" name="nombre" id="nombre"
                                placeholder="Nombre completo" maxlength="80" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- GRUPO CORREO -->
                    <div class="formulario__grupo" id="grupo__correo2">
                        <label for="correo" class="formulario__label">Correo Electrónico</label>
                        <div class="formulario__grupo-input">
                            <input type="email" class="formulario__input" name="correo2" id="correo2"
                                placeholder="usuario@dominio.com" maxlength="40" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- GRUPO USUARIO -->
                    <div class="formulario__grupo" id="grupo__usuario">
                        <label for="usuario" class="formulario__label">Usuario</label>
                        <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input mayuscula" name="usuario" id="usuario"
                                placeholder="Usuario" maxlength="15" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- GRUPO CONTRASEÑA -->
                    <div class="formulario__grupo" id="grupo__password2">
                        <label for="password2" class="formulario__label">Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password2" id="password2"
                                placeholder="Contraseña" maxlength="30" autocomplete="off">
                            <i class="ver_password fas fa-eye"></i>
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>
                    <!-- GRUPO CONFIRMACION CONTRASEÑA -->
                    <div class="formulario__grupo" id="grupo__password3">
                        <label for="password3" class="formulario__label">Confirmar Contraseña</label>
                        <div class="formulario__grupo-input">
                            <input type="password" class="formulario__input" name="password3" id="password3"
                                placeholder="Confirmar contraseña" maxlength="30" autocomplete="off">
                            <i class="ver_password fas fa-eye"></i>
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- GRUPO DIRECCION -->
                    <div class="formulario__grupo" id="grupo__direccion"> 
                     <label for="direccion" class="formulario__label">Dirección</label> 
                     <div class="formulario__grupo-input">
                            <input type="text" class="formulario__input mayuscula" name="direccion" id="direccion" placeholder="Dirección" maxlength="80" autocomplete="off">
                        </div>
                        <p class="formulario__input-error"></p>
                    </div>

                    <!-- GRUPO FECHA DE NACIMIENTO -->
                    <div class="formulario__grupo" id="grupo__fecha">
                        <label for="fechanacimiento" class="formulario__label">Fecha de Nacimiento:</label>
                        <input type="date" placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" autocomplete="off"
                         class="fecha-nacimiento-input">
                        <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: #bb2929;" ></p>
                    </div>

                    <!-- GRUPO GENERO -->
                    <div class="gender-options">
                    <label for="genero" class="formulario__label">Género</label>
                    <div></div>
                    <select type="int" autocomplete="off" name="genero" id="mensajeGenero1" placeholder="Genero" class="combobox">
                        <option value="0" selected>Seleccione</option>
                        <?php
                        // Conexión a la base de datos
                    
                        // Consulta SQL para obtener los géneros
                        $query = "SELECT idGenero, Descripcion FROM tbl_genero";
                        $resultado = mysqli_query($conexion, $query);

                        // Iterar sobre los resultados y generar las opciones del select
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['idGenero'] . '">' . $fila['Descripcion'] . '</option>';
                        }
                        // Liberar resultado
                        mysqli_free_result($resultado);
                        // Cerrar conexión
                        mysqli_close($conexion);
                        ?>
                    </select>
                    <p id="mensajeGenero2" class="mensaje_error" style="color: #bb2929;" ></p>
                </div>

                    <!-- Botón entrar -->
                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                        <button type="submit" class="formulario__btn" id="btn_registrar" disabled>Registrarme</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script src="../../EstilosLogin/js/script.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!-- <script type="module" src="../javascript/validacionIndex.js"></script> -->
    <script type="module" src="../javascript/validacionAutoRegistro.js"></script>
    <script src="../javascript/captcha.js"></script>
</body>
</html>