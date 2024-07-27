<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}

include("../../../Controladores/Conexion/Conexion_be.php");
// include("../../../../Imagenes/base64.php");
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_modal_expediente');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);


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

<div class="row">
    <div class="col-sm-12">
        <!-- <table class="table table-hover table-condensed table-bordered" id="tablaParametrosLoad"> -->
        <table id="tablaExpedienteLoad" class="table">
            <!-- <br><h2>Mantenimiento de Parámetros</h2> -->
            <?php if (!$ocultarInsercion): ?>
            <button class="btn btn-primary btn-agregar" data-toggle="modal" data-target="#modalCrearExpediente">
                <i class="fa-solid fa-plus"></i> Crear Expediente</button>
                <?php endif; ?>
            <thead class="encabezado bg-light table-info">
                <tr>
                    <td>N°</td>
                    <td>Número Identificación</td>
                    <td>Paciente</td>
                    <!-- <td>Encargado</td> -->
                    <td>Acciones</td>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT
                E.id_Expediente,
                P.Numero_Documento,
                P.Nombre,
                U.Usuario AS Creado_Por,
                E.Fecha_Creacion,
                P.Id_Paciente
            FROM
                tbl_paciente AS P
            INNER JOIN tbl_expediente AS E
            ON
                P.Id_Paciente = E.Id_Paciente
            INNER JOIN tbl_ms_usuario AS U
            ON
                E.id_Usuario = U.Id_Usuario";

                $resultado = mysqli_query($conexion, $sql);
                $correlativo = 1; // Inicializamos el correlativo en 1
                while ($filas = mysqli_fetch_row($resultado)) {
                    // $_SESSION['id_expediente'] = $filas[0];
                    // $_SESSION['id_paciente'] = $filas[5];

                    $datos = $filas[0] . "||" . $filas[1] . "||" . $filas[2] . "||" . $filas[3] . "||" . $filas[4];
                ?>
                    <tr>
                        <td><?php echo $correlativo ?></td>
                        <td><?php echo $filas[1] ?></td>
                        <td><?php echo $filas[2] ?></td>
                        <!-- <td>?php echo $filas[3] ?></td> -->
                        <td>

                            <button class="btn btn-primary" data-toggle="modal" data-target="#modalVerCita" onclick="cargarDatosLectura('<?php echo $datos; ?>')">
                                <i class="fa-solid fa-eye"></i></button>

                            <!-- <a href="../V_Historiales/V_modal_historial_cita.php"><button class="btn btn-warning">
                                    <i class="fa-solid fa-clock-rotate-left"></i></button></a> -->

                            <form action="../V_Historiales/V_modal_historial_cita.php" method="POST">
                                <!-- Agrega un campo oculto para enviar el ID de expediente -->
                                <input type="hidden" name="id_expediente" value="<?php echo $filas[0]; ?>">
                                <!-- Agrega un campo oculto para enviar el ID de paciente -->
                                <input type="hidden" name="id_paciente" value="<?php echo $filas[5]; ?>">
                                <!-- Botón para enviar el formulario -->
                                <button style="margin-top: 3px;" class="btn btn-warning" type="submit">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </button>
                            </form>


                            <!-- <button class="btn btn-danger" onclick="validarSiNo('<?php echo $filas[0]; ?>')"><i class="fa-solid fa-trash-can"></i></button> -->
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
        $('#tablaExpedienteLoad').DataTable({
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
                    <?php if (!$ocultarReportes): ?>
                    extend: 'pdfHtml5',
                    download: 'open',
                    text: '<i class="fas fa-file-pdf">  PDF </i>',
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
                        var title = 'Reporte de Expediente';
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