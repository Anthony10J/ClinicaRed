<?php
session_start(); // Iniciar la sesión si no está iniciada

// Verificar si la sesión ya está activa
if (!isset($_SESSION['usuario'])) {
  echo '
          <script>
                 alert("Por favor, debes iniciar sesión.")
                window.location = "/index.php";
            </script>
       ';
  session_destroy(); // Destruye la sesión
  die(); // el código se detiene en esta línea 
}

include '../Controladores/Conexion/Conexion_be.php';
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
  <link href="./bitacora.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script> -->

  <!-- Estilos y librerias para reportes -->
  <link rel="stylesheet" href="../CSSReportes/botones.css">
  <!-- <link rel="stylesheet" href="../CSSReportes/EstilosModal.css">  -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

</head>

<body>
  <?php
  include '../../Recursos/Componentes/header.php';
  include '../../Recursos/Componentes/SideBar.html';
  ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Mantenimiento de Bitácora</h1>
    </div><!-- End Page Title -->

    <!-- <button type="button" class="btn btn-secondary" style="padding: 3px 50px;" display="inline-block;"><i class="fas fa-file-pdf"></i> PDF</button> -->
    </div>

    <!-- Inserta la imagen centrada aquí -->
    <div class="text-center mb-4">
    </div>

    <?php
    include("../Controladores/Conexion/Conexion_be.php");
    ?>
    <div class="container mt-4">
      <div class="row">
        <div class="col-10">
          <div class="card-body">

            <form action="" method="POST" accept-charset="utf-8" id="filtro-form">

              <!-- Desde a Hasta en una sola línea -->

              <!-- <div class="row">

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="form-label"><b> Desde:</b></label>
                    <input type="date" name="star" id="star" class="form-control" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="" class="form-label"><b>Hasta: </b> </label>
                    <input type="date" name="fin" id="fin" class="form-control" required>
                  </div>
                </div> -->
              <div class="filter-container">
                <table class="inputs">
                  <tbody>
                    <tr>
                      <td><label for="min">Desde:</label></td>
                      <td><input type="date" id="min" name="min" class="date-input"></td>
                      <td><label for="max">Hasta:</label></td>
                      <td><input type="date" id="max" name="max" class="date-input"></td>
                      <td><button type="button" id="qfiltro" class="btn btn-secondary" onclick="location.reload()">Quitar filtro</button></td>
                     <td><button type="submit" id="deleteButton" class="btn btn-danger">Depurar</button></td>

                    </tr>
                  </tbody>
                </table>
              </div>

            </form><br><br>

           

            <table class="table " id="tablaAgenda">
              <thead class="encabezado bg-light table-info">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Acción</th>
                  <th scope="col">Fecha </th>
                  <th scope="col">Descripción</th>
                  <th scope="col">Objeto</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT
            b.Id_Bitacora,
            b.Fecha,
            u.Usuario AS Usuario,
            b.Accion,
            b.Descripcion,
            o.Objeto AS Objeto
        FROM tbl_bitacora b
        INNER JOIN tbl_ms_usuario u ON b.Id_Usuario = u.Id_Usuario 
         INNER JOIN tbl_ms_objetos o ON b.Id_Objeto = o.Id_Objetos ORDER BY b.Fecha DESC";
                $resultado = mysqli_query($conexion, $sql);
                // Recorrer los resultados y mostrarlos en la tabla
                foreach ($resultado as $fila) {
                ?>
                  <tr>
                    <td><?php echo $fila['Id_Bitacora'] ?></td>
                    <td><?php echo $fila['Usuario'] ?></td>
                    <td><?php echo $fila['Accion'] ?></td>
                    <td><?php echo $fila['Fecha'] ?></td>
                    <td><?php echo $fila['Descripcion'] ?></td>
                    <td><?php echo $fila['Objeto'] ?></td>
                    <!-- Botones Editar y Eliminar -->
                    <!-- Dentro del bucle foreach para mostrar los usuarios -->

                  </tr>
                <?php
                }
                ?>
              </tbody>
            </table>

            <style>
              #tablaAgenda td:first-child {
                text-align: right;
              }
            </style>
          </div>
        </div>
      </div>
  </main>

  <style>
    #qfiltro {
      /* font-size: 15px; */
      /* margin-bottom: 40px; */
      /* margin-right: 30px; */
      /* padding: 5px; */
      /* border: 0px solid #cccccc; */
      border-radius: 10px;
      /* display: inline-block; */
      /* position: absolute; */
      width: 100px;
      /* Ajusta este valor según el ancho que desees */
      /* height: 32px; */
      /* margin-left: 100px; */
      /* Ajusta este valor según el espacio que desees entre los botones */
    }

    table.inputs td {
      padding: 5px;
    }
  </style>

  <?php
  include '../../Recursos/Componentes/footer.html';
  ?>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../javascript/Bitacora_filtro.js"></script>

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

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>

  <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- ESTILOS DE LA TABLA -->
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script> <!-- MOSTRAR BOTONES DE REPORTE -->
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- IMPRIME PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
  <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->
  <!-- <script src="ruta/a/jspdf.min.js"></script> -->

  <?php
  // Ruta de la imagen
  $ruta_imagen = '../../Imagenes/logo3.jpeg';

  // Verificar si el archivo existe
  if (file_exists($ruta_imagen)) {
    // Leer el contenido de la imagen
    $contenido_imagen = file_get_contents($ruta_imagen);

    // Codificar la imagen en base64
    $ImagenBase64 = base64_encode($contenido_imagen);
  }
  ?>
  <!-- 
  <script>
    $(document).ready(function() {
      inicializarTable();
    });
  </script> -->


  <script type="text/javascript">
    // REPORTE DE USUARIOS 
    $(document).ready(function() {
      // Agregar filtro de fechas
      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
          // Obtener los valores de los campos de fecha mínima y máxima
          var min = new Date($('#min').val());
          var max = new Date($('#max').val());

          // Obtener la fecha del registro actual de la tabla, ignorando la hora
          var date = new Date(data[3].split(" ")[0]); // Ajustar el índice según la columna de fecha

          // Convertir a medianoche (00:00:00) para comparar solo la fecha
          min.setHours(0, 0, 0, 0);
          max.setHours(0, 0, 0, 0);
          date.setHours(0, 0, 0, 0);

          if (
            (isNaN(min.getTime()) && isNaN(max.getTime())) ||
            (isNaN(min.getTime()) && date <= max) ||
            (min <= date && isNaN(max.getTime())) ||
            (min <= date && date <= max)
          ) {
            return true;
          }
          return false;
        }
      );

      // Redibujar la tabla cuando cambien las fechas
      $('#min, #max').on('change', function() {
        table.draw();
      });

      // Inicializar DataTable
      var table = $('#tablaAgenda').DataTable({
        language: {
          url: 'https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json'
        },
        dom: 'lBfrtip',
        paging: true,
        buttons: [{
            extend: 'excelHtml5',
            <?php if (!$ocultarReportes) : ?>
              text: '<i class="fas fa-file-excel"> Excel </i>',
              exportOptions: {
                columns: [0, 1, 3, 4, 5], // Índices de las columnas que quieres exportar
                modifier: {
                  page: 'current'
                },
              }
          },
          {
            extend: 'pdfHtml5',
            download: 'open',
            text: '<i class="fas fa-file-pdf"> PDF </i>',
            title: 'CLINICA RED',
            orientation: 'landscape',
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
                section.table.body.forEach(row => {
                  row.forEach(cell => {
                    cell.alignment = 'center';
                  });
                });
              }
            });

            // Agregar un título al reporte
            var title = 'Reporte de Bitácora';
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
            columns: [0, 1, 3, 4, 5],
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


</html>