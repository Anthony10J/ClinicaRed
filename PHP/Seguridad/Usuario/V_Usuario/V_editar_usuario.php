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
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">
    <meta content="" name="description">
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
                <!-- <img src="../../Imagenes/logo2.jpg" style="align-items-left; width: 100px; height: 100px; border-radius: 50%;"> -->

                <form action="../C_Usuario/C_editar_usuario.php" method="post" class="formulario__register" id="editFormUser">
                    <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($usuario['Id_Usuario']); ?>">
                    <div class="contenedor__todo">
                        <table class="table" style:"align-items-center">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- GRUPO DNI -->
                                        <div class="formulario__grupo" id="grupo__dni">
                                            <label for="dni" class="formulario__label">DNI</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" maxlength="13" pattern="[0-9]{13}" class="formulario__input" class="form-control" name="dni" id="dni" placeholder="DNI" autocomplete="off" value="<?php echo htmlspecialchars($usuario['DNI']); ?>">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO NOMBRE COMPLETO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__nombre">
                                            <label for="nombre" class="formulario__label">Nombre Completo</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" class="form-control" name="nombre" id="nombre" autocomplete="off" style="text-transform: uppercase" placeholder="Nombre completo" maxlength="80" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>">
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
                                                <input type="email" class="formulario__input" class="form-control" name="correo" id="correo" autocomplete="off" placeholder="Correo Electrónico" maxlength="40" value="<?php echo htmlspecialchars($usuario['Correo']); ?>">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO USUARIO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__usuario">
                                            <label for="usuario" class="formulario__label">Usuario</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" class="form-control" style="text-transform: uppercase" autocomplete="off" name="usuario" id="usuario" placeholder="Usuario" maxlength="15" value="<?php echo htmlspecialchars($usuario['Usuario']); ?>">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- GRUPO CONTRASEÑA -->
                                    <!-- <td>
                                        <div class="formulario__grupo" id="grupo__password2">
                                            <label for="password2" class="formulario__label">Contraseña</label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" name="password2" id="password2" autocomplete="off" placeholder="Contraseña" maxlength="30" style="width: 620px" >
                                                <i class="ver_password fas fa-eye"></i>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td> -->
                                    <!-- GRUPO CONFIRMACION CONTRASEÑA -->
                                    <!-- <td>
                                        <div class="formulario__grupo" id="grupo__password3">
                                            <label for="password3" class="formulario__label">Confirmar Contraseña</label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="formulario__input" class="form-control" name="password3" id="password3" autocomplete="off" placeholder="Confirmar contraseña" maxlength="30" style="width: 585px" >
                                                <i class="ver_password fas fa-eye"></i>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td> -->
                                </tr>

                                <tr>
                                    <!-- GRUPO DIRECCION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__direccion">
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" class="form-control" name="direccion" id="direccion" autocomplete="off" style="text-transform: uppercase" placeholder="Dirección" maxlength="80" value="<?php echo htmlspecialchars($usuario['Direccion']); ?>">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO GENERO -->
                                    <td>
                                        <div class="gender-options">
                                            <!-- <label for="genero" class="formulario__label">Género</label> -->
                                            <div></div>
                                            <select type="int" class="formulario__input" autocomplete="off" name="genero" id="genero" placeholder="Genero" class="combobox" value="<?php echo htmlspecialchars($usuario['IdGenero']); ?>">
                                                <!-- <option value="0" selected>Seleccione un Género</option> -->
                                                <?php
                                                // Conexión a la base de datos

                                                // Consulta SQL para obtener los géneros
                                                $query = "SELECT idGenero, Descripcion FROM tbl_genero";
                                                $resultado = mysqli_query($conexion, $query);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    // Comparar el valor guardado con el valor de la opción
                                                    $selected = ($fila['idGenero'] == $usuario['IdGenero']) ? 'selected' : '';
                                                    echo '<option value="' . $fila['idGenero'] . '" ' . $selected . '>' . $fila['Descripcion'] . '</option>';
                                                }
                                                // Liberar resultado
                                                mysqli_free_result($resultado);
                                                // Cerrar conexión
                                                // mysqli_close($conexion);
                                                ?>
                                            </select>
                                            <p id="mensajeGenero2" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <!-- GRUPO FECHA NACIMIENTO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                            <label for="Fechanacimiento">Fecha de Nacimiento:</label>
                                            <input type="date" class="formulario__input" placeholder="Fecha de Nacimiento" autocomplete="off" name="fechanacimiento" id="fechanacimiento" class="form-control" class="fecha-nacimiento-input" value="<?php echo htmlspecialchars($usuario['FechaNacimiento']); ?>">
                                            <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO FECHA CONTRATACION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                            <label for="Fechavencimiento">Fecha de Contratación:</label>
                                            <input type="date" class="formulario__input" name="fechacontratacion" id="fechacontratacion" autocomplete="off" class="form-control" value="<?php echo htmlspecialchars($usuario['FechaContratacion']); ?>">
                                            <p id="mensajeFechaContratacion" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- GRUPO ROL -->
                                    <td>
                                        <div class="gender-options">
                                            <select type="int" class="formulario__input" autocomplete="off" name="rol" id="rol" placeholder="rol" class="combobox" value="<?php echo htmlspecialchars($usuario['IdRol']); ?>">
                                                <?php
                                                // Conexión a la base de datos

                                                // Consulta SQL para obtener los géneros
                                                $query = "SELECT Id_Rol, Rol FROM tbl_ms_roles WHERE Rol <> 'SUPERADMINISTRADOR'";
                                                $resultado = mysqli_query($conexion, $query);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    // Comparar el valor guardado con el valor de la opción
                                                    $selected = ($fila['Id_Rol'] == $usuario['IdRol']) ? 'selected' : '';
                                                    echo '<option value="' . $fila['Id_Rol'] . '" ' . $selected . '>' . $fila['Rol'] . '</option>';
                                                }
                                                // Liberar resultado
                                                mysqli_free_result($resultado);
                                                // Cerrar conexión
                                                // mysqli_close($conexion);
                                                ?>
                                            </select>
                                            <p id="mensajerol2" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO ESTADO USUARIO -->
                                    <td>
                                        <div class="gender-options">
                                            <!-- <div></div> -->
                                            <select type="int" class="formulario__input" autocomplete="off" name="estadoUser" id="estadoUser" placeholder="estadoUser" class="combobox" value="<?php echo htmlspecialchars($usuario['Estado_Usuario']); ?>">
                                                <?php
                                                // Conexión a la base de datos

                                                // Consulta SQL para obtener los géneros
                                                $query = "SELECT Id_Estado, Descripcion FROM tbl_estado_usuario WHERE Descripcion <> 'BLOQUEADO'";
                                                $resultado = mysqli_query($conexion, $query);

                                                // Iterar sobre los resultados y generar las opciones del select
                                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                                    // Comparar el valor guardado con el valor de la opción
                                                    $selected = ($fila['Id_Estado'] == $usuario['Estado_Usuario']) ? 'selected' : '';
                                                    echo '<option value="' . $fila['Id_Estado'] . '" ' . $selected . '>' . $fila['Descripcion'] . '</option>';
                                                }
                                                // Liberar resultado
                                                mysqli_free_result($resultado);
                                                // Cerrar conexión
                                                mysqli_close($conexion);
                                                ?>
                                            </select>
                                            <p id="mensajeestado2" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <button type="submit" id="Btnregistrar" class="btn btn-primary">Guardar</button>

                                    </td>

                </form>
                <td>
                    <!-- <a href="./V_usuario.php"> -->
                    <button id="Btncancelar" class="btn btn-danger" type="button">Cancelar</button>
                    <!-- </a> -->
                </td>
                </tr>
                </tbody>
                </table>
            </div>
        </div>
        </div>
        </div>
    </main>

    <script>
        var Btncancelar = document.getElementById('Btncancelar');
        Btncancelar.addEventListener('click', confirmarCancelar);

         function confirmarCancelar() {
            Swal.fire({
                title: "Quieres Cancelar esta Acción?",
                text: "Estas seguro que quieres Cancelar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Cancelado",
                        text: "No se Guardaron registros",
                        icon: "success",
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location = "./V_usuario.php";
                    }, 1300);
                }
            });
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
    <script type="module" src="../../../javascript/validacionEditarUsuario.js"></script>


    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>

    <!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Datatables JS -->
    <!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->
    <!-- <script src="../../../../EstilosLogin/js/script.js"></script>     -->
    <!-- <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <!-- <script type="module" src="../../../javascript/validacionNuevoRegistroUsuario.js"></script> -->

</body>

</html>