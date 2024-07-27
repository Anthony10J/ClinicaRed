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
$id_objeto = Obtener_Id_Objeto('V_modal_expediente');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1"){
        header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");   
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
    <script src="../C_Expediente/C_funciones_expediente.js"></script> <!-- Funciones para el CRUD -->
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
            <h1>Gestión de Expediente</h1>
           
        </div><!-- End Page Title -->

        <div class="container mt-4">
            <div id="tablaExpediente"></div>
        </div>

        <!-- MODAL AGENDAR CITA -->
        <div class="modal fade" id="modalCrearExpediente" tabindex="-1" aria-labelledby="modalCrearExpedienteLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalAgendarCitaLabel">Crear Expediente</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">

                        <label for="DNI">DNI:</label>
                        <input type="text" name="DNI" id="DNI" placeholder="DNI Paciente" class="form-control input-sm">

                        <label for="Id_Paciente" hidden>Id Paciente:</label>
                        <input type="text" id="Id_Paciente" hidden name="Id_Paciente" placeholder="Id del paciente" class="form-control input-sm" readonly>
                        
                        <label for="Id_Expediente" hidden>Id Expediente:</label>
                        <input type="text" hidden id="Id_Expediente" name="Id_Expediente" placeholder="Id del expediente" class="form-control input-sm" readonly>
                        
                        <label for="nombrePaciente">Nombre Paciente:</label>
                        <input type="text" id="nombrePaciente" placeholder="Nombre del paciente" name="nombrePaciente" class="form-control input-sm mayuscula" readonly>

                        <script>
                            $(document).ready(function() {
                                $('#DNI').on('input', function() {
                                    var dni = $(this).val();
                                    if (dni !== '') {
                                        // Realizar consulta AJAX para buscar el nombre asociado al DNI
                                        $.ajax({
                                            type: 'POST',
                                            url: '../../Cita/C_Cita/C_buscar_paciente.php', // Ruta al script PHP para buscar el nombre
                                            data: {
                                                dni: dni
                                            },
                                            success: function(response) {
                                                var datos = response.split("||");
                                                // Asignar el nombre y el ID del paciente a los campos correspondientes
                                                $('#nombrePaciente').val(datos[0]); // Asignar el nombre al campo nombrePaciente
                                                $('#Id_Paciente').val(datos[1]); // Asignar el ID del paciente al campo Id_Paciente
                                                $('#Id_Expediente').val(datos[2]); // Asignar el ID del paciente al campo Id_Paciente
                                            },
                                            error: function() {
                                                alert('Error al buscar el paciente.');
                                            }
                                        });
                                    } else {
                                        // Limpiar el campo de nombre si el campo de DNI está vacío
                                        $('#nombrePaciente').val('');
                                        $('#Id_Paciente').val('');
                                        $('#Id_Expediente').val('');
                                    }
                                });
                            });
                        </script>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
                        <button type="submit" id="guardarexpediente" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA VER CITA -->
        <div class="modal fade" id="modalVerCita" tabindex="-1" aria-labelledby="modalVerCitaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalVerCitaLabel">Ver Expediente</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <label for="idExpediente_L" hidden>Id Cita:</label>
                        <input type="text" id="idExpediente_L" hidden readonly class="form-control input-sm">

                        <!-- <label for="DNI_L">DNI:</label>
                <input type="text" id="DNI_L" readonly class="form-control input-sm"> -->

                        <label for="numero_identificacion_L">Número Identificación:</label>
                        <input type="text" id="numero_identificacion_L" readonly class="form-control input-sm">

                        <label for="paciente_L">Paciente:</label>
                        <input type="text" id="paciente_L" readonly class="form-control input-sm">

                        <label for="creadoP_L">Creado Por:</label>
                        <input type="text" id="creadoP_L" readonly class="form-control input-sm">

                        <label for="fechaC_L">Fecha Creación:</label>
                        <input type="text" id="fechaC_L" readonly class="form-control input-sm">

                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="VerParametro" class="btn btn-primary">Actualizar</button> -->
                    </div>
                </div>
            </div>
        </div>

    </main>

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
        $('#tablaExpediente').load('../V_Expediente/V_gestion_expediente.php');
    });
</script>

<script>
    $(document).ready(function() {
        $('#guardarexpediente').click(function() {
            // $('#tablaExpediente').load('../V_Expediente/V_gestion_expediente.php');
            Id_Paciente = $('#Id_Paciente').val()
            insertarExpediente(Id_Paciente)
        });
    });
</script>