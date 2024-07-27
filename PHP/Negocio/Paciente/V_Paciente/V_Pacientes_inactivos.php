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

    <link rel="stylesheet" href="../../../CSSReportes/botones.css">
    <link rel="stylesheet" href="../../../CSSReportes/EstilosModal.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>

    <main id="main" class="main">

        <div class="pagetitle ">
            <h1> Pacientes Inactivos</h1>
        </div>
        <br>
        <div class="container mt-4">
            <div class="row">
                <div class="col-10">
                    <form action="./V_Paciente.php" method="post">
                        <button id="agregarusuario" class="btn btn-primary float-start">Regresar</button>
                    </form>
                    <table id="tablaAgenda" class="table">
                        <thead class="encabezado bg-light table-info">
                            <tr>
                                <th scope="col">Núm. de Documento</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Dirección</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Género</th>
                                <th scope="col">Número Documento</th>
                                <!--<th scope="col" class="ocultar">Fecha Nacimiento</th>-->
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT
                        p.Id_Paciente,
                        p.Numero_Documento,
                        p.Nombre,
                        p.Direccion,
                        p.FechaNacimiento,
                        g.Descripcion AS Genero,
                        tp.Descripcion AS Tipo_de_Documento
                        FROM tbl_paciente p
                        INNER JOIN tbl_genero g ON p.IdGenero = g.IdGenero
                        INNER JOIN tbl_tipo_documento tp ON p.Id_Tipo_Documento = tp.Id_Tipo_Documento
                        WHERE p.Estado_Paciente = 0";
                            $resultado = mysqli_query($conexion, $sql);
                            // Recorrer los resultados y mostrarlos en la tabla
                            foreach ($resultado as $fila) {
                            ?>
                                <tr>
                                    <td><?php echo $fila['Numero_Documento'] ?></td>
                                    <td><?php echo $fila['Nombre'] ?></td>
                                    <td><?php echo $fila['Direccion'] ?></td>
                                    <td><?php echo $fila['FechaNacimiento'] ?></td>
                                    <td><?php echo $fila['Genero'] ?></td>
                                    <td><?php echo $fila['Numero_Documento'] ?></td>
                                    <!-- Dentro del bucle foreach para mostrar los pacientes -->
                                    <td>
                                        <button class="btn btn-danger btn-sm activarBtn" data-id="<?php echo $fila['Id_Paciente']; ?>">Activar</button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <script>
            $(document).ready(function() {
                // Manejar clic en botón Eliminar
                $('.activarBtn').click(function() {
                    var idPaciente = $(this).data('id');
                    var filaPaciente = $(this).closest('tr'); // Obtener la fila del paciente

                    // Confirmar si realmente deseas eliminar el paciente
                    Swal.fire({
                        title: "Activar Paciente",
                        text: "¿Estás seguro de que deseas activar este paciente?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sí, Activar"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Realizar una solicitud AJAX para eliminar el paciente con el ID proporcionado
                            $.ajax({
                                url: '../C_Paciente/C_activar_paciente.php',
                                method: 'POST',
                                data: {
                                    id: idPaciente
                                },
                                success: function(response) {
                                    // Ocultar la fila de paciente de la tabla
                                    filaPaciente.hide(); // Ocultar la fila de paciente de la tabla
                                    // Mostrar la alerta de éxito
                                    Swal.fire({
                                        title: "Éxito",
                                        text: "Paciente Activado",
                                        icon: "success"
                                    }).then(() => {
                                        setTimeout(function() {
                                            window.location.href = "./V_Paciente.php";
                                        }, 2000);
                                    });
                                },
                                error: function(error) {
                                    console.error("Error al eliminar el paciente: " + error.statusText);
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </main>

    <?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <iclass="bi bi-arrow-up-short">
            </iclass=>
    </a>

    <!-- Vendor JS Files -->
    <script src="../../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../../assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>


    <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- ESTILOS DE LA TABLA -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> <!-- MOSTRAR BOTONES DE REPORTE -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- IMPRIME PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->

</body>

</html>

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
                        columns: [0, 1, 2, 3, 4, 5], // Índices de las columnas que quieres exportar
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
                        var title = 'Reporte de Pacientes Inactivos';
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