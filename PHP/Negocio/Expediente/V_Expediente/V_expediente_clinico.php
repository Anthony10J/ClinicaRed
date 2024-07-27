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

include '../../../Controladores/Conexion/Conexion_be.php';
include('../../../../Recursos/SweetAlerts.php');

if (isset($_POST['atenderCita']) && isset($_POST['idCitaTerapia']) && isset($_POST['estadoCita'])) {
    $idCitaTerapia = $_POST['idCitaTerapia'];
    $estadoCita = $_POST['estadoCita'];

    // Realizar el update del estado de la cita
    $sql = "UPDATE tbl_cita_terapeutica SET Id_Estado_Cita = $estadoCita WHERE id_Cita_Terapia = $idCitaTerapia";

    if (mysqli_query($conexion, $sql)) {
        // La actualización fue exitosa
        // echo "El estado de la cita ha sido actualizado correctamente";
    } else {
        // Hubo un error en la actualización
        echo "Error al actualizar el estado de la cita: " . mysqli_error($conexion);
    }
}
?>
<?php
// Verificar si la variable de sesión no está establecida
if (!isset($_SESSION['detalle_expediente_ejecutado'])) {
    // Incluir el archivo solo si no se ha ejecutado antes
    include_once '../../Procesos/C_procesos/C_detalle_expediente.php';
} else {
    // Eliminar la variable de sesión para permitir que el código se ejecute nuevamente
    unset($_SESSION['detalle_expediente_ejecutado']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clínica RED</title>
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
    <link href="./V_expediente_clinico.css" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</head>

<body>
    <?php
    include '../../../Controladores/Conexion/Conexion_be.php';

    ?>

    <main id="main" class="table">
        <div class="container mt-4">
            <div class="col-12">
                <center>
                    <h2>EXPEDIENTE CLÍNICO</h2>
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
                                <div class="divDescripcionEvaluacion">
                                    <div class="col-tarjeta-paciente">
                                        <div class="form-group">
                                            <label for="paciente">NOMBRE:</label>
                                            <input type="text" class="formulario__input" readonly id="paciente"
                                                name="paciente">
                                            <label for="Numero_Documento">IDENTIFICACIÓN:</label>
                                            <input type="text" class="formulario__input" readonly id="Numero_Documento"
                                                name="Numero_Documento">
                                            <label for="ocupacion">OCUPACIÓN:</label>
                                            <input type="text" class="formulario__input" readonly id="ocupacion"
                                                name="ocupacion">
                                            <label for="direccion">DIRECCIÓN:</label>
                                            <input type="text" class="formulario__input" readonly id="direccion"
                                                name="direccion">
                                            <!-- <label for="telefono">TELÉFONO:</label>
                                            <input type="text" class="formulario__input" readonly id="telefono" name="telefono"> -->
                                            <label for="edad">EDAD:</label>
                                            <input type="text" class="formulario__input" readonly id="edad" name="edad">
                                            <label for="fisiatra">EVALUADOR:</label>
                                            <input type="text" class="formulario__input" readonly id="fisiatra"
                                                name="fisiatra">
                                            <label for="motivoConsulta">MOTIVO DE CONSULTA:</label>
                                            <input type="text" class="formulario__input" readonly id="motivoConsulta"
                                                name="motivoConsulta">
                                            <br><br><br><br>
                                            <!-- <label for="lateralidad">LATERALIDAD:</label>
                                            <input type="text" class="formulario__input" placeholder="Por favor, llenar este campo" id="lateralidad" name="lateralidad">
                                            <label for="referido">REFERIDO:</label>
                                            <input type="text" class="formulario__input" placeholder="Por favor, llenar este campo" id="referido" name="referido"> -->
                                            <label for="Id_Cita" hidden>ID CITA:</label>
                                            <input type="text" readonly hidden class="formulario__input" id="Id_Cita"
                                                name="Id_Cita">
                                            <label for="Id_Expediente" hidden>ID EXPEDIENTE:</label>
                                            <input type="text" readonly hidden class="formulario__input"
                                                id="Id_Expediente" name="Id_Expediente">
                                            <label for="Id_Usuario" hidden>ID USUARIO:</label>
                                            <input type="text" readonly hidden class="formulario__input" id="Id_Usuario"
                                                name="Id_Usuario">
                                            <!-- <textarea type="text" class="formulario__input" id="lateralidad" name="lateralidad"></textarea> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            include '../C_Expediente/C_expediente_clinico.php';
                            ExpedienteClinico();
                            ?>
                            <a href="./V_expediente_terapeutico.php">
                                <button class="btn-primary">Expediente Terapéutico</button>
                            </a>
                            <!-- </div> -->
                            <button id="btn-cancelar" onclick="confirmarCancelar()"
                                class="btn-cancelar">Cancelar</button>
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
            const confirmacion = confirm("¿Estás seguro de que deseas cancelar?");
            // Si el usuario hace clic en "Aceptar", redirigir a la pantalla de usuarios
            if (confirmacion) {
                // Redirigir a la pantalla de usuarios (reemplaza con la URL correcta)
                        window.location.href = "../../../Vistas/Main.php";
            }
        }
    </script>


    <!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
   
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
   
    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>


</body>

</html>

<?php
// Obtener los datos del formulario
$datosPaciente = isset($_POST['datos']) ? $_POST['datos'] : '';

// Procesar los datos como lo hacías anteriormente
if ($datosPaciente) {
    $datosPaciente = urldecode($datosPaciente);
    $datosArray = explode('||', $datosPaciente);
    // Llenar los campos con los datos obtenidos

    // Guardar los datos del paciente en variables de sesión
    $_SESSION['datosPaciente'] = $datosArray;

    // Rellenar los campos del formulario con los datos del paciente
    echo '<script>';
    echo 'document.getElementById("Id_Cita").value = "' . $datosArray[0] . '";';
    echo 'document.getElementById("paciente").value = "' . $datosArray[1] . '";';
    echo 'document.getElementById("motivoConsulta").value = "' . $datosArray[2] . '";';
    echo 'document.getElementById("Id_Expediente").value = "' . $datosArray[5] . '";';
    echo 'document.getElementById("Numero_Documento").value = "' . $datosArray[6] . '";';
    echo 'document.getElementById("ocupacion").value = "' . $datosArray[7] . '";';
    echo 'document.getElementById("direccion").value = "' . $datosArray[8] . '";';
    echo 'document.getElementById("edad").value = "' . $datosArray[9] . '";';
    echo 'document.getElementById("fisiatra").value = "' . $Nombre_Usuario . '";'; // Aquí puedes poner el nombre del evaluador si lo tienes almacenado en algún lado
    echo 'document.getElementById("Id_Usuario").value = "' . $Id_Usuario . '";';
    echo '</script>';
}
?>