<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>CLÍNICA RED</title>
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">

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

    <!-- Estilos y librerias para reportes -->

    <link href="../../../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="../../../CSSReportes/botones.css">
    <link rel="stylesheet" href="../../../CSSReportes/EstilosModal.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>


    <!-- librerias css -->
    <link rel="stylesheet" href="../../../../librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../../../librerias/alertifyjs/css/alertify.css">
    <link rel="stylesheet" href="../../../../librerias/alertifyjs/css/themes/default.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- librerias javascript -->
    <script src="../C_Tratamientos/C_funciones_tipo_tratamiento.js"></script> <!-- Funciones para el CRUD -->
    <script src="../../../../librerias/bootstrap/js/bootstrap.js"></script> <!-- libreria Bootstrap -->
    <script src="../../../../librerias/alertifyjs/js/alertify.js"></script> <!-- libreria Alertify -->

</head>

<body>
    <?php
    include '../../../../Recursos/Componentes/SideBar.html';
    include '../../../../Recursos/Componentes/header.php';
    ?>
    <!-- ======= Header ======= -->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Mantenimiento Tipos de Tratamiento</h1>
          
        </div><!-- End Page Title -->

        <div class="container mt-4">
            <div id="tablaTipoTratamiento"></div>
        </div>

        <!-- MODAL AGREGAR Tratamiento -->
        <div class="modal fade" id="modalNuevaTratamiento" tabindex="-1" aria-labelledby="modalNuevaTratamientoLabel"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalNuevaTratamientoLabel">Agregar Nuevo Tratamiento</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <label for="tratamiento">Nombre del Tratamiento:</label>
                        <input type="text" name="tratamiento" id="tratamiento" placeholder="Nombre del tratamiento"
                            class="form-control input-sm mayuscula">
                         <p class="error" id="mensaje_error"></p>
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
                        <button type="button" id="guardarTratamiento" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA VER Tratamientos -->
        <div class="modal fade" id="modalVerTratamiento" tabindex="-1" aria-labelledby="modalVerTratamientoLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalVerTratamientoLabel">Ver Tratamientos</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="Id_Tratamiento_L" hidden readonly class="form-control input-sm">
                        <label>Tratamiento:</label>
                        <input type="text" id="tratamiento_L" readonly class="form-control input-sm">
                        <label>Valor:</label>
                        <input type="text" id="valorTratamiento_L" readonly class="form-control input-sm">
                        <!-- Seleccionar el tipo de terapia -->
                        <!-- <label>Tipo de Terapia:</label>
                        <input type="text" id="terapia_L" readonly class="form-control input-sm"> -->

                        <!--  <label>Fecha Creación:</label>
                        <input type="text" id="fechaCreacion_L" readonly class="form-control input-sm">
                        <label>Modificado Por:</label>
                        <input type="text" id="modificadoPor_L" readonly class="form-control input-sm">
                        <label>Fecha Modificación:</label>
                        <input type="text" id="fechaModificacion_L" readonly class="form-control input-sm"> -->
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" id="VerParametro" class="btn btn-primary">Actualizar</button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA EDITAR Tratamiento -->
       
             <div class="modal fade" id="modalEditarTratamiento"
            tabindex="-1" aria-labelledby="modalEditarTratamientoLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditarTratamientoLabel">Editar Tratamiento</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <label for="tratamiento">Nombre del Tratamiento:</label>
                        <input type="text" name="tratamiento_E" id="tratamiento_E" placeholder="Nombre del tratamiento"
                        class="form-control input-sm mayuscula">                         <p class="error" id="mensaje_error"></p>
                        <label for="idTipoTerapia" hidden>Id Tratamiento:</label>
                        <input type="hidden" readonly name="idTipoTerapia" id="idTipoTerapia"
                            placeholder="Nombre del tratamiento" class="form-control input-sm">
                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
                        <button type="button" id="actualizarTratamiento"
                            class="btn btn-primary btn-block">Actualizar</button>
                    </div>
                </div>
            </div>
            </div>
     
    </main>
    <!-- dentro del main va la tabla o informacion -->

    <?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


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

    <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- ESTILOS DE LA TABLA -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <!-- MOSTRAR BOTONES DE REPORTE -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- IMPRIME PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->

</body>

</html>

<script>
    $(document).ready(function () {
        $('#tablaTipoTratamiento').load('./V_mantenimiento_tratamiento.php');
    });
</script>

<script>
    $(document).ready(function () {
        $('#guardarTratamiento').click(function () {
           // $('#tablaTipoTratamiento').load('./V_mantenimiento_tratamiento.php');
           var tratamiento = $('#tratamiento').val();
            insertarTipoTratamiento(tratamiento);
            
        });

        $('#actualizarTratamiento').click(function () {
            actualizarTipoTratamiento();
           
        });
    });
</script>

<?php
// Verificar si se recibieron los datos del formulario
if (isset($_POST['Id_Tipo_Tratamiento'])) {
    // Obtener los valores de id_expediente e id_paciente del formulario
    $_SESSION['Id_Tipo_Tratamiento'] = $_POST['Id_Tipo_Tratamiento'];

    // Ahora puedes utilizar $id_expediente y $id_paciente como necesites
    // echo "ID de expediente: $id_expediente <br>";
    // echo "ID de paciente: $id_paciente <br>";
} else {
    unset($_SESSION['Id_Tipo_Tratamiento']);
    echo '
    <script>
        alertify.error("No se recibieron datos del expediente.");
    </script>';
}
?>
