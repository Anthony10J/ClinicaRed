<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Controladores/Conexion/Conexion_be.php';
include ('../../../../Recursos/SweetAlerts.php');
include '../../../../Imagenes/base64.php';
include '../..//Roles_permisos/permisos/Obtener_Id_Objeto.php';
$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_usuario');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
    header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");
}

$ocultarInsercion = false;
$ocultarEliminacion = false;
$ocultarActualizacion = false;
$ocultarReportes = false;
if ($Permisos_Objeto["Permiso_Insercion"] !== "1") {
    $ocultarInsercion = true;
}
if ($Permisos_Objeto["Permiso_Eliminacion"] !== "1") {
    $ocultarEliminacion = true;
}
if ($Permisos_Objeto["Permiso_Actualizacion"] !== "1") {
    $ocultarActualizacion = true;
}
if ($Permisos_Objeto["Permiso_Reportes"] !== "1") {
    $ocultarReportes = true;
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
    <link rel="stylesheet" href="../../../CSSReportes/EstilosModal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>

</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle ">
            <h1>Mantenimiento de Usuarios </h1>

        </div>

        <br>
        <div class="container mt-4">
            <div class="row">
                <div class="col-10">
                    <form action="./V_nuevo_usuario.php" method="post"><br>
                        <!-- <button id="agregarusuario" class="btn btn-primary float-start">Agregar Usuario</button> -->
                        <?php if (!$ocultarInsercion): ?>
                            <button id="agregarusuario" class="btn btn-primary" data-toggle="modal"
                                data-target="#modalNuevoParametro"><i class="fa-solid fa-plus "></i> Agregar Usuario
                            </button>
                        <?php endif; ?>
                    </form>
                    <table id="tablaAgenda" class="table">
                        <thead class="encabezado bg-light table-info">
                            <tr>
                                <th scope="col">Id Usuario</th>
                                <th scope="col">DNI</th>
                                <th scope="col">Usuario</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <!-- <th scope="col">Estado</th> -->
                                <th scope="col">Rol</th>
                                <th scope="col">Género</th>
                                <th scope="col" class="ocultar">Fecha Nacimiento</th>
                                <th scope="col" class="ocultar">Fecha Contratación</th>
                                <th scope="col" class="ocultar">Fecha Creación</th>
                                <th scope="col" class="ocultar">Fecha Vencimiento</th>
                                <th scope="col">Creado Por</th>
                                <th scope="col">Acciones</th>
                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT
           u.Id_Usuario,
           u.DNI,
           u.Usuario,
           u.Correo,
           u.Nombre,
           u.Direccion,
           e.Descripcion AS Estado,
           r.Rol AS Rol,
           g.Descripcion AS Genero,
           u.Creado_Por, 
           u.Fecha_Creacion,
           u.Fecha_Vencimiento,
           u.FechaNacimiento,
           u.FechaContratacion
       FROM tbl_ms_usuario u
       INNER JOIN tbl_ms_roles r ON u.IdRol = r.Id_Rol
       INNER JOIN tbl_genero g ON u.IdGenero = g.IdGenero
       INNER JOIN tbl_estado_usuario e ON u.Estado_Usuario = e.Id_Estado
       WHERE e.Descripcion = 'Activo' AND r.Rol != 'SUPERADMINISTRADOR' order by u.Id_Usuario asc;";

                            $resultado = mysqli_query($conexion, $sql);
                            $correlativo = 1;
                            // Recorrer los resultados y mostrarlos en la tabla
                            foreach ($resultado as $fila) {
                                ?>
                                <tr>
                                    <td><?php echo $correlativo ?></td>
                                    <td><?php echo $fila['DNI'] ?></td>
                                    <td><?php echo $fila['Usuario'] ?></td>
                                    <td><?php echo $fila['Correo'] ?></td>
                                    <td><?php echo $fila['Nombre'] ?></td>
                                    <td><?php echo $fila['Direccion'] ?></td>
                                    <!-- <td>?php echo $fila['Estado'] ?></td> -->
                                    <td><?php echo $fila['Rol'] ?></td>
                                    <td><?php echo $fila['Genero'] ?></td>
                                    <td class="ocultar"><?php echo $fila['FechaNacimiento'] ?></td>
                                    <td class="ocultar"><?php echo $fila['FechaContratacion']; ?></td>
                                    <td class="ocultar"><?php echo $fila['Fecha_Creacion'] ?></td>
                                    <td class="ocultar"><?php echo $fila['Fecha_Vencimiento'] ?></td>

                                    <td><?php echo $fila['Creado_Por'] ?></td>

                                    <!-- Botones Editar y Eliminar -->
                                    <!-- Dentro del bucle foreach para mostrar los usuarios -->
                                    <td>
                                        <?php if (!$ocultarActualizacion): ?>
                                            <a href="./V_editar_usuario.php?id=<?php echo $fila['Id_Usuario']; ?>"
                                                class="btn btn-warning btn-sm pencil">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (!$ocultarEliminacion): ?>
                                            <button class="btn btn-danger btn-sm eliminarBtn trash"
                                                data-id="<?php echo $fila['Id_Usuario']; ?>">
                                                <i class="bi bi-trash"></i>
                                                <!--Script para manejar clic en botón Eliminar-->
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                                 $correlativo++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <button id="verMasBtn" class="btn btn-primary">Ver más</button>
                    <button id="verMenosBtn" class="btn btn-">Ver menos</button>
                    <?php if (!$ocultarEliminacion): ?>
                        <button id="verInactivosBtn" class="btn btn-warning"
                            onclick="redirigirAUsuariosInactivos()">Usuarios inactivos</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                // Manejar clic en botón Eliminar
                $('.eliminarBtn').click(function () {
                    var idUsuario = $(this).data('id');
                    var filaUsuario = $(this).closest('tr'); // Obtener la fila del usuario

                    Swal.fire({
                            title: "Inhabilitar Usuario",
                            text: "¿Estás seguro de que deseas inhabilitar este usuario?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Sí, Inhabilitar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                        $.ajax({
                            url: '../C_Usuario/C_eliminar_usuario.php',
                            method: 'POST',
                            data: {
                                id: idUsuario
                            },
                            success: function (response) {
                                // Ocultar la fila de usuario de la tabla
                                filaUsuario.hide(); // Ocultar la fila de usuario de la tabla
                                //  $('#tablaAgenda').load('./V_usuario.php');

                                // Mostrar la alerta de éxito
                                Swal.fire({
                                            title: "Éxito",
                                            text: "Registro Inactivo",
                                            icon: "success"
                                        }).then(() => {
                                            setTimeout(function () {
                                               // window.location.href = "../V_Usuario/V_usuario.php";
                                            }, 200);
                                        });
                            },
                            error: function (error) {
                                console.error("Error al eliminar usuario: " + error.statusText);
                            }
                        });
                    }
                });
                });
            });
        </script>


        <script>
            // Función para redirigir al hacer clic en el botón usuarios inactivos
            function redirigirAUsuariosInactivos() {
                // Redirige a la página usuariosInactivos.php
                window.location.href = './V_usuario_inactivos.php';
            }
        </script>


        <script>
            document.getElementById("verMasBtn").addEventListener("click", function () {
                const columnasOcultas = document.querySelectorAll("th.ocultar, td.ocultar");
                columnasOcultas.forEach(columna => columna.style.display = "table-cell");
                this.style.display = "none"; // Oculta el botón "Ver más" después de hacer clic
                document.getElementById("verMenosBtn").style.display = "block"; // Muestra el botón "Ver menos"
            });

            document.getElementById("verMenosBtn").addEventListener("click", function () {
                const columnasOcultas = document.querySelectorAll("th.ocultar, td.ocultar");
                columnasOcultas.forEach(columna => columna.style.display = "none");
                this.style.display = "none"; // Oculta el botón "Ver menos" después de hacer clic
                document.getElementById("verMasBtn").style.display = "block"; // Muestra el botón "Ver más"
            });

            // Ocultar las columnas iniciales (aquellas que tienen la clase "ocultar")
            document.querySelectorAll(".ocultar").forEach(columna => columna.style.display = "none");
        </script>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/assets/vendor/chart.js/chart.umd.js"></script>
        <script src="/assets/vendor/echarts/echarts.min.js"></script>
        <script src="/assets/vendor/quill/quill.min.js"></script>
        <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="/assets/vendor/php-email-form/validate.js"></script>

        <!-- Template Main JS File -->
        <script src="/assets/js/main.js"></script>

        <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <!-- ESTILOS DE LA TABLA -->
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <!-- MOSTRAR BOTONES DE REPORTE -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <!-- IMPRIME PDF -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
        <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->


        <?php
        // Ruta de la imagen
        $ruta_imagen = '../../../../Imagenes/logo3.jpeg';

        // Verificar si el archivo existe
        if (file_exists($ruta_imagen)) {
            // Leer el contenido de la imagen
            $contenido_imagen = file_get_contents($ruta_imagen);

            // Codificar la imagen en base64
            $ImagenBase64 = base64_encode($contenido_imagen);
        }
        ?>
        <script type="text/javascript">
            // REPORTE DE USUARIOS 
            $(document).ready(function () {
                $('#tablaAgenda').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    },
                    dom: 'lBfrtip',
                    paging: true,
                    buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"> Excel </i>',
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7, 8], // Índices de las columnas que quieres exportar
                            modifier: {
                                page: 'current'
                            },
                        }
                    },
                    {
                        <?php if (!$ocultarReportes): ?>
                        extend: 'pdfHtml5',
                        download: 'open',
                        text: '<i class="fas fa-file-pdf"> PDF </i>',
                        title: 'CLINICA RED',
                        orientation: 'landscape',
                        <?php endif; ?>
                        customize: function (doc) {

                            // Calcula la longitud máxima de los datos por columna
                            const maxLengths = [];
                            doc.content.forEach(function (section) {
                                if (section.table) {
                                    const tableData = section.table.body;

                                    // Inicializa la longitud máxima de cada columna
                                    if (maxLengths.length === 0) {
                                        for (let i = 0; i < tableData[0].length; i++) {
                                            maxLengths.push(0);
                                        }
                                    }

                                    // Calcula la longitud máxima de los datos por columna
                                    tableData.forEach(function (row) {
                                        row.forEach(function (cell, index) {
                                            const cellLength = cell.text ? cell.text.length : 0;
                                            if (cellLength > maxLengths[index]) {
                                                maxLengths[index] = cellLength;
                                            }
                                        });
                                    });
                                }
                            });

                            // Establece los anchos de las columnas en función de las longitudes máximas
                            doc.content.forEach(function (section) {
                                if (section.table) {
                                    const totalLength = maxLengths.reduce((sum, length) => sum + length, 0);
                                    const columnWidths = maxLengths.map(length => (length / totalLength) * 100 + '%');

                                    // Aplica los anchos calculados a la tabla
                                    section.table.widths = columnWidths;
                                    section.table.widths = columnWidths;
                                    section.table.body.forEach(row => {
                                        row.forEach(cell => {
                                            cell.alignment = 'center';
                                        });
                                    });
                                }
                            });
                            // Agregar un título al reporte
                            var title = 'Reporte de Usuarios';
                            // Obtener la fecha y hora actual
                            var now = new Date();
                            var date = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
                            var horas = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
                            // Agregar el título y la fecha/hora al PDF
                            doc.content.splice(1, 0, {
                                text: title,
                                fontSize: 15,
                                alignment: 'center'
                            });
                            doc.content.splice(2, 0, {
                                text: 'Fecha: ' + date + '\nHora: ' + horas,
                                alignment: 'left',
                                margin: [0, 10, 0, -70], // [left, top, right, bottom]
                            });
                            doc.content.splice(3, 0, {
                                margin: [0, -40, 0, 20],
                                alignment: 'right',
                                image: 'data:image/jpeg;base64,<?php echo $ImagenBase64; ?> ',
                                width: 85,
                                height: 100,
                            });

                            doc["footer"] = function (currentPage, pageCount) {
                                return {
                                    margin: 10,
                                    columns: [{
                                        fontSize: 10,
                                        text: [{
                                            text: "Página " +
                                                currentPage.toString() +
                                                " de " +
                                                pageCount,
                                            alignment: "center",
                                            bold: true
                                        },],
                                        alignment: "center",
                                    },],
                                };
                            };
                        },
                        exportOptions: {
                            columns: [0, 1, 3, 4, 5, 6, 7, 8],
                            modifier: {
                                page: 'current'
                            },
                        }
                    },
                    ],
                    "lengthMenu": [
                        [10, 25, 50, -1],
                        [10, 25, 50, "Todos"]
                    ],
                    "columnDefs": [{
                        "targets": 0,
                        "data": null,
                        "defaultContent": "",
                        "title": "N°", // Título de la columna
                        "render": function (data, type, row, meta) {
                            // Renderiza el número de fila
                            return meta.row + 1;
                        }
                    }]
                });
            });
        </script>

</body>

</html>