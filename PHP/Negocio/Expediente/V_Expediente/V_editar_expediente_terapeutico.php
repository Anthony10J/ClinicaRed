<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

$Id_Usuario = $_SESSION['id_D'];
$Nombre_Usuario = $_SESSION['nombre'];
?>
<?php
include '../../../Controladores/Conexion/Conexion_be.php';
include '../../../../Recursos/SweetAlerts.php';
// Verificar si las variables de sesión existen
if (isset($_POST['id_Cita_Terapia']) && isset($_POST['Detalle_Terapia'])) {
    // Acceder a las variables de sesión
    $id_Cita_Terapia = $_POST['id_Cita_Terapia'];
    $Detalle_Terapia = $_POST['Detalle_Terapia'];
    $_SESSION['Id_Cita'] = $_POST['id_Cita_Terapia'];
    $_SESSION['Detalle_Terapia'] = $_POST['Detalle_Terapia'];

    $sql = "SELECT
    P.Nombre AS Paciente,
    TIMESTAMPDIFF(
        YEAR,
        P.FechaNacimiento,
        CURDATE()) AS Edad,
        U.Nombre AS Evaluador,
        DATE(DT.Fecha_Terapia) AS Fecha,
        CT.Descripcion_Cita AS Motivo_Consulta
    FROM
        tbl_paciente AS P
    INNER JOIN tbl_cita_terapeutica AS CT
    ON
        P.Id_Paciente = CT.Id_Paciente
    INNER JOIN tbl_ms_usuario AS U
    ON
        CT.Id_Especialista = U.Id_Usuario
    INNER JOIN tbl_detalle_terapia AS DT
    ON
    CT.id_Cita_Terapia = DT.Id_Cita_Terapia
    WHERE
        CT.id_Cita_Terapia = $id_Cita_Terapia AND DT.Id_Detalle_Terapia = $Detalle_Terapia";

    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        $datos = mysqli_fetch_assoc($resultado);
    }

    // Ahora puedes usar $id_Cita_Terapia y $id_paciente según lo necesites
    // echo "ID de id_Cita_Terapia: $id_Cita_Terapia <br>";
    // echo "ID de Detalle_Expediente: $Detalle_Expediente <br>";

    // También puedes realizar cualquier otra lógica que necesites con estas variables
} else {
    // Si las variables de sesión no existen, puedes redirigir o mostrar un mensaje de error
    echo "Las variables de sesión no están disponibles.";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clínica RED</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />

    <link href="./V_expediente_terapeutico.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" /> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <!-- <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script> -->
    <!-- Enlaza los archivos CSS de Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTnh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                    <h2>EDITAR EXPEDIENTE TERAPÉUTICO</h2>
                    <hr>
                </center>
                <div class="col-md-12">

                    <div class="card-info-paciente">
                        <div class="divEvaluacion">
                            <label class="labelEvaluacion">INFORMACIÓN DEL PACIENTE</label>
                        </div>
                        <div class="divDescripcionEvaluacion">
                            <div class="col-tarjeta-paciente">
                                <div class="form-group">

                                    <label for="paciente">NOMBRE:</label>
                                    <input type="text" value=" <?php echo $datos['Paciente']; ?>" class="formulario__input" readonly id="paciente" name="paciente">
                                    <!-- <label for="Numero_Documento">IDENTIFICACIÓN:</label>
                                         <input type="text" class="formulario__input" readonly id="Numero_Documento" name="Numero_Documento">
                                         <label for="ocupacion">OCUPACIÓN:</label>
                                         <input type="text" class="formulario__input" readonly id="ocupacion" name="ocupacion">
                                         <label for="direccion">DIRECCIÓN:</label>
                                         <input type="text" class="formulario__input" readonly id="direccion" name="direccion"> -->
                                    <!-- <label for="telefono">TELÉFONO:</label>
                                    <input type="text" class="formulario__input" readonly id="telefono" name="telefono"> -->
                                    <label for="edad">EDAD:</label>
                                    <input type="text" value=" <?php echo $datos['Edad']; ?>" class="formulario__input" readonly id="edad" name="edad">
                                    <label for="fisiatra">EVALUADOR:</label>
                                    <input type="text" value=" <?php echo $datos['Evaluador']; ?>" class="formulario__input" readonly id="fisiatra" name="fisiatra">
                                    <label for="motivoConsulta">MOTIVO DE CONSULTA:</label>
                                    <input type="text" value=" <?php echo $datos['Motivo_Consulta']; ?>" class="formulario__input" readonly id="motivoConsulta" name="motivoConsulta">
                                    <!-- <label for="numero_sesiones">N° SESIONES:</label>
                                    <input type="text" class="formulario__input" placeholder="Por favor, llenar este campo" id="numero_sesiones" name="numero_sesiones"> -->

                                    <label for="Id_Cita" hidden>ID CITA:</label>
                                    <input type="text" readonly hidden class="formulario__input" id="Id_Cita" name="Id_Cita">
                                    <label for="Id_Expediente" hidden>ID EXPEDIENTE:</label>
                                    <input type="text" readonly hidden class="formulario__input" id="Id_Expediente" name="Id_Expediente">
                                    <label for="Id_Usuario" hidden>ID USUARIO:</label>
                                    <input type="text" readonly hidden class="formulario__input" id="Id_Usuario" name="Id_Usuario">

                                    <!-- <textarea type="text" class="formulario__input" id="lateralidad" name="lateralidad"></textarea> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenedor de las tarjetas en dos columnas -->
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-6">
                        <div class="contenedor-tarjetas-columna">
                            <div id="contenedor-tarjetas-columna1">
                                <!-- Las tarjetas de la columna 1 se agregarán aquí -->
                            </div>
                        </div>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-6">
                        <div class="contenedor-tarjetas-columna">
                            <div id="contenedor-tarjetas-columna2">
                                <!-- Las tarjetas de la columna 2 se agregarán aquí -->
                            </div>
                        </div>
                    </div>
                </div>
                <hr>

                <!-- Selector de tratamientos -->
                <div class="gender-options">
                    <label for="genero" class="formulario__label">TRATAMIENTOS</label>
                    <select type="int" autocomplete="off" name="tratamiento" id="tratamiento" placeholder="Tratamiento" class="combobox">
                        <option value="0" selected>SELECCIONE</option>
                        <?php
                        include('../../../Controladores/Conexion/Conexion_be.php');
                        $query = "SELECT TT.Id_Tipo_Tratamiento AS Correlativo, TT.Nombre AS Tratamiento FROM `tbl_tipo_tratamiento` AS TT";
                        $resultado = mysqli_query($conexion, $query);

                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            echo '<option value="' . $fila['Correlativo'] . '">' . $fila['Tratamiento'] . '</option>';
                        }
                        mysqli_free_result($resultado);
                        // Cerrar el formulario
                        $conexion->close();
                        ?>
                    </select>
                    <p id="mensajeGenero2" class="mensaje_error" style="color: #bb2929;"></p>
                </div>

                <form>
                    <button type="submit" class="btnguardarDatos" id="guardarDatos" name="guardarDatos">Actualizar</button>
                </form>


                <!-- Importar el archivo JavaScript -->
                <script src="../C_Expediente/C_mostrar_tarjetas_editable.js"></script>
    </main>

    <script>
        function cerrarTarjeta(idTarjeta) {
            var tarjeta = document.getElementById(idTarjeta);
            tarjeta.parentNode.removeChild(tarjeta); // Elimina la tarjeta del DOM
        }
    </script>

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
</body>

</html>