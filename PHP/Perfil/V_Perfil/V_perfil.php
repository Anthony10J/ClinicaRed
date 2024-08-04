<?php
include '../../Controladores/Conexion/Conexion_be.php';
include '../C_Perfil/C_perfil.php';
?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">
    <!-- Agregar enlaces a Bootstrap CSS -->
    <!-- Vendor CSS Files -->
    <link href="../../../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../../../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../../../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../../../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../../../assets/vendor/simple-datatables/Perfil.css" rel="stylesheet"> <!-- CSS del Perfil -->
    <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet"> 

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../../assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

    <style>
            
    </style>
</head>
<body>
<?php 
include '../../../Recursos/Componentes/header.php';
include '../../../Recursos/Componentes/SideBar.html';
?>
<main id="main" class="main">
    <div class="container mt-4">
        <div class="card profile-card">
            <div class="card-header bg-primary text-white text-center">
                <h5 class="card-title"><i class="fas fa-user fa-2x mr-1"></i>PERFIL DE USUARIO</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div id="imagenPerfil" class="position-relative">
                            
                        <img src="../../../assets/img/user-profile.png" class="img-fluid" >
                            <i class="fas fa-camera camera-icon" onclick="cambiarImagen()"></i>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <ul class="list-group list-group-flush">
                            <?php
                            mysqli_data_seek($resultado, 0);
                            while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                                <li class="list-group-item"><i class="fas fa-user"></i><strong> Nombre completo:</strong> <?php echo $fila['Nombre'] ?></li>
                                <li class="list-group-item"><i class="fas fa-user-tag"></i><strong> Usuario:</strong> <?php echo $fila['Usuario'] ?></li>
                                <li class="list-group-item"><i class="fas fa-envelope"></i><strong> Correo electrónico:</strong> <?php echo $fila['Correo'] ?></li>
                            <?php
                            } 
                            ?>
                        </ul>
                        <!-- <form action="./V_CambiarcontrasenaPerfil.php" method="POST" class="mt-2"> -->
                            <button id="btncambiocontraseñaperfil" onclick="cambiarContrasena()" class="btn btn-warning">Cambiar Contraseña</button>
                        <!-- </form> -->
                        <button id="btncerrarperfil" class="btn btn-danger" onclick="cerrarPerfil()">Cerrar Perfil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
include '../../../Recursos/Componentes/footer.html';
?>

<script>
    function cerrarPerfil() {
        // Redirigir al usuario a la página de cierre de sesión
            window.location.href = "../../Vistas/Main.php";
            
        }
    //     function editarPerfil() {
    //     // Obtener los datos del perfil
    //     var nombre = "<?php echo $fila['Nombre']; ?>";
    //     var usuario = "<?php echo $fila['Usuario']; ?>";
    //     var correo = "<?php echo $fila['Correo']; ?>";
    //     var dni = "<?php echo $fila['DNI']; ?>";
    //     var direccion = "<?php echo $fila['Direccion']; ?>";

    //     // Redirigir a la página de edición con los datos del perfil como parámetros en la URL
    //     window.location.href = "./V_editar_datos_perfil.php?nombre=" + nombre + "&usuario=" + usuario + "&correo=" + correo + "&dni=" + dni + "&direccion=" + direccion;
    // }

        function cambiarImagen() {
            // Obtener el input de tipo file
            var inputFile = document.createElement('input');
            inputFile.type = 'file';
            
            // Escuchar cambios en el input de tipo file
            inputFile.addEventListener('change', function(event) {
                var imagenPerfil = document.getElementById('imagenPerfil');
                var file = event.target.files[0];
                var reader = new FileReader();
                
                reader.onload = function(e) {
                    imagenPerfil.querySelector('img').src = e.target.result;
                };
                
                reader.readAsDataURL(file);
            });
            
            // Simular click en el input de tipo file
            inputFile.click();
        }
        
        
        function cambiarContrasena() {
            // Redirigir al usuario a la página de cambio de contraseña
            window.location.href = "./V_cambiarcontrasenaPerfil.php";
        }
        </script>
<!-- Vendor JS Files -->
<script src="../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
   <script src="../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="../../../assets/vendor/chart.js/chart.umd.js"></script>
   <script src="../../../assets/vendor/echarts/echarts.min.js"></script>
   <script src="../../../assets/vendor/quill/quill.min.js"></script>
   <script src="../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
   <script src="../../../assets/vendor/tinymce/tinymce.min.js"></script>
   <script src="../../../assets/vendor/php-email-form/validate.js"></script>

   <!-- Template Main JS File -->
   <script src="../../../assets/js/main.js"></script>

   <!-- Agrega los scripts de Bootstrap (jQuery y Popper.js) -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>