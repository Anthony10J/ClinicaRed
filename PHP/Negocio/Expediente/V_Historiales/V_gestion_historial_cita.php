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
if (isset($_SESSION['id_expediente']) && isset($_SESSION['id_paciente'])) {
    // Acceder a las variables de sesión
    $id_expediente = $_SESSION['id_expediente'];
    $id_paciente = $_SESSION['id_paciente'];

    // Ahora puedes usar $id_expediente y $id_paciente según lo necesites
    // echo "ID de expediente: $id_expediente <br>";
    // echo "ID de paciente: $id_paciente <br>";
    // También puedes realizar cualquier otra lógica que necesites con estas variables
} else {
    unset($_SESSION['id_expediente']);
    unset($_SESSION['id_paciente']);

    // Si las variables de sesión no existen, puedes redirigir o mostrar un mensaje de error
    // echo "Las variables de sesión no están disponibles.";
}
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_modal_historial_cita');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
    header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");
}

$ocultarInsercion = false;
$ocultarEliminacion = false;
$ocultarActualizacion = false;
$ocultarReportes = false;
$ocultarTerapeutico = false;
$ocultarClinico = false;
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
if ($Permisos_Objeto["Permiso_Terapeutico"] !== "1") {
    $ocultarTerapeutico = true;
}
if ($Permisos_Objeto["Permiso_Clinico"] !== "1") {
    $ocultarClinico = true;
}
?>

<div class="row">
    <div class="col-sm-12">
        <table id="tablaHistorialExpedienteLoad" class="table">
            <thead class="encabezado bg-light table-info">
                <tr>
                    <td>N°</td>
                    <td>Identificación</td>
                    <td>Paciente</td>
                    <td>Evaluador</td>
                    <td>Fecha Cita</td>
                    <td>Hora Cita</td>
                    <td>Acciones</td>
                </tr>
            </thead>

            <tbody>
                <?php
                $sql = "SELECT 
                            E.id_Expediente,
                            CT.id_Cita_Terapia,
                            P.Numero_Documento,
                            P.Nombre,
                            U.Nombre AS Evaluador,
                            CT.Fecha_Cita,
                            CT.Hora_Cita,
                            DE.Id_Detalle_Expediente,
                            DT.Id_Detalle_Terapia,
                            CT.Id_Especialista,
                            P.Id_Paciente
                        FROM
                            tbl_paciente AS P
                        INNER JOIN tbl_expediente AS E
                        ON
                            P.Id_Paciente = E.Id_Paciente
                        INNER JOIN tbl_cita_terapeutica AS CT
                        ON
                            E.id_Expediente = CT.Id_Expediente
                        INNER JOIN tbl_ms_usuario AS U
                        ON
                            CT.Id_Especialista = U.Id_Usuario
                        INNER JOIN tbl_detalle_expediente AS DE
                        ON
                            CT.id_Cita_Terapia = DE.Id_Cita_Terapia
                            INNER JOIN tbl_detalle_terapia AS DT
                            ON
                            CT.id_Cita_Terapia = DT.Id_Cita_Terapia
                        WHERE
                            E.id_Expediente = $id_expediente AND P.Id_Paciente = $id_paciente
                            order by CT.Fecha_Cita ASC, CT.Hora_Cita ASC";

                $resultado = mysqli_query($conexion, $sql);
                $correlativo = 1; // Inicializamos el correlativo en 1
                while ($filas = mysqli_fetch_row($resultado)) {
                    $datos = $filas[0] . "||" . $filas[1] . "||" . $filas[2] . "||" . $filas[3] . "||" . $filas[4] . "||" . $filas[5] . "||" . $filas[6] . $filas[7] . "||" . $filas[8] . "||" . $filas[9] . "||" . $filas[10];
                    $id_Cita_Terapia = $filas[1];
                    $Detalle_Expediente = $filas[7];
                    $Detalle_Terapia = $filas[8];
                ?>
                    <tr>
                        <td><?php echo $correlativo ?></td>
                        <td><?php echo $filas[2] ?></td>
                        <td><?php echo $filas[3] ?></td>
                        <td><?php echo $filas[4] ?></td>
                        <td><?php echo $filas[5] ?></td>
                        <td><?php echo $filas[6] ?></td>
                        <!-- <td>?php echo $filas[3] ?></td> -->
                        <td>

                            <form action="../../../../fpdf%20expediente/R_clinico.php" target="_blank" method="POST">
                                <!-- Agrega un campo oculto para enviar el ID de expediente -->
                                <input type="hidden" name="id_Cita_Terapia" value="<?php echo $id_Cita_Terapia ?>">
                                <!-- Agrega un campo oculto para enviar el ID de paciente -->
                                <input type="hidden" name="Detalle_Expediente" value="<?php echo $Detalle_Expediente ?>">
                                <!-- Botón para enviar el formulario -->
                                <?php if (!$ocultarClinico) : ?>
                                    <button title="Expediente clínico" class="btn btn-primary"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                                <?php endif; ?>
                            </form>

                            <form action="../V_Expediente/V_editar_expediente_clinico.php" method="POST">
                                <!-- Agrega un campo oculto para enviar el ID de expediente -->
                                <input type="hidden" name="id_Cita_Terapia" value="<?php echo $id_Cita_Terapia ?>">
                                <!-- Agrega un campo oculto para enviar el ID de paciente -->
                                <input type="hidden" name="Detalle_Expediente" value="<?php echo $Detalle_Expediente ?>">
                                <!-- Botón para enviar el formulario -->
                                <?php if (!$ocultarActualizacion) : ?>
                                    <button title="Editar Expediente clínico" class="btn btn-warning editar__expediente"><i class="fa-solid fa-pen-to-square"></i></button>
                                <?php endif; ?>
                            </form>
                            <div class="fila__botones-terapeutico" >
                                <form action="../../../../fpdf%20expediente/R_terapeutico.php" target="_blank" method="POST">
                                    <!-- Agrega un campo oculto para enviar el ID de expediente -->
                                    <input type="hidden" name="id_Cita_Terapia" value="<?php echo $id_Cita_Terapia ?>">
                                    <!-- Agrega un campo oculto para enviar el ID de paciente -->
                                    <input type="hidden" name="Detalle_Terapia" value="<?php echo $Detalle_Terapia ?>">
                                    <!-- Botón para enviar el formulario -->
                                    <?php if (!$ocultarTerapeutico) : ?>
                                        <button title="Expediente terapéutico" class="btn btn-danger"><i class="fa-solid fa-file-pdf"></i> PDF</button>
                                    <?php endif; ?>
                                </form>

                                <form action="../V_Expediente/V_editar_expediente_terapeutico.php" method="POST">
                                    <!-- Agrega un campo oculto para enviar el ID de expediente -->
                                    <input type="hidden" name="id_Cita_Terapia" value="<?php echo $id_Cita_Terapia ?>">
                                    <!-- Agrega un campo oculto para enviar el ID de paciente -->
                                    <input type="hidden" name="Detalle_Terapia" value="<?php echo $Detalle_Terapia ?>">
                                    <!-- Botón para enviar el formulario -->
                                    <?php if (!$ocultarActualizacion) : ?>
                                        <button title="Expediente terapéutico" class="btn btn-success editar__expediente"><i class="fa-solid fa-pen-to-square"></i> </button>
                                    <?php endif; ?>
                                </form>
                            </div>
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
        $('#tablaHistorialExpedienteLoad').DataTable({
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
                    <?php if (!$ocultarReportes) : ?>
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
                        var title = 'Reporte Historial de Expediente';
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
                        columns: [0, 1, 2, 3, 4, 5],
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