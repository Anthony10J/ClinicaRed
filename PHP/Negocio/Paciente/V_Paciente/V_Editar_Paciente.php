<!-- editar_usuario.php -->
<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Controladores/Conexion/Conexion_be.php';
require_once '../C_Paciente/C_editar_paciente.php';
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $idPaciente = $_GET["id"];
    // Obtener los datos del paciente a editar
    $obtenerPacienteQuery = "SELECT * FROM tbl_paciente WHERE Id_Paciente = ?";
    $stmt = mysqli_prepare($conexion, $obtenerPacienteQuery);
    mysqli_stmt_bind_param($stmt, "i", $idPaciente);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $paciente = mysqli_fetch_assoc($resultado);
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
    <link href="./nuevopaciente.css" rel="stylesheet">

    
    <!-- Template Main CSS File -->
    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <!-- <link href="./pacientes.css" rel="stylesheet"> -->


</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>





    <main id="main" class="table">
        <div class="container mt-4">
            <div class="col-12">
                <center>
                    <h2>Editar Paciente</h2>
                </center>
                <div class="contenedor__todo">
                    <form action="../C_Paciente/C_editar_paciente.php" method="post" class="formulario__register" id="registerFormPaciente">
                        <input type="hidden" name="idPaciente" value="<?php echo htmlspecialchars($paciente['Id_Paciente']); ?>">
                        <table class="table" style:"align-items-center">
                            <tbody>
                                <tr>
                                    <!-- GRUPO NOMBRE COMPLETO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__nombre">
                                            <label for="nombre">Nombre Completo</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text"  class="formulario__input"  name="nombre" id="nombre" autocomplete="off" style="text-transform: uppercase" placeholder="Ingrese su nombre completo." maxlength="80" value="<?php echo htmlspecialchars($paciente['Nombre']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <?php
                                    $sql = "SELECT * FROM tbl_genero";
                                    $genero = mysqli_query($conexion, $sql);
                                    ?>
                                    <!-- GRUPO GENERO -->
                                    <td>
                                        <div class="formulario__grupo">
                                            <label for="genero">Género</label>
                                            <select type="text" name="genero" id="mensajeGenero1" class="form-control" placeholder="Genero" class="combobox" value="<?php echo htmlspecialchars($paciente['IdGenero']); ?>" required>
                                                <option value="0">Seleccione un género</option>
                                                <?php
                                                // Recorrer los resultados y mostrarlos en la tabla
                                                foreach ($genero as $fila) {
                                                ?>
                                                    <option value="<?php echo $fila['IdGenero']; ?>" <?php if ($fila['IdGenero'] == $paciente['IdGenero']) echo "selected"; ?>><?php echo $fila['Descripcion']; ?></option>
                                                <?php
                                                }
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
                                            <input type="date" placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" class="form-control" value="<?php echo htmlspecialchars($paciente['FechaNacimiento']); ?>">
                                            <!-- <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: red;"></p> -->
                                            <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO DIRECCION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__direccion">
                                            <label for="direccion">Dirección</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" name="direccion" id="direccion" placeholder="Dirección" style="text-transform: uppercase" maxlength="80" value="<?php echo htmlspecialchars($paciente['Direccion']); ?>" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $sql = "SELECT * FROM tbl_tipo_documento";
                                    $resultado = mysqli_query($conexion, $sql);
                                    ?>
                                    <!-- GRUPO TIPO DE DOCUMENTO -->
                                    <td>
                                        <div class="gender-options">
                                            <label for="tipo_documento" >Tipo de Documento</label>
                                            <select type="int"  name="tipo_documento" id="mensajeDocumento1" class="form-control" autocomplete="off" class="combobox">
                                                <option value="0" selected>Seleccione un tipo de documento</option>
                                                <?php
                                                // Recorrer los resultados y mostrarlos en la tabla
                                                foreach ($resultado as $fila) {
                                                ?>
                                                    <option value="<?php echo $fila['Id_Tipo_Documento']; ?>" <?php if ($fila['Id_Tipo_Documento'] == $paciente['Id_Tipo_Documento']) echo "selected"; ?>><?php echo $fila['Descripcion']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <p id="mensajeDocumento2" class="mensaje_error" style="color: #bb2929;"></p>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- GRUPO NÚMERO DE DOCUMENTO -->
                                        <div class="formulario__grupo" id="grupo__numero_de_documento">
                                            <label for="numero_de_documento">Número de Documento</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text"  maxlength="15" class="formulario__input" name="numero_de_documento" id="numero_de_documento" placeholder=" INGRESE SU NÚMERO DE DOCUMENTO" required autocomplete="off" value="<?php echo htmlspecialchars($paciente['Numero_Documento']); ?>" >
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- GRUPO OCUPACIÓN -->
                                        <div class="formulario__grupo" id="grupo__ocupacion">
                                            <label for="ocupacion">Ocupación</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" style="text-transform: uppercase" class="formulario__input" name="ocupacion" id="ocupacion" placeholder="INGRESE SU OCUPACIÓN" autocomplete="off" required title="Ingrese solo letras (hasta 50 caracteres)." value="<?php echo $paciente['Ocupacion'] ?>" >
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO ESTADO USUARIO -->
                                    <td>
                                        <!-- <div class="gender-options">
                                                    <label for="estadoPaciente">Estado</label>
                                                    <select type="int" class="form-control" name="estadoPaciente" id="estadoPaciente" autocomplete="off" class="combobox">
                                                        <option value="">Seleccione un estado</option>
                                                        <option value="1" <?php if ($paciente['Estado_Paciente'] == 1) echo "selected"; ?>>ACTIVO</option>
                                                        <option value="0" <?php if ($paciente['Estado_Paciente'] == 0) echo "selected"; ?>>INACTIVO</option>
                                                    </select>
                                                </div> -->
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="formulario__grupo formulario__grupo-btn-enviar">
                                            <button type="submit" id="Btnregistrar" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </td>
                                    <td>
                                        <button id="Btncancelar" onclick="confirmarCancelar()" class="btn btn-danger" type="button">Cancelar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
             </div>
            </div>
        </div>
    </main>
    <?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>
    <script>
        function confirmarCancelar() {
            // Mostrar un cuadro de diálogo de confirmación
            const confirmacion = confirm("¿Estás seguro de que deseas cancelar?");

            // Si el usuario hace clic en "Aceptar", redirigir a la pantalla de pacientes
            if (confirmacion) {
                // Redirigir a la pantalla de pacientes (reemplaza con la URL correcta)
                window.location.href = "./V_Paciente.php";
            }
            
        }
    </script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>
    
    <!-- Vendor JS Files -->
    <script src="../../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../../assets/vendor/php-email-form/validate.js"></script>
    
    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="../../../../EstilosLogin/js/script.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="../../../javascript/validacionPaciente.js"></script>
</body>

</html>