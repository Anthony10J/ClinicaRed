<?php
include("../../../Controladores/Conexion/Conexion_be.php");
// include("../../../../Imagenes/base64.php");
?>
<link href="./V_gestion_cita.css" rel="stylesheet">
<div class="row">

    <div class="col-sm-12">
        <!-- <table class="table table-hover table-condensed table-bordered" id="tablaParametrosLoad"> -->
        <table id="tablaCitasCanceladasLoad" class="table">
            <a href="./V_modal_cita.php">
                <button class="btn btn-primary btn-agregar">
                    <i class="fa-solid fa-arrow-left"></i> Regresar
                </button>
            </a>
            <thead class="encabezado bg-light table-info">

                <tr>
                    <td>N°</td>
                    <td>Tipo Cita</td>
                    <td>Motivo</td>
                    <td>Paciente</td>
                    <td>Evaluador</td>
                    <td>Fecha</td>
                    <td>Hora</td>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT
                CT.id_Cita_Terapia,
                TC.Descripcion,
                CT.Descripcion_Cita,
                P.Nombre,
                U.Nombre,
                CT.Fecha_Cita,
                CT.Hora_Cita
            FROM
                `tbl_cita_terapeutica` AS CT
            LEFT JOIN tbl_tipo_cita AS TC
            ON
                CT.Id_Tipo_Cita = TC.Id_Tipo_Cita
            INNER JOIN tbl_ms_usuario AS U
            ON
                CT.Id_Especialista = U.Id_Usuario
            INNER JOIN tbl_paciente AS P
            ON
                CT.Id_Paciente = P.Id_Paciente
            WHERE
                CT.Id_Estado_Cita = 5
            ORDER BY CT.Id_Estado_Cita = 2 DESC, CT.Hora_Cita ASC";



                $resultado = mysqli_query($conexion, $sql);
                $correlativo = 1; // Inicializamos el correlativo en 1
                while ($filas = mysqli_fetch_row($resultado)) {
                    $datos = $filas[0] . "||" . $filas[1] . "||" . $filas[2] . "||" . $filas[3] . "||" . $filas[4] . "||" . $filas[5] . "||" . $filas[6];
                ?>
                    <tr>
                        <td><?php echo $correlativo ?></td>
                        <td><?php echo $filas[1] ?></td>
                        <td><?php echo $filas[2] ?></td>
                        <td><?php echo $filas[3] ?></td>
                        <td><?php echo $filas[4] ?></td>
                        <td><?php echo $filas[5] ?></td>
                        <td><?php echo $filas[6] ?></td>
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
    // REPORTE DE CITAS
    $(document).ready(function() {
        $('#tablaCitasCanceladasLoad').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
            },
            dom: 'lBfrtip',
            paging: true,
            buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fas fa-file-excel"> Excel </i>',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6], // Índices de las columnas que quieres exportar
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
                        var title = 'Reporte de Citas Canceladas';
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
                        columns: [0, 1, 2, 3, 4, 5, 6],
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