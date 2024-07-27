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
include('../../../../Recursos/SweetAlerts.php');
include '../../../Controladores/Conexion/Conexion_be.php';
// Verificar si las variables de sesión existen
if (isset($_POST['id_Cita_Terapia']) && isset($_POST['Detalle_Expediente'])) {
    // Acceder a las variables de sesión
    $id_Cita_Terapia = $_POST['id_Cita_Terapia'];
    $Detalle_Expediente = $_POST['Detalle_Expediente'];
    $_SESSION['Id_Cita'] = $_POST['id_Cita_Terapia'];
    $_SESSION['Detalle_Expediente'] = $_POST['Detalle_Expediente'];

    $sql = "SELECT
                P.Nombre AS Paciente,
                P.Numero_Documento,
                P.Direccion,
                TIMESTAMPDIFF(
                    YEAR,
                    P.FechaNacimiento,
                    CURDATE()) AS Edad,
                G.Descripcion AS Genero,
                P.Ocupacion,
                U.Nombre AS Evaluador,
                DATE(DE.Fecha_Evaluacion) AS Fecha,
                CT.Descripcion_Cita AS Motivo_Consulta
            FROM
                tbl_paciente AS P
            INNER JOIN tbl_genero AS G
            ON
                P.IdGenero = G.IdGenero
            INNER JOIN tbl_cita_terapeutica AS CT
            ON
                P.Id_Paciente = CT.Id_Paciente
            INNER JOIN tbl_ms_usuario AS U
            ON
                CT.Id_Especialista = U.Id_Usuario
            INNER JOIN tbl_detalle_expediente AS DE
            ON
                CT.id_Cita_Terapia = DE.Id_Cita_Terapia
            WHERE
                CT.id_Cita_Terapia = $id_Cita_Terapia AND DE.Id_Detalle_Expediente = $Detalle_Expediente";

    $resultado = mysqli_query($conexion, $sql);

    if($resultado){
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

    <title>Clínica RED - Rehabilitación y Electrodiagnóstico </title>
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

    <link href="./V_expediente_clinico.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

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
                    <h2>EDITAR EXPEDIENTE CLÍNICO</h2>
                    <hr>
                </center>
                <!-- <img src="../../Imagenes/logo2.jpg" style="align-items-left; width: 100px; height: 100px; border-radius: 50%;"> -->

                <!-- <form action="../C_Usuario/C_nuevo_usuario.php" method="POST" class="formulario__register" id="registerFormUser"> -->
                <div class="contenedor__todo">
                    <table class="table" style:"align-items-center">
                        <tbody>
                            <!-- <div class="py-5"> -->
                            <div class="card-info-paciente">
                                <div class="divEvaluacion">
                                    <label class="labelEvaluacion">INFORMACIÓN DEL PACIENTE</label>
                                </div>
                                <!-- ?php
                                echo "ID de id_Cita_Terapia: $id_Cita_Terapia <br>";
                                echo "ID de Detalle_Expediente: $Detalle_Expediente <br>";
                                ?> -->
                                <div class="divDescripcionEvaluacion">
                                    <div class="col-tarjeta-paciente">
                                        <div class="form-group">
                                            <label for="paciente">NOMBRE:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Paciente']; ?>" readonly id="paciente" name="paciente">
                                            <label for="Numero_Documento">IDENTIFICACIÓN:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Numero_Documento']; ?>" readonly id="Numero_Documento" name="Numero_Documento">
                                            <label for="ocupacion">OCUPACIÓN:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Ocupacion']; ?>" readonly id="ocupacion" name="ocupacion">
                                            <label for="direccion">DIRECCIÓN:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Direccion']; ?>" readonly id="direccion" name="direccion">
                                            <!-- <label for="telefono">TELÉFONO:</label>
                                            <input type="text" class="formulario__input" readonly id="telefono" name="telefono"> -->
                                            <label for="edad">EDAD:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Edad']; ?>" readonly id="edad" name="edad">
                                            <label for="fisiatra">EVALUADOR:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Evaluador']; ?>" readonly id="fisiatra" name="fisiatra">
                                            <label for="motivoConsulta">MOTIVO DE CONSULTA:</label>
                                            <input type="text" class="formulario__input" value=" <?php echo $datos['Motivo_Consulta']; ?>" readonly id="motivoConsulta" name="motivoConsulta">
                                            <br><br><br><br>
                                            <!-- <label for="lateralidad">LATERALIDAD:</label>
                                            <input type="text" class="formulario__input" placeholder="Por favor, llenar este campo" id="lateralidad" name="lateralidad">
                                            <label for="referido">REFERIDO:</label>
                                            <input type="text" class="formulario__input" placeholder="Por favor, llenar este campo" id="referido" name="referido"> -->
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

                            <?php
                            include '../C_Expediente/C_editar_expediente_clinico.php';
                            ExpedienteClinicoEditable();
                            ?>
                            <!-- </div> -->
                            <a href="./V_modal_expediente.php">
                                <button style="margin-left: 3px;" id="btn-cancelar" class="btn-cancelar">Cancelar</button>
                            </a>
                        </tbody>
                    </table>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </main>
    <script>
        function confirmarCancelar() {
            // Mostrar un cuadro de diálogo de confirmación
            const confirmacion = confirm("¿Estás seguro de que deseas actualizar?");
            // Si el usuario hace clic en "Aceptar", redirigir a la pantalla de usuarios
            if (confirmacion) {
                // Redirigir a la pantalla de usuarios (reemplaza con la URL correcta.
                 "./V_modal_expediente.php";
            }
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