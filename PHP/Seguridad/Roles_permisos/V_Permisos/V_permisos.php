<?php
                    // session_start();
                    include '../../../Controladores/Conexion/Conexion_be.php';
                    // Verificar si el usuario está logueado
                    ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Clínica RED</title>
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

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <script>
    $(document).ready(function() {
        $('#tablaAgenda').DataTable({
            language: {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            } //codigo para el lenguaje del archivo JSON
        });
          $('.editarBtn').click(function() {
                var idUsuario = $(this).data('id');
                // Redireccionar o hacer algo con el ID para editar
                window.location.href = './V_editar_usuario.php?id=' + idUsuario;
            });

            // Manejar clic en botón Eliminar
            $('.eliminarBtn').click(function() {
                var idUsuario = $(this).data('id');
                // Realizar una solicitud AJAX para eliminar el usuario con el ID proporcionado
                // Puedes usar jQuery.ajax o Fetch API para esto
             $.ajax({
                    url: '../C_Usuario/C_eliminar_usuario.php',
                    method: 'POST',
                    data: { id: idUsuario },
                    success: function(response) {
                //         // Actualizar la tabla o hacer algo después de eliminar
                //         // Puedes recargar la página o actualizar la tabla usando DataTables
                // Ejemplo de recargar la página:
                   location.reload();
                },
                error: function(error) {
                console.error("Error al eliminar usuario: " + error.responseText);
                }
                });
            });
       });
    </script>
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
                <form action="./V_nuevo_permiso.php" method="post">
                    <button id="agregarpermiso" class="btn btn-primary float-start">Agregar Permiso</button>
                </form>
                <table id="tablaAgenda" class="table">
                    <thead class="encabezado bg-light table-info">
                        <tr>
                            <th scope="col">Rol</th>
                            <th scope="col">Objeto</th>
                            <th scope="col">Agregar</th>
                            <th scope="col">Eliminar</th>
                            <th scope="col">Actualizar</th>
                            <th scope="col">Consultar</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Realizar la consulta SQL para seleccionar los permisos de la base de datos
                        $sql = "SELECT
                        r.Rol AS Rol,
                        o.Objeto AS Objeto,
                        p.Permiso_Insercion,
                        p.Permiso_Eliminacion,
                        p.Permiso_Actualizacion,
                        p.Permiso_Consultar
                    FROM
                        tbl_ms_permisos p
                    INNER JOIN
                        tbl_ms_roles r ON p.Id_Rol = r.Id_Rol
                    INNER JOIN
                        tbl_ms_objetos o ON p.Id_Objeto = o.Id_Objetos;";

                        $resultado = mysqli_query($conexion, $sql);
                        // Recorrer los resultados y mostrarlos en la tabla
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                            <tr>
                                <td><?php echo $fila['Rol']; ?></td>
                                <td><?php echo $fila['Objeto']; ?></td>
                                <td><?php echo $fila['Permiso_Insercion']; ?></td>
                                <td><?php echo $fila['Permiso_Eliminacion']; ?></td>
                                <td><?php echo $fila['Permiso_Actualizacion']; ?></td>
                                <td><?php echo $fila['Permiso_Consultar']; ?></td>
                                <td>
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
</main>



<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
          class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../../../assets/vendor/quill/quill.min.js"></script>
  <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../../../assets/vendor/php-email-form/validate.js"></script>
  <link href="../../../../assets/vendor/simple-datatables/permisos.css" rel="stylesheet"> <!-- CSS de permisos -->
  <link href="../../../assets/css/style.css" rel="stylesheet">

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