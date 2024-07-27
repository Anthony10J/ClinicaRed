<?php
//session_start();
include '../../../Controladores/Conexion/Conexion_be.php';
include '../../../../Imagenes/base64.php';
// include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';

// $id_rol = $_SESSION['IdRol'];
// $id_objeto = Obtener_Id_Objeto('V_permisos');
// $Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

// if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
//     header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");
// }
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

    <!-- Estilos y librerias para reportes -->
    <link rel="stylesheet" href="../../../CSSReportes/botones.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>

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
                    <h2>Registro de Nuevo Usuario</h2>
                </center>
                <!-- <img src="../../Imagenes/logo2.jpg" style="align-items-left; width: 100px; height: 100px; border-radius: 50%;"> -->

                <form action="../C_Permisos/C_nuevo_permiso.php" method="POST" class="formulario__register"
                    id="registerFormUser">
                    <div class="contenedor__todo">
                        <table class="table" style:"align-items-center">
                            <tbody>
                                <tr>
                                    <!-- GRUPO ROL -->
                                    <td>
                                        <div class="gender-options" id="grupo__rol">
                                            <select type="int" class="formulario__input" name="rol" id="rol"
                                                class="form-control" autocomplete="off" placeholder="rol"
                                                class="combobox" required>
                                                <option value="0" selected>Seleccione un rol</option>
                                                <option value="4">ADMINISTRADOR</option>
                                                <option value="5">SECRETARIA</option>
                                                <option value="6">FISIATRA</option>
                                                <option value="7">TERAPEUTA</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" class="formulario__input" name="rol" id="rol"
                                                class="form-control" autocomplete="off" placeholder="rol"
                                                class="combobox" required>
                                                <option value="0" selected>Seleccione un módulo</option>
                                                <option value="1">PACIENTES</option>
                                                <option value="2">CITAS</option>
                                                <option value="3">EXPEDIENTES</option>
                                                <option value="4">HISTORIAL DE CITAS</option>
                                                <option value="5">USUARIOS</option>
                                                <option value="6">ROLES</option>
                                                <option value="7">PERMISOS</option>
                                                <option value="8">BITACORA</option>
                                                <option value="9">PARAMETROS</option>
                                                <option value="10">EVALUACION</option>
                                                <option value="11">TERAPEUTICO</option>
                                                <option value="12">IDENTIDAD</option>
                                                <option value="13">INICIO</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="gender-options">
                                            <label for="permisos">Permisos:</label>
                                            <input type="checkbox" name="insercion" id="insercion"> Inserción
                                            <input type="checkbox" name="eliminacion" id="eliminacion"> Eliminación
                                            <input type="checkbox" name="consulta" id="consultar"> Consulta
                                            <input type="checkbox" name="actualizacion" id="actualizacion">
                                            Actualización
                                            <input type="checkbox" name="reportes" id="reportes"> Reportes
                                            <!-- Agregar más permisos aquí -->
                                        </div>
                                    </td>
                                </tr>
                                <td>
                                    <button type="submit" id= "guardarnuevopermisobtn" class="btn btn-primary">Guardar</button>
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
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>
    <!-- <link href="../../../../assets/vendor/simple-datatables/permisos.css" rel="stylesheet">  -->

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