
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
  <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

  <!-- Estilos y librerias para reportes -->
  <link rel="stylesheet" href="../CSSReportes/botones.css">
</head>
<body>
  <?php
  include '../../Recursos/Componentes/header.php';
  include '../../Recursos/Componentes/SideBar.html';
  ?>

  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Mantenimiento de Bitácora</h1>
    </div>

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
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="star" class="form-label"><b> Desde:</b></label>
                    <input type="date" name="starn" id="star" class="form-control" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label for="fin" class="form-label"><b>Hasta:</b></label>
                    <input type="date" name="finn" id="fin" class="form-control" required>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group d-flex justify-content-between">
                    <button type="button" id="filtro" class="btn btn-primary mr-2">Filtrar</button>
                    <button type="button" id="qfiltro" class="btn btn-primary " onclick="location.reload()">Quitar filtro</button>
                  </div>
                </div>
              </div>
            </form><br><br>

            <table class="table" id="tablaAgenda">
              <thead class="encabezado bg-light table-info">
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Usuario</th>
                  <th scope="col">Acción</th>
                  <th scope="col">Fecha</th>
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
                INNER JOIN tbl_ms_objetos o ON b.Id_Objeto = o.Id_Objetos
                ORDER BY b.Fecha DESC";
                $resultado = mysqli_query($conexion, $sql);

                foreach ($resultado as $fila) {
                ?>
                  <tr>
                    <td><?php echo $fila['Id_Bitacora'] ?></td>
                    <td><?php echo $fila['Usuario'] ?></td>
                    <td><?php echo $fila['Accion'] ?></td>
                    <td><?php echo $fila['Fecha'] ?></td>
                    <td><?php echo $fila['Descripcion'] ?></td>
                    <td><?php echo $fila['Objeto'] ?></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <?php include '../../Recursos/Componentes/footer.html'; ?>

  <!-- Vendor JS Files -->
  <script src="../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../assets/vendor/php-email-form/validate.js"></script>
  <script src="../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../assets/vendor/chart.js/chart.min.js"></script>
  <script src="../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../assets/vendor/echarts/echarts.min.js"></script>

  <!-- Template Main JS File -->
  <script src="../../assets/js/main.js"></script>
  <script src="../JavaScript/Bitacora_filtro.js"></script>
</body>
</html>
