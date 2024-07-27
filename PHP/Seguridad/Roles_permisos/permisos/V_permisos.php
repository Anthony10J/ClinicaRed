<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Controladores/Conexion/Conexion_be.php';
include '../../../../Imagenes/base64.php';
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
// include '../C_nuevo_permiso.php';

$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_permisos');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
    header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");
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
            <h1>Permisos</h1>
        </div>
        <div class="container mt-4">
            <div class="row">
                <div class="col-10">
                    <!-- <form action="./V_nuevo_permiso.php" method="post">
                        <button id="agregarpermisobtn" class="btn btn-primary float-start">+Agregar Permiso</button>
                    </form><br> -->
                    <table id="tablaPermisos" class="table">
                        <thead class="encabezado bg-light table-info">
                            <tr>
                                <th></th>
                                <th scope="col">Rol</th>
                                <th scope="col">Objeto</th>
                                <th scope="col">Agregar</th>
                                <th scope="col">Eliminar</th>
                                <th scope="col">Actualizar</th>
                                <th scope="col">Consultar</th>
                                <th scope="col">Reportes</th>
                                <!--<th scope="col" class="ocultar">Fecha Nacimiento</th>-->
                                <!-- <th scope="col">Acciones</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT 
                            r.Id_Rol,
                            r.Rol AS Rol,
                            o.Objeto AS Objeto,
                            CASE p.Permiso_Insercion WHEN '1' THEN 'SI' ELSE 'NO' END AS Permiso_Insercion,
                            CASE p.Permiso_Eliminacion WHEN '1' THEN 'SI' ELSE 'NO' END AS Permiso_Eliminacion,
                            CASE p.Permiso_Actualizacion WHEN '1' THEN 'SI' ELSE 'NO' END AS Permiso_Actualizacion,
                            CASE p.Permiso_Consultar WHEN '1' THEN 'SI' ELSE 'NO' END AS Permiso_Consultar, 
                            CASE p.Permiso_Reportes WHEN '1' THEN 'SI' ELSE 'NO' END AS Permiso_Reportes
                        FROM tbl_ms_permisos p
                        INNER JOIN tbl_ms_roles r ON p.Id_Rol = r.Id_Rol
                        INNER JOIN tbl_ms_objetos o ON p.Id_Objeto = o.Id_Objetos
                        WHERE r.Id_Rol <> 1;";
                            $resultado = mysqli_query($conexion, $sql);
                            // Recorrer los resultados y mostrarlos en la tabla
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <tr>
                                    <td> </td>
                                    <td><?php echo $fila['Rol']; ?></td>
                                    <td><?php echo $fila['Objeto']; ?></td>
                                    <td><?php echo $fila['Permiso_Insercion']; ?></td>
                                    <td><?php echo $fila['Permiso_Eliminacion']; ?></td>
                                    <td><?php echo $fila['Permiso_Actualizacion']; ?></td>
                                    <td><?php echo $fila['Permiso_Consultar']; ?></td>
                                    <td><?php echo $fila['Permiso_Reportes']; ?></td>
                                </tr>

                            <?php
                                //  $correlativo++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <!-- <div> -->
                    <a href="./V_editar_permisos.php">
                        <button title="Editar permisos" class="btn btn-warning btn-sm pencil" id="editarpermisosbtn">
                            <i class="bi bi-pencil"></i> Editar Permisos</button>
                    </a>
                    <!-- </div> -->
                </div>
            </div>
    </main>

    <!-- <script>
        // Función para redirigir al hacer clic en el botón usuarios incativos
        function abrirVentanaPermisos(idRol) {
            // Redirige a la página usuariosInactivos.php
            window.location.href = '/PHP/Seguridad/Roles_permisos/permisos/V_editar_permisos.php';
        }
    </script> -->

    <?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>

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
        $(document).ready(function() {
            $('#tablaPermisos').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                },
                dom: 'lBfrtip',
                paging: true,
                buttons: [{
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel"> Excel </i>',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6,
                                7
                            ], // Índices de las columnas que quieres exportar
                            modifier: {
                                page: 'current'
                            },
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        download: 'open',
                        text: '<i class="fas fa-file-pdf"> PDF </i>',
                        orientation: 'portrait',
                        customize: function(doc) {
                            // Calcula la longitud máxima de los datos por columna
                            const maxLengths = [];
                            doc.content.forEach(function(section) {
                                if (section.table) {
                                    const tableData = section.table.body;

                                    // Inicializa la longitud máxima de cada columna
                                    if (maxLengths.length === 0) {
                                        for (let i = 0; i < tableData[0].length; i++) {
                                            maxLengths.push(0);
                                        }
                                    }

                                    // Calcula la longitud máxima de los datos por columna
                                    tableData.forEach(function(row) {
                                        row.forEach(function(cell, index) {
                                            const cellLength = cell.text ?
                                                cell.text.length : 0;
                                            if (cellLength > maxLengths[
                                                    index]) {
                                                maxLengths[index] =
                                                    cellLength;
                                            }
                                        });
                                    });
                                }
                            });

                            // Establece los anchos de las columnas en función de las longitudes máximas
                            doc.content.forEach(function(section) {
                                if (section.table) {
                                    const totalLength = maxLengths.reduce((sum, length) =>
                                        sum + length, 0);
                                    const columnWidths = maxLengths.map(length => (length /
                                        totalLength) * 100 + '%');

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
                            var title = 'Reporte de Permisos';
                            // Obtener la fecha y hora actual
                            var now = new Date();
                            var date = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now
                                .getFullYear();
                            var horas = now.getHours() + ':' + now.getMinutes() + ':' + now
                                .getSeconds();
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


                            doc["footer"] = function(currentPage, pageCount) {
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
                                        }, ],
                                        alignment: "center",
                                    }, ],
                                };
                            };
                        },
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7],
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
                    "render": function(data, type, row, meta) {
                        // Renderiza el número de fila
                        return meta.row + 1;
                    }
                }]

            });
        });
    </script>


</body>

</html>