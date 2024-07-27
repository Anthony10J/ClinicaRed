<?php
include '../../Controladores/Conexion/Conexion_be.php';
include '../C_Perfil/C_editar_datos_perfil.php';

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
    <link href="../../../assets/vendor/simple-datatables/Editar_Perfil.css" rel="stylesheet"> <!-- CSS del Perfil -->
    <!-- <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet"> CSS del Perfil -->

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
<main id="main" class="table">
    <div class="container mt-5">
        <div class="card">
            <h5>Editar Datos Personales</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-7">
                        <form action="V_editar_datos_perfil.php" method="post">
                        <input type="hidden" name="idUsuario" value="<?php echo htmlspecialchars($usuario['Id_Usuario']); ?>">
                            <!-- Aquí podrías cargar los datos actuales del perfil en los campos del formulario -->
                            <div class="formulario__grupo" id="grupo__nombre">
                                <label for="nombre" class="formulario__label">Nombre Completo</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="text-transform: uppercase" placeholder="Nombre completo" maxlength="80" value="<?php echo htmlspecialchars($usuario['Nombre']); ?>" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <div class="formulario__grupo" id="grupo__usuario">
                                <label for="usuario" class="formulario__label">Usuario</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" maxlength="80" value="<?php echo htmlspecialchars($usuario['Usuario']); ?>" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <div class="formulario__grupo" id="grupo__correo">
                                <label for="correo" class="formulario__label">Correo Electrónico</label>
                                <div class="formulario__grupo-input">
                                    <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico" maxlength="100" value="<?php echo htmlspecialchars($usuario['Correo']); ?>" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <div class="formulario__grupo" id="grupo__dni">
                                <label for="dni" class="formulario__label">DNI</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI" maxlength="15" value="<?php echo htmlspecialchars($usuario['DNI']); ?>" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <div class="formulario__grupo" id="grupo__direccion">
                                <label for="direccion" class="formulario__label">Dirección</label>
                                <div class="formulario__grupo-input">
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección" maxlength="255" value="<?php echo htmlspecialchars($usuario['Direccion']); ?>" required>
                                </div>
                                <p class="formulario__input-error"></p>
                            </div>
                            <!-- Botones de guardar y cancelar -->
                            <div class="form-group">
                                <button id="guardarbtn" class="btn btn-primary">Guardar</button>
                                <button id="btncancelar" class="btn btn-secondary" onclick="window.history.back()">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php 
include '../../../Recursos/Componentes/footer.html';
?>

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
    <script type="module" src="../../../javascript/validacionEditarPerfil.js"></script>

      
</body>
</html>
