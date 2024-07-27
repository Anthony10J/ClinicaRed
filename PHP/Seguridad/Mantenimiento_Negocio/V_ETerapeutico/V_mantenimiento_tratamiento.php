<?php
include("../../../Controladores/Conexion/Conexion_be.php");
// include("../../../../Imagenes/base64.php");
?>

<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

// Verificar si las variables de sesión existen
if (isset($_SESSION['Id_Tipo_Tratamiento'])) {
    // Acceder a las variables de sesión
    $Id_Tipo_Tratamiento = $_SESSION['Id_Tipo_Tratamiento'];

    // También puedes realizar cualquier otra lógica que necesites con estas variables
} else {
    // Si las variables de sesión no existen, puedes redirigir o mostrar un mensaje de error
    echo "Las variables de sesión no están disponibles.";
}
?>

<div class="row">
    <div class="col-sm-12">
        <!-- <table class="table table-hover table-condensed table-bordered" id="tablaParametrosLoad"> -->
        <table id="tablaTratamientoLoad" class="table">
            <!-- <br><h2>Mantenimiento de Parámetros</h2> -->
            <button style="width: 20%;" class="btn btn-primary btn-agregar" data-toggle="modal" data-target="#modalNuevaTratamiento">
                <i class="fa-solid fa-plus"></i> Agregar Tratamiento</button>

            <thead class="encabezado bg-light table-info">
                <tr>
                    <td>N°</td>
                    <td>Tipo de Terapia</td>
                    <td>Tipo de Tratamiento</td>
                    <td>Acciones</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT
                TT.Id_Tipo_Tratamiento,
                TT.Nombre AS TERAPIA,
                TTER.Nombre AS TRATAMIENTO,
                TTER.idTipoTerapia
            FROM
                `tbl_tipo_tratamiento` AS TT
            INNER JOIN tbl_tipo_terapia AS TTER
            ON
                TT.Id_Tipo_Tratamiento = TTER.Id_Tipo_Tratamiento
                WHERE TT.Id_Tipo_Tratamiento = $Id_Tipo_Tratamiento";
                $resultado = mysqli_query($conexion, $sql);
                $correlativo = 1; // Inicializamos el correlativo en 1
                while ($filas = mysqli_fetch_row($resultado)) {
                    $datos = $filas[0] . "||" . $filas[1] . "||" . $filas[2]. "||" . $filas[3];
                ?>

                    <tr>
                        <td><?php echo $correlativo ?></td>
                        <td><?php echo $filas[1] ?></td>
                        <td><?php echo $filas[2] ?></td>
                        <td>

                            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modalVerParametro" onclick="cargarDatosLectura('<//?php echo $datos; ?>')">
                                <i class="fa-solid fa-eye"></i></button> -->

                            <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditarTratamiento" onclick="cargarDatos('<?php echo $datos; ?>')">
                                <i class="fa-solid fa-pen-to-square"></i></button>

                            <button class="btn btn-danger" onclick="validarSiNo('<?php echo $filas[3]; ?>')"><i class="fa-solid fa-trash-can"></i></button>
                        </td>
                    </tr>
                <?php
                    $correlativo++; // Incrementamos el correlativo en cada iteración
                } // fin del ciclo while
                ?>
            </tbody>
        </table>
    </div>
</div>

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
        $('#tablaTratamientoLoad').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            },
            dom: 'lBfrtip',
            download: 'open',
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
                        var title = 'Reporte de Tipos de Tratamientos';
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
                        columns: [0, 1, 2],
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