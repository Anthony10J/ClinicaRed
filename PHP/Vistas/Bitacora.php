<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
  // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
  // La sesión aún no está iniciada, entonces la inicias
  session_start();
}
include '../Controladores/Conexion/Conexion_be.php';
// include '../../PHP/Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
// $id_rol = $_SESSION['IdRol'];
// $id_objeto = Obtener_Id_Objeto('Bitacora.php');
// $Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);
// var_dump($Permisos_Objeto);
// if ($Permisos_Objeto["Permiso_Consultar"] !== "1"){
//         header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");   
// }
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

  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  <!-- Estilos y librerias para reportes -->
  <link rel="stylesheet" href="../CSSReportes/botones.css">
  <!-- <link rel="stylesheet" href="../CSSReportes/EstilosModal.css">  -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>

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
              <div class="row">

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
                </div>

                <div class="col-md-2">
                  <div class="form-group">
                    <button type="button" id="filtro" class="btn btn-primary">Filtrar</button>
                  </div>
                </div>

              </div>
            </form><br><br>

            <!-- <button type="button" class="btn btn-danger">
              <i class="fas fa-trash btn-depurar"></i> Depurar</button> -->
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

  <script>
    $(document).ready(function() {
      inicializarTable();
    });
  </script>

</html>