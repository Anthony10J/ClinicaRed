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

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clínica RED - Rehabilitación y Electrodiagnóstico </title>
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>

    <?php
    include '../../../Controladores/Conexion/Conexion_be.php';

    ?>

    <main id="main" class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center">Registrar Nuevo Rol</h2>
                        <form action="../C_Roles/C_nuevo_rol.php" method="POST" class="mt-4" id="registerRol">
                            <div class="formulario__grupo" id="grupo__rol">
                                <label for="rol" class="formulario__label">ROL:</label>
                                <div class="formulario__grupo-input">
                                    <label for="rol" class="form-label"></label>
                                    <input type="text" class="formulario__input" class="form-control" name="rol" id="rol" autocomplete="off" style="text-transform: uppercase" placeholder="ROL" maxlength="30" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <div class="formulario__grupo" id="grupo__descripcionrol">
                                <label for="descripcionrol" class="formulario__label">DESCRIPCIÓN:</label>
                                <div class="formulario__grupo-input">
                                    <label for="descripcionRol" class="form-label"></label>
                                    <input type="text" class="formulario__input" class="form-control" name="descripcionrol" id="descripcionrol" autocomplete="off" style="text-transform: uppercase" placeholder="DESCRIPCIÓN" maxlength="100" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" id="Btnregistrarrol" class="btn btn-primary">Guardar</button>
                                <button id="Btncancelar" class="btn btn-danger" type="button">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Agregar la librería de SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var Btncancelar = document.getElementById('Btncancelar');
        Btncancelar.addEventListener('click', confirmarCancelar);

        function confirmarCancelar() {
            Swal.fire({
                title: "¿Quieres Cancelar esta Acción?",
                text: "¿Estás seguro que quieres Cancelar?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Cancelado",
                        text: "No se Guardaron Registros",
                        icon: "success",
                        showConfirmButton: false
                    });
                    setTimeout(function() {
                        window.location = "./V_roles.php";
                    }, 1300);
                }
            });
        }
    </script>
    <script>
        document.getElementById('registerFormUser').addEventListener('submit', function(event) {
            event.preventDefault(); // Evitar el envío inmediato del formulario

            // Mostrar la alerta de confirmación
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¿Deseas crear este rol?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, crear',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, se envía el formulario
                    this.submit();
                }
            });
        });
    </script>


    <script>
        function cancelar() {
            const confirmacion = confirm("¿Estás seguro de que deseas cancelar?");
            if (confirmacion) {
                window.location.href = "./V_roles.php";
            }
            campos.forEach(function(campo) {
                campo.value = ''; // Limpiar el valor del campo
            });
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


    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="../../../../EstilosLogin/js/script.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="../../../javascript/roles.js"></script>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <link href="../../../../assets/vendor/simple-datatables/nuevo_rol.css" rel="stylesheet"> <!-- CSS de roles -->
    <link href="../../../assets/css/style.css" rel="stylesheet">

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>
</body>

</html>