<?php
// Valida que el usuario debe iniciar sesión forzosamente para acceder al sistema
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
$Id_Usuario = $_SESSION['id_D'];
$IdRol = $_SESSION['IdRol'];
// include '../Controladores/Conexion/Conexion_be.php';


/////////////// Validar si se ha verificado el OTP y si el usuario está autenticado
if (!isset($_SESSION['autenticado']) || !isset($_SESSION["correo"])) {
  echo '
  <script>
      alert("Por favor, debes iniciar sesión.")
      window.location = "/index.php";
  </script>
';
session_destroy(); // Destruye la sesión
die(); 
}

// // // // // Ingresa al main sin el OTP
// if (!isset($_SESSION["correo"])) {
//     echo '
//           <script>
//                  alert("Por favor, debes iniciar sesión.")
//                 window.location = "/index.php";
//             </script>
//        ';
//     session_destroy(); // Destruye la sesión
//     die(); // el código se detiene en esta línea 
// }

// include '../../PHP/Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
// $id_rol = $_SESSION['IdRol'];
// $id_objeto = Obtener_Id_Objeto('Main');
// $Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

// if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
//     header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_Main.php");
// }
// $ocultarTerapeutico = false;
// $ocultarClinico = false;

// if ($Permisos_Objeto["Permiso_Terapeutico"] !== "1") {
//     $ocultarTerapeutico = true;
// }
// if ($Permisos_Objeto["Permiso_Clinico"] !== "1") {
//     $ocultarClinico = true;
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clínica RED - Rehabilitación y Electrodiagnóstico </title>
    <link rel="shortcut icon" href="../EstilosLogin/images/pestana.png" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="../../assets/img/red-logo.jpeg" rel="icon">
    <link href="../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">



    <!-- Vendor CSS Files -->
    <link href="../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#tablaAgenda').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                } //codigo para el lenguaje del archivo JSON
            });
        });

        // Definir función para redirigir al perfil
        function redirectToProfile() {
            // Obtener la URL del perfil
            var profileUrl = "../V_Perfil.php?id=<?php echo $_SESSION['usuario']; ?>";
            // Redirigir a la página de perfil
            window.location.href = profileUrl;
        }
    </script>
</head>

<body>

    <?php
    include '../../Recursos/Componentes/header.php';
    include '../../Recursos/Componentes/SideBar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>¡Bienvenido!</h1><br>
        </div><!-- End Page Title -->

        <?php
        ?>
        <section class="hero">
            <div class="contenido-hero">
            </div>
        </section>
        <div class="container mt-4">
            <div class="row">
                <div class="col-12">

                    <table class="table " id="tablaAgenda">
                        <thead class="encabezado bg-light table-info">
                            <tr>
                                <th scope="col">N°</th>
                                <th scope="col">id_cita</th>
                                <th scope="col">Paciente</th>
                                <th scope="col">Motivo</th>
                                <th scope="col">Fecha Cita</th>
                                <th scope="col">Hora Cita</th>
                                <th scope="col">Evaluador</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php

function validarIdCitaEstadoDos($id_cita, $id_citas_estado_dos) {
    // Verificar si el ID de la cita está presente en el arreglo
    return in_array($id_cita, $id_citas_estado_dos);
}

// Inicializar un arreglo para almacenar los IDs de las citas con estado igual a 2
$id_citas_estado_dos = array();

if ($IdRol === '6' || $IdRol === '7') {
    // Incluye el archivo de conexión a la base de datos
    include '../Controladores/Conexion/Conexion_be.php';

    if ($IdRol === '6') {
        // Consulta para rol Fisiatra
        $sql = "SELECT CT.id_Cita_Terapia, P.Nombre AS Paciente, CT.Descripcion_Cita AS Motivo, CT.Fecha_Cita, CT.Hora_Cita, E.id_Expediente,
                -- CAMPOS NO VISIBLES
                P.Numero_Documento, P.Ocupacion, P.Direccion, TIMESTAMPDIFF(YEAR, P.FechaNacimiento, CURDATE()) AS Edad, U.Nombre, P.Id_Paciente
            FROM tbl_cita_terapeutica AS CT
            INNER JOIN tbl_paciente AS P ON CT.Id_Paciente = P.Id_Paciente
            INNER JOIN tbl_expediente AS E ON CT.Id_Expediente = E.id_Expediente
            INNER JOIN tbl_ms_usuario AS U ON CT.Id_Especialista = U.Id_Usuario
            WHERE CT.Id_Estado_Cita = 2
            AND U.IdRol = 6
            AND U.Id_Usuario = $Id_Usuario
            ORDER BY CT.Hora_Cita ASC";

        // Ejecutar la consulta SQL
        $resultado = mysqli_query($conexion, $sql);

        // Llenar el arreglo con los IDs de las citas con estado igual a 2
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $id_citas_estado_dos[] = $fila['id_Cita_Terapia'];
        }
    } else if ($IdRol === '7') {
        // Consulta para rol Terapeuta
        $sql = "SELECT CT.id_Cita_Terapia, P.Nombre AS Paciente, CT.Descripcion_Cita AS Motivo, CT.Fecha_Cita, CT.Hora_Cita, E.id_Expediente,
                -- CAMPOS NO VISIBLES
                P.Numero_Documento, P.Ocupacion, P.Direccion, TIMESTAMPDIFF(YEAR, P.FechaNacimiento, CURDATE()) AS Edad, U.Nombre, P.Id_Paciente, CT.Id_Estado_Cita
            FROM tbl_cita_terapeutica AS CT
            INNER JOIN tbl_paciente AS P ON CT.Id_Paciente = P.Id_Paciente
            INNER JOIN tbl_expediente AS E ON CT.Id_Expediente = E.id_Expediente
            INNER JOIN tbl_ms_usuario AS U ON CT.Id_Especialista = U.Id_Usuario
            WHERE (CT.Id_Estado_Cita = 2 OR CT.Id_Estado_Cita = 3)
            AND U.IdRol = 7
            ORDER BY CT.Hora_Cita ASC";

        // Ejecutar la consulta SQL
        $resultado = mysqli_query($conexion, $sql);

        // Llenar el arreglo con los IDs de las citas con estado igual a 2
        while ($fila = mysqli_fetch_assoc($resultado)) {
            if ($fila['Id_Estado_Cita'] == 2) {
                $id_citas_estado_dos[] = $fila['id_Cita_Terapia'];
            }
        }
    }
} else {
    // Caso contrario, no se realiza ninguna consulta a la base de datos
    $sql = '';
}
// echo "IDs de citas con estado igual a 2: ";
// print_r($id_citas_estado_dos);

// echo "<h2>IDs de citas con estado igual a 2:</h2>";
// echo "<ul>";
// foreach ($id_citas_estado_dos as $id_cita) {
//     echo "<li>$id_cita</li>";
// }
// echo "</ul>";
// Aquí puedes utilizar el arreglo $id_citas_estado_dos según sea necesario


if ($sql !== '') { // Validar que la consulta no sea nula o vacía para realizar una consulta y obtener los datos
    $resultado = mysqli_query($conexion, $sql);

    $correlativo = 1; // Inicializamos el correlativo en 1
    while ($filas = mysqli_fetch_row($resultado)) {
        $datos = $filas[0] . "||" . $filas[1] . "||" . $filas[2] . "||" . $filas[3] . "||" . $filas[4] . "||" . $filas[5] . "||" . $filas[6] . "||" . $filas[7] . "||" . $filas[8] . "||" . $filas[9];
        // Guardar el arreglo en una variable de sesión
        $_SESSION['datos'] = $datos;
?>
        <tr>
            <td><?php echo $correlativo ?></td>
            <td><?php echo $filas[0] ?></td>
            <td><?php echo $filas[1] ?></td>
            <td><?php echo $filas[2] ?></td>
            <td><?php echo $filas[3] ?></td>
            <td><?php echo $filas[4] ?></td>
            <td><?php echo $filas[10] ?></td>
            <td>

                <!-- Formulario único para cada fila -->
                <?php if ($IdRol === '6') : ?>
                    <form action="../Negocio/Expediente/V_Expediente/V_expediente_clinico.php" method="post">

                        <?php

                        // if (isset($_SESSION['array_IdCita'])) {
                        //     $idCit = $_SESSION['array_IdCita'];
                        //     print_r($idCit);
                        // }
                        // function validarIdCitaEstadoDos($id_cita, $id_citas_estado_dos) {
                        //     // Verificar si el ID de la cita está presente en el arreglo
                        //     return in_array($id_cita, $id_citas_estado_dos);
                        // }
                        ?>

                        <input type="hidden" name="idCitaTerapia" value="<?php echo $filas[0]; ?>">
                        <!-- arreglo que se recibe con el id cita que viene de gestión citas -->
                        <input type="hidden" name="estadoCita" value="3">
                        <input type="hidden" name="datos" value="<?php echo urlencode($datos); ?>">
                        <button type="submit" class="btn btn-success" id="fisiatra" name="atenderCita">Atender</button>
                    </form>
                <?php endif; ?>
                <!-- Imprimir el contenido de $_SESSION['datos_citas'] para ver los IDs acumulados -->
                             <!-- Boton para el rol terapeuta -->
                             <?php if ($IdRol === '7' && $filas[12] === '2') : ?>

<form action="../Negocio/Expediente/V_Historiales/V_modal_historial_cita.php" method="POST">

    <input type="hidden" name="idCitaTerapia" value="<?php echo $filas[0]; ?>">

    <!-- Agrega un campo oculto para enviar el ID de expediente -->
    <input type="hidden" name="id_expediente" value="<?php echo $filas[5]; ?>">

    <!-- Agrega un campo oculto para enviar el ID de paciente -->
    <input type="hidden" name="id_paciente" value="<?php echo $filas[11]; ?>">

    <!-- ?php if (!$ocultarTerapeutico): ?> -->
    <button id="guardarDatos" name="guardarDatos" style="margin-top: 3px;" class="btn btn-success" type="submit">Atender</button>
    <!-- ?php endif; ?> -->
</form>
<?php endif; ?>

                                            <!-- Boton para el rol terapeuta -->
                                            <?php if ($IdRol === '7' && $filas[12] === '3') : ?>
                                                <form action="../Negocio/Procesos/C_procesos/C_estado_finalizado_cita.php" method="POST">
                                                    <input type="hidden" readonly name="Id_Cita_U" id="Id_Cita_U" value="<?php echo $filas[0]; ?>">
                                                    <button type="submit" class="btn btn-danger" id="guardarDatos" style="margin-top: 3px;" name="guardarDatos">Finalizar</button>
                                                </form>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                            <?php
                                    $correlativo++; // Incrementamos el correlativo en cada iteración
                                } // fin del ciclo while
                            } else {
                            }
                            ?>

                        </tbody>
                        <?php
                        // // Verificar si el arreglo de ID de citas está definido y no está vacío
                        // if (isset($_SESSION['array_IdCita']) && !empty($_SESSION['array_IdCita'])) {
                        //     echo "<h2>Arreglo de ID de citas:</h2>";
                        //     echo "<ul>";
                        //     // Recorrer el arreglo de ID de citas e imprimir cada elemento
                        //     foreach ($_SESSION['array_IdCita'] as $id_cita) {
                        //         echo $id_cita . " ";
                        //     }
                        //     echo "</ul>";
                        // } else {
                        //     echo "<p>No hay citas disponibles en este momento.</p>";
                        // }
                        ?>
                    </table>
                </div>
            </div>
        </div>
        <!-- Fin de Citas Proximas-->
    </main><!-- End #main -->

    <?php
    include '../../Recursos/Componentes/footer.html';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!-- Template Main JS File -->
    <script src="../../assets/js/main.js"></script>
</body>

</html>
<script>
    // Llenar el campo oculto 'datos' antes de enviar el formulario
    document.getElementById('datos').value = '<?php echo urlencode($datos); ?>';
</script>