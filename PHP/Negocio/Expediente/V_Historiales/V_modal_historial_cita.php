<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_modal_historial_cita');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1"){
        header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");   
}
?>
<?php
include '../../../Controladores/Conexion/Conexion_be.php';

if (isset($_POST['guardarDatos']) && isset($_POST['idCitaTerapia'])) {
    $idCitaTerapia = $_POST['idCitaTerapia'];

    // Realizar el update del estado de la cita
    $sql = "UPDATE tbl_cita_terapeutica SET Id_Estado_Cita = 3 WHERE id_Cita_Terapia = $idCitaTerapia";

    if (mysqli_query($conexion, $sql)) {
        // La actualización fue exitosa
        // echo "El estado de la cita ha sido actualizado correctamente";
    } else {
        // Hubo un error en la actualización
        echo "Error al actualizar el estado de la cita: " . mysqli_error($conexion);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>CLÍNICA RED</title>
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">

    <!-- Favicons -->
    <link href="../../../../assets/img/red-logo.jpeg" rel="icon">

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
    <link rel="stylesheet" href="./V_gestion_historial_cita.css">

    <!-- Template Main CSS File -->
    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../../librerias/librerias.css"> <!-- archivo de encapsulamiento de librerias CSS -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- <script type="module" src="../../../../librerias/librerias.js"></script> -->

    <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- ESTILOS DE LA TABLA -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> <!-- MOSTRAR BOTONES DE REPORTE -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- IMPRIME PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->

    <!-- librerias javascript -->
    <script src="/PHP/Negocio/Cita/C_Cita/C_funciones_citas.js"></script> <!-- Funciones para el CRUD -->
    <!-- <script type="module" src="../C_Parametros/C_validacion_parametros.js"></script> Funciones de validación -->
    <script src="../../../../librerias/bootstrap/js/bootstrap.js"></script> <!-- libreria Bootstrap -->
    <script src="../../../../librerias/alertifyjs/js/alertify.js"></script> <!-- libreria Alertify -->

</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Historial de Expedientes</h1>
        </div><!-- End Page Title -->

        <div class="container mt-4">
            <div id="tablaHistorialExpediente"></div>
        </div>

    </main>
    <!-- dentro del main va la tabla o informacion -->

    <?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <!-- Vendor JS Files -->
    <script src="../../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#tablaHistorialExpediente').load('./V_gestion_historial_cita.php');
    });
</script>

<script>
    $(document).ready(function() {
        $('#guardarCita').click(function() {
            $('#tablaHistorialExpediente').load('./V_gestion_historial_cita.php');
        });
    });
</script>
<?php
// Verificar si se recibieron los datos del formulario
if (isset($_POST['id_expediente']) && isset($_POST['id_paciente'])) {
    // Obtener los valores de id_expediente e id_paciente del formulario
    $_SESSION['id_expediente'] = $_POST['id_expediente'];
    $_SESSION['id_paciente'] = $_POST['id_paciente'];

    // Ahora puedes utilizar $id_expediente y $id_paciente como necesites
    // echo "ID de expediente: $id_expediente <br>";
    // echo "ID de paciente: $id_paciente <br>";
} else {
    unset($_SESSION['id_expediente']);
    unset($_SESSION['id_paciente']);
    echo '
    <script>
        alertify.error("No se recibieron datos del expediente.");
    </script>';
}
?>
