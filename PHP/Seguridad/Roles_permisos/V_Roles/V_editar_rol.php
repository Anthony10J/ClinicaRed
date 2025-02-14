<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Controladores/Conexion/Conexion_be.php';
// Verificar si el usuario está logueado
include '../permisos/Obtener_Id_Objeto.php';
$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_roles');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
    header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");
}
// Aquí puedes agregar una verificación de sesión o cualquier otro método de autenticación

// Obtener el ID del rol a editar desde la URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $idRol = $_GET['id'];

    // Consulta para obtener la información del rol
    $sql = "SELECT Id_Rol, Rol, Descripcion FROM tbl_ms_roles WHERE Id_Rol = $idRol";
    $resultado = mysqli_query($conexion, $sql);
    $rol = mysqli_fetch_assoc($resultado);
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
    <!-- <link href="../../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

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
    <link href="../../../../assets/vendor/simple-datatables/nuevo_rol.css" rel="stylesheet"> <!-- CSS de roles -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script type="module" src="../../../javascript/roles.js"></script>

</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>

    <!-- <main id="main" class="main">
        <div class="pagetitle">
            <h1>Editar Rol</h1>
        </div>
        <br>
        <div class="container mt-4">
            <div class="row">
                <div class="col-6">
                    <form action="../C_Roles/C_editar_rol.php" method="post">
                        <input type="hidden" name="id_rol" value="<?php echo $rol['Id_Rol']; ?>">
                        <div class="mb-3">
                            <label for="rol" class="form-label">Rol</label>
                            <input type="text" class="form-control" readonly id="rol" name="rol" value="<?php echo $rol['Rol']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" style="text-transform: uppercase;" id="descripcion" name="descripcion" rows="3"><?php echo $rol['Descripcion']; ?></textarea>
                        </div>
                        <button type="submit" id="Btnregistrarrol" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </main> -->
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Rol</title>
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <div class="container">
            <h2 class="titulo"> Editar Rol</h2>
            <form action="../C_Roles/C_editar_rol.php" method="post" id="registerRol">
                <div class="formulario__grupo" id="grupo__rol">
                    <label for="rol" class="formulario__label">ROL:</label>
                    <div class="formulario__grupo-input">
                        <label for="rol" class="form-label"></label>
                        <input type="hidden" name="id_rol" value="<?php echo $rol['Id_Rol']; ?>">
                        <input type="text" class="formulario__input" class="form-control" style="text-transform: uppercase;" id="rol" name="rol" value="<?php echo $rol['Rol']; ?>" maxlength="30" required>
                    </div>
                    <p class="formulario__input-error"></p>
                </div>
                <div class="formulario__grupo" id="grupo__descripcionrol">
                    <label for="descripcionrol" class="formulario__label">DESCRIPCIÓN:</label>
                    <div class="formulario__grupo-input">
                        <label for="descripcionRol" class="form-label"></label>
                        <input type="text " class="formulario__input" class="form-control" style="text-transform: uppercase;" id="descripcionrol" name="descripcionrol"
                            value="<?php echo $rol['Descripcion']; ?>" placeholder="DESCRIPCIÓN" maxlength="100" required>
                    </div>
                    <p class="formulario__input-error"></p>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn" id="Btnregistrarrol">ACTUALIZAR</button>
                    <button id="Btncancelar" class="btn btn-danger" type="button">CANCELAR</button>
                </div>
            </form>
        </div>
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
            document.getElementById('editRoleForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío inmediato del formulario

                // Mostrar la alerta de confirmación
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¿Deseas actualizar este rol?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, actualizar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Si el usuario confirma, se envía el formulario
                        this.submit();
                    }
                });
            });
        </script>
    </body>

    </html>
    <link rel="stylesheet" href="editar.css">


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

    <!-- <link href="/assets/css/style.css" rel="stylesheet"> -->
    <!-- <link href="../../../../assets/vendor/simple-datatables/roles.css" rel="stylesheet"> CSS de roles -->


    <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- ESTILOS DE LA TABLA -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> <!-- MOSTRAR BOTONES DE REPORTE -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- IMPRIME PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->


</body>

</html>