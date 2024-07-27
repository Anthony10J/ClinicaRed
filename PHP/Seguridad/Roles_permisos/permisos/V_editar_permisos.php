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
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CLÍNICA RED</title>
    <link rel="shortcut icon" href="./EstilosLogin/images/pestana.png" type="image/x-icon">

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
        <div class="pagetitle">
            <h1>Permisos por Rol</h1>
        </div>
        <br>
        <div class="container mt-4">
            <div class="row">
                <div class="col-10">
                    <form action="../C_Permisos/C_editar_permiso.php" method="post">
                        <button id="guardarpermisobtn" class="btn btn-primary float-start">Guardar cambios</button>
                        <table id="tablaEditarPermisos" class="table">
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Realizar la consulta SQL para seleccionar los permisos de la base de datos
                                $sql = "SELECT 
                            r.Rol AS Rol,
                            o.Objeto AS Objeto,
                            p.Permiso_Insercion AS Permiso_Insercion,
                            p.Permiso_Eliminacion AS Permiso_Eliminacion,
                            p.Permiso_Actualizacion AS Permiso_Actualizacion,
                            p.Permiso_Consultar AS Permiso_Consultar, 
                            p.Permiso_Reportes AS Permiso_Reportes
                        FROM tbl_ms_permisos p
                        INNER JOIN tbl_ms_roles r ON p.Id_Rol = r.Id_Rol
                        INNER JOIN tbl_ms_objetos o ON p.Id_Objeto = o.Id_Objetos WHERE r.Id_Rol <> 1;";

                                $resultado = mysqli_query($conexion, $sql);

                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo '<tr>';
                                    echo '<td></td>';
                                    echo '<td>' . $fila['Rol'] . '</td>';
                                    echo '<td>' . $fila['Objeto'] . '</td>';
                                    echo '<td><select name="permisos[' . $fila['Rol'] . '][' . $fila['Objeto'] . '][agregar]">
                            <option value="1"' . ($fila['Permiso_Insercion'] == 1 ? 'selected' : '') . '>SI</option>
                            <option value="0"' . ($fila['Permiso_Insercion'] == 0 ? 'selected' : '') . '>NO</option>
                          </select></td>';
                                    echo '<td><select name="permisos[' . $fila['Rol'] . '][' . $fila['Objeto'] . '][eliminar]">
                            <option value="1"' . ($fila['Permiso_Eliminacion'] == 1 ? 'selected' : '') . '>SI</option>
                            <option value="0"' . ($fila['Permiso_Eliminacion'] == 0 ? 'selected' : '') . '>NO</option>
                          </select></td>';
                                    echo '<td><select name="permisos[' . $fila['Rol'] . '][' . $fila['Objeto'] . '][actualizar]">
                            <option value="1"' . ($fila['Permiso_Actualizacion'] == 1 ? 'selected' : '') . '>SI</option>
                            <option value="0"' . ($fila['Permiso_Actualizacion'] == 0 ? 'selected' : '') . '>NO</option>
                          </select></td>';
                                    echo '<td><select name="permisos[' . $fila['Rol'] . '][' . $fila['Objeto'] . '][consultar]">
                            <option value="1"' . ($fila['Permiso_Consultar'] == 1 ? 'selected' : '') . '>SI</option>
                            <option value="0"' . ($fila['Permiso_Consultar'] == 0 ? 'selected' : '') . '>NO</option>
                          </select></td>';
                                    echo '<td><select name="permisos[' . $fila['Rol'] . '][' . $fila['Objeto'] . '][reportes]">
                            <option value="1"' . ($fila['Permiso_Reportes'] == 1 ? 'selected' : '') . '>SI</option>
                            <option value="0"' . ($fila['Permiso_Reportes'] == 0 ? 'selected' : '') . '>NO</option>
                          </select></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                        </form>
                </div>
            </div>
        </div>
    </main>

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
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> LIBRERIA PDF -->
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

<script>
    // REPORTE DE PARAMETROS 
    $(document).ready(function() {
        $('#tablaEditarPermisos').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            },
            dom: 'lBfrtip',
            paging: true,
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"> Excel </i>',
                    exportOptions: {
                        columns: [0, 1, 2], // Índices de las columnas que quieres exportar
                        modifier: {
                            page: 'current'
                        },
                    }
                },
                {
                    extend: 'pdfHtml5',
                    download: 'open',
                    text: '<i class="fas fa-file-pdf">  PDF </i>',
                    orientation: 'landscape',
                    customize: function(doc) {
                       
                        // Agregar un título al reporte
                        var title = 'Reporte Permisos Asignados';
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