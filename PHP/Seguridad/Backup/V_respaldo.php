<?php session_start();
if (!isset($_SESSION["usuario"])) {
    echo '
          <script>
                 alert("Por favor, debes iniciar sesión.")
                window.location = "/index.php";
            </script>
       ';
    session_destroy(); // Destruye la sesión
    die(); // el código se detiene en esta línea 
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Módulo de Backup</title> -->
    <link rel="stylesheet" href="./respaldo.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">

    <!-- Favicons -->
    <link href="../../../assets/img/red-logo.jpeg" rel="icon">
    <link href="../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <!-- Vendor CSS Files -->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="../../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="../../CSSReportes/botones.css">


</head>

<body>
    <?php
    include '../../../Recursos/Componentes/header.php';
    include '../../../Recursos/Componentes/SideBar.html';
    include_once './Connet.php';
    ?>
    <div class="container1">
        <header>
            <h1>Backups Generados</h1>
            <a href="./backup.php">
                <button class="primary-btn">Crear Respaldo</button>
            </a>
        </header>

        <section class="backups">
            <table id="tablaBackup" class="table">
                <!-- <h2>Backups Existentes</h2> -->
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Backup</th>
                        <!-- <th>Acciones</th> -->
                    </tr>
                </thead>
                <tbody>
                    <!-- Ejemplo de fila de datos de backups, que debe ser generado dinámicamente -->

                    <?php
                    // Directorio donde se almacenan los archivos de respaldo
                    $backup_dir = "../../../Base de Datos/Respaldos Backup/";

                    // Obtener la lista de archivos de respaldo en el directorio
                    $backups = array_diff(scandir($backup_dir), array('.', '..'));

                    // Ordenar archivos por fecha de modificación (descendente)
                    usort($backups, function ($a, $b) use ($backup_dir) {
                        return filemtime($backup_dir . $b) - filemtime($backup_dir . $a);
                    });

                    // Paginación
                    $total_backups = count($backups);
                    $backups_per_page = 15;
                    $total_pages = ceil($total_backups / $backups_per_page);
                    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $current_page = max(1, min($total_pages, $current_page));
                    $start_index = ($current_page - 1) * $backups_per_page;

                    // Mostrar los archivos de respaldo en la página actual
                    $backups_to_show = array_slice($backups, $start_index, $backups_per_page);
                    $correlativo = 1;
                    foreach ($backups_to_show as $backup) {
                        $modification_time = date("Y-m-d H:i:s", filemtime($backup_dir . $backup));

                        echo "<tr>";
                        // echo '<td>', "</td>";
                        echo "<td>$correlativo</td>";
                        echo "<td>$backup</td>";
                        // echo '<td>';
                        // echo '<button class="secondary-btn" onclick="downloadBackup(\'' . htmlspecialchars($backup, ENT_QUOTES) . '\')">Descargar</button> ';
                        // echo '<button class="danger-btn" onclick="deleteBackup(\'' . htmlspecialchars($backup, ENT_QUOTES) . '\')">Eliminar</button> ';
                        // echo '<button class="secondary-btn" onclick="restoreBackup(\'' . htmlspecialchars($backup, ENT_QUOTES) . '\')">Restaurar</button>';
                        // echo '</td>';
                        echo "</tr>";
                        $correlativo++;
                    }
                    ?>

                </tbody>
            </table>
        </section>
        <!-- Paginación -->
        <!-- <nav>
                            <ul class="pagination justify-content-center">
                                <?php if ($current_page > 1) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $current_page - 1 ?>">Anterior</a>
                                    </li>
                                <?php endif; ?>
                                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                                    <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                <?php if ($current_page < $total_pages) : ?>
                                    <li class="page-item">
                                        <a class="page-link" href="?page=<?= $current_page + 1 ?>">Siguiente</a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
    </div> -->

        <!-- <script>
        function createBackup() {
            alert('Iniciando la creación de un nuevo backup...');
            // Aquí iría el código para interactuar con el servidor y crear el backup
        }
    </script> -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
        <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
        <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
        <script src="../../../assets/vendor/quill/quill.min.js"></script>
        <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
        <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
        <script src="../../../assets/vendor/php-email-form/validate.js"></script>
        <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

        <!-- Template Main JS File -->
        <script src="../../../assets/js/main.js"></script>
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
        $ruta_imagen = '../../../Imagenes/logo3.jpeg';

        // Verificar si el archivo existe
        if (file_exists($ruta_imagen)) {
            // Leer el contenido de la imagen
            $contenido_imagen = file_get_contents($ruta_imagen);

            // Codificar la imagen en base64
            $ImagenBase64 = base64_encode($contenido_imagen);
        }
        ?>

        <script>
            // REPORTE DE CITAS
            $(document).ready(function() {
                $('#tablaBackup').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
                    },
                    dom: 'lBfrtip',
                    paging: true,
                    buttons: [{

                            extend: 'excelHtml5',
                            <?php if (!$ocultarReportes) : ?>
                                // text: '<i class="fas fa-file-excel"> Excel </i>',
                                exportOptions: {
                                    columns: [0, 1], // Índices de las columnas que quieres exportar
                                    modifier: {
                                        page: 'current'
                                    },
                                }
                        },
                        {
                            download: 'open',

                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf">  PDF </i>',
                            title: 'CLINICA RED',

                            orientation: 'portrait',
                        <?php endif; ?>
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
                                            const cellLength = cell.text ? cell.text.length : 0;
                                            if (cellLength > maxLengths[index]) {
                                                maxLengths[index] = cellLength;
                                            }
                                        });
                                    });
                                }
                            });

                            // Establece los anchos de las columnas en función de las longitudes máximas
                            doc.content.forEach(function(section) {
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
                            var title = 'Reporte de Backup';
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
                            columns: [0, 1],
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
                    // "columnDefs": [{
                    //     "targets": 0,
                    //     "data": null,
                    //     "defaultContent": "",
                    //     "title": "N°", // Título de la columna
                    //     "render": function(data, type, row, meta) {
                    //         // Renderiza el número de fila
                    //         return meta.row + 1;
                    //     }
                    // }]
                });
            });
        </script>
</body>

</html>