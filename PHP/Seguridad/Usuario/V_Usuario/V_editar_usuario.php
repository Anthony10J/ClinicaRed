<!-- editar_usuario.php -->
<?php
include '../../../Controladores/Conexion/Conexion_be.php';
require_once '../C_Usuario/C_editar_usuario.php';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idUsuario = $_GET["id"];

    // Obtener los datos del usuario a editar
    $obtenerUsuarioQuery = "SELECT * FROM tbl_ms_usuario WHERE Id_Usuario = ?";
    $stmt = mysqli_prepare($conexion, $obtenerUsuarioQuery);
    mysqli_stmt_bind_param($stmt, "i", $idUsuario);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $usuario = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CLÍNICA RED</title>
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../../../assets/img/red-logo.jpeg" rel="icon">
    <link href="../../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Vendor CSS Files -->
    <link href="../../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <link href="./Usuario.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>


</head>

<body>
<?php 
include '../../../../Recursos/Componentes/header.php';
include '../../../../Recursos/Componentes/SideBar.html';
?>

<!-- Agrega tu encabezado y estilos aquí -->

<main id="main" class="table">
    <div class="container mt-4">
            <div class="col-12">
            <center>
               <h2>Editar Usuario</h2>
            </center>
            
            <div class="contenedor__todo">
                <table class="table" style:"align-items-center">
                            <form action="../C_Usuario/C_editar_usuario.php" method="post" class="formulario__register" id="editFormUser">
                                <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($usuario['Id_Usuario']); ?>">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- GRUPO DNI -->
                                        <div class="formulario__grupo" id="grupo__dni">
                                            <label for="dni" class="formulario__label">DNI</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" maxlength="13" pattern="[0-9]{13}" class="form-control" name="dni" id="dni" placeholder="DNI" 
                                                value="<?php echo htmlspecialchars($usuario['DNI']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="formulario__grupo" id="grupo__nombre">
                                            <label for="nombre" class="formulario__label">Nombre Completo</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="form-control mayuscula" name="nombre" id="nombre" style:"text-transform: uppercase" placeholder="Nombre completo" 
                                                maxlength="80" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO CORREO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__correo2">
                                            <label for="correo2" class="formulario__label">Correo Electrónico</label>
                                            <div class="formulario__grupo-input">
                                                <input type="email" class="form-control" name="correo" id="correo" placeholder="usuario@dominio.com" 
                                                maxlength="40" value="<?php echo htmlspecialchars($usuario['Correo']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO USUARIO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__usuario">
                                            <label for="usuario" class="formulario__label">Usuario</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="form-control mayuscula" style:"text-transform: uppercase" name="usuario" id="usuario" placeholder="Usuario" 
                                                maxlength="15" value="<?php echo htmlspecialchars($usuario['Usuario']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO DIRECCION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__direccion">
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="form-control mayuscula" name="direccion" id="direccion" placeholder="Dirección" 
                                                maxlength="80" value="<?php echo htmlspecialchars($usuario['Direccion']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO GENERO -->
                                    <td>
                                        <div class="formulario__grupo">
                                            <select type="text" name="genero" id="genero" class="form-control" placeholder="Genero" class="combobox"
                                            value="<?php echo htmlspecialchars($usuario['IdGenero']); ?>" required>
                                            <option value="0" <?php if ($usuario['IdGenero'] == 0) echo "selected"; ?>>Seleccione un género</option>
                                            <option value="1" <?php if ($usuario['IdGenero'] == 1) echo "selected"; ?>>MASCULINO</option>
                                            <option value="2" <?php if ($usuario['IdGenero'] == 2) echo "selected"; ?>>FEMENINO</option>
                                            </select>

                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO FECHA NACIMIENTO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                        <label for="Fechavencimiento">Fecha de Nacimiento:</label>
                                            <input  type="date" placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" class="form-control" min="1900-01-01" max="2006-01-01" value="<?php echo htmlspecialchars($usuario['FechaNacimiento']); ?>" required>
                                            <p id="mensajeFechaNacimiento" class="mensaje_error" style:"color: red;" > </p>
                                        </div>
                                    </td>
                                    <!-- GRUPO FECHA CONTRATACION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                        <label for="FechaContratacion">Fecha de Contratación:</label>
                                            <input type="date" name="fechacontratacion" id="fechacontratacion" class="form-control"
                                            value="<?php echo htmlspecialchars($usuario['FechaContratacion']); ?>" required>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO ROL -->
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" name="rol" id="rol" class="form-control" placeholder="rol" class="combobox"
                                            value="<?php echo htmlspecialchars($usuario['IdRol']); ?>" required>
                                            <option value="0" <?php if ($usuario['IdRol'] == 0) echo "selected"; ?>>Seleccione un rol</option>
                                            <option value="2" <?php if ($usuario['IdRol'] == 2) echo "selected"; ?>>DEFECTO</option>
                                            <option value="3" <?php if ($usuario['IdRol'] == 3) echo "selected"; ?>>USUARIO</option>
                                            <option value="4" <?php if ($usuario['IdRol'] == 4) echo "selected"; ?>>ADMINISTRADOR</option>
                                            <option value="5" <?php if ($usuario['IdRol'] == 5) echo "selected"; ?>>SECRETARIA</option>
                                            <option value="6" <?php if ($usuario['IdRol'] == 6) echo "selected"; ?>>FISIATRA</option>
                                            <option value="7" <?php if ($usuario['IdRol'] == 7) echo "selected"; ?>>TERAPEUTA</option>
                                        </select>
                                        </div>
                                    </td>
                                    <!-- GRUPO ESTADO USUARIO -->
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" class="form-control" name="estadoUser" id="estadoUser" placeholder="estadoUser" class="combobox"
                                            value="<?php echo htmlspecialchars($usuario['Estado_Usuario']); ?>" required>
                                            <option value="0" <?php if ($usuario['Estado_Usuario'] == 0) echo "selected"; ?>>Seleccione un estado</option>
                                            <option value="1" <?php if ($usuario['Estado_Usuario'] == 1) echo "selected"; ?>>ACTIVO</option>
                                            <option value="2" <?php if ($usuario['Estado_Usuario'] == 2) echo "selected"; ?>>INACTIVO</option>
                                            </select>

                                        </div>
                                    </td>
                                    </tr>

                                     <tr>
                                    <td>  
                                        <button type="submit" id="registrarBtn" class="btn btn-primary">Guardar Cambios</button>
                                        </td>
                                        <td> 
                                         <button id="cancelarbtn" onclick="confirmarCancelar()" class="btn btn-danger" type="button">Cancelar</button>
                                         </td>
                                     </tr>
                                     </form>
                                    </tbody>
<script>
    function confirmarCancelar() {
        // Mostrar un cuadro de diálogo de confirmación
        const confirmacion = confirm("¿Estás seguro de que deseas cancelar?");
       
        // Si el usuario hace clic en "Aceptar", redirigir a la pantalla de usuarios
        if (confirmacion) {
            // Redirigir a la pantalla de usuarios (reemplaza con la URL correcta)
            window.location.href = "./V_usuario.php";
        }
    }
</script>
                
            </div>
        </div>
    </div>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  <!-- Vendor JS Files -->
  <script src="../../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>

<!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

<!-- Datatables JS -->
<!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->
<!-- <script src="../../../../EstilosLogin/js/script.js"></script>     -->
<!-- <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
<!-- <script type="module" src="../../../javascript/validacionNuevoRegistroUsuario.js"></script> -->

</body>

</html>