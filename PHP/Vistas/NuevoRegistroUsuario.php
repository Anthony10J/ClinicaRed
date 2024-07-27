<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ClínicaRED - Rehabilitación y Electrodiagnóstico </title>
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
                window.location.href = 'editar_usuario.php?id=' + idUsuario;
            });

            // Manejar clic en botón Eliminar
            $('.eliminarBtn').click(function() {
                var idUsuario = $(this).data('id');
                // Realizar una solicitud AJAX para eliminar el usuario con el ID proporcionado
                // Puedes usar jQuery.ajax o Fetch API para esto
             $.ajax({
                    url: 'eliminar_usuario.php',
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

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="../../assets/img/red-logo.jpeg" alt="">
                <span class="d-none d-lg-block">CLÍNICA RED</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <div class="search-bar">
            <form class="search-form d-flex align-items-center" method="POST" action="#">
                <input type="text" name="query" placeholder="Search" title="Enter search keyword">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
            </form>
        </div><!-- End Search Bar -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item d-block d-lg-none">
                    <a class="nav-link nav-icon search-bar-toggle " href="#">
                        <i class="bi bi-search"></i>
                    </a>
                </li><!-- End Search Icon-->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="../../assets/img/user.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">Administrador</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">

                            <h6><?php
                  echo $_SESSION['correo'];
                  ?>
                            </h6>
                            <span>Rol</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="../Controladores/Logout.php">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Cerrar Sesión</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->



    <?php
    include 'Conexion_be.php';
    ?>

    <style>
 #main {
  width: 80%; /* Puedes ajustar el ancho según tus necesidades */
  height: 80vh; /* Puedes ajustar la altura según tus necesidades */
}
.col-9 {
  border-radius: 20px;
  border: 10px; /* Puedes ajustar el color y grosor del borde según tus preferencias */
  padding: 20px; /* Ajusta el espaciado interno del contenedor */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); /* Agrega sombra al contenedor */
}

.row d-flex {
  margin: 0; /* Elimina el margen del contenedor */
}
  
.formulario {
	display: grid;
	grid-template-columns: 1fr 1fr;
	gap: 20px;
}

.formulario__grupo {
    margin-bottom: 10px; /* Espacio entre los grupos de campos */
}

.formulario__label {
    display: block;
    font-weight: 700;
    margin-bottom: -20px; /* Espacio entre el label y el input */
}

.formulario__grupo-input {
	position: relative;
}

.formulario__input {
	width: 100%;
	background: #fff;
	border: 3px solid transparent;
	border-radius: 3px;
	height: 45px;
	line-height: 45px;
	padding: 0 40px 0 10px;
	transition: .3s ease all;
}


.formulario__input:focus {
	border: 3px solid #0075FF;
	outline: none;
	box-shadow: 3px 0px 30px rgba(163,163,163, 0.4);
}

.formulario__input-error {
	font-size: 12px;
	margin-bottom: 0;
	display: none;
}
.formulario__input-error2 {
	font-size: 12px;
	margin-bottom: 0;
	display: none;
}

.formulario__input-error-activo {
	display: block;
}

.formulario__input-error-activo2 {
	display: block;
}

/* .formulario__validacion-estado {
	position: absolute;
	right: 10px;
	bottom: 15px;
	z-index: 100;
	font-size: 16px;
	opacity: 0;
} */

.ver_password {
	position: absolute;
	right: 10px;
	bottom: 15px;
	z-index: 100;
	font-size: 16px;
	opacity: 1;
}

.formulario__checkbox {
	margin-right: 10px;
}

.formulario__mensaje,
.formulario__grupo-btn-enviar {
	grid-column: span 2;
}

.formulario__mensaje {
	height: 45px;
	line-height: 45px;
	background: #F66060;
	padding: 0 15px;
	border-radius: 3px;
	display: none;
}

.formulario__mensaje-activo {
	display: block;
}

.formulario__mensaje p {
	margin: 0;
}

.formulario__grupo-btn-enviar {
	display: flex;
	flex-direction: column;
}

.formulario__btn:hover {
	box-shadow: 3px 0px 30px rgba(163,163,163, 1);
}

.formulario__mensaje-exito {
	font-size: 14px;
	color: #119200;
	display: none;
}

.formulario__mensaje-exito-activo {
	display: block;
}

/* ----- -----  Estilos para Validacion ----- ----- */
.formulario__grupo-correcto .formulario__validacion-estado {
	color: #1ed12d;
	opacity: 1;	
}
.formulario__grupo-correcto2 .formulario__validacion-estado {
	color: #1ed12d;
	opacity: 1;	
}

.formulario__grupo-incorrecto .formulario__label {
	color: #bb2929;
}

.formulario__grupo-incorrecto .formulario__validacion-estado {
	color: #bb2929;
	opacity: 1;
}

.formulario__grupo-incorrecto .formulario__input {
	border: 3px solid #bb2929;
}
.formulario__grupo-incorrecto2 .formulario__label {
	color: #bb2929;
}

.formulario__grupo-incorrecto2 .formulario__validacion-estado {
	color: #bb2929;
	opacity: 1;
}

.formulario__grupo-incorrecto2 .formulario__input {
	border: 3px solid #bb2929;
}

/*Logo del Login */
.logo {
    display: block;
    margin: -40px auto 10px auto; 
    width: 140px; /* Ajusta el ancho de acuerdo a tu diseño */
    
}

.combobox {
    height: 30px;
    width: 330px;
    
}
.fecha-nacimiento-label {
    margin-bottom: 0; /* Elimina el margen inferior del label */
    /* Otros estilos si es necesario */
}

.fecha-nacimiento-input {
    margin-top: 0px; /* Ajusta el margen superior del input */
    /* Otros estilos si es necesario */
}

.mayuscula {
    text-transform: uppercase;
}

    </style>

<main id="main" class="table">
    <div class="container mt-4">
            <div class="col-9">
            <center>
                <h2>Registro de Nuevo Usuario</h2>
            </center>
            <!-- <img src="../../Imagenes/logo2.jpg" style="align-items-left; width: 100px; height: 100px; border-radius: 50%;"> -->

                <form action="../Controladores/nuevousuariocontroller.php" method="POST" class="formulario__register" id="registerFormUser">
                <div class="contenedor__todo">
                        <table class="table" style:"align-items-center">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- GRUPO DNI -->
                                        <div class="formulario__grupo" id="grupo__dni">
                                            <label for="dni" class="formulario__label">DNI</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" maxlength="13" pattern="[0-9]{13}" class="form-control" name="dni" id="dni" placeholder="DNI" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO NOMBRE COMPLETO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__nombre">
                                            <label for="nombre" class="formulario__label">Nombre Completo</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="form-control" name="nombre" id="nombre" style="text-transform: uppercase" placeholder="Nombre completo" maxlength="80">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO CORREO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__correo2">
                                            <label for="correo2" class="formulario__label">Correo Electrónico</label>
                                            <div class="formulario__grupo-input">
                                                <input type="email" class="form-control" name="correo" id="correo" placeholder="usuario@dominio.com" maxlength="40">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO USUARIO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__usuario">
                                            <label for="usuario" class="formulario__label">Usuario</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="form-control" style="text-transform: uppercase" name="usuario" id="usuario" placeholder="Usuario" maxlength="15">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO CONTRASEÑA -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__password2">
                                            <label for="password2" class="formulario__label">Contraseña</label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="form-control" name="password2" id="password2" placeholder="Contraseña" maxlength="30">
                                                <i class="ver_password fas fa-eye"></i>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO CONFIRMACION CONTRASEÑA -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__password3">
                                            <label for="password3" class="formulario__label">Confirmar Contraseña</label>
                                            <div class="formulario__grupo-input">
                                                <input type="password" class="form-control" name="password3" id="password3" placeholder="Confirmar contraseña" maxlength="30">
                                                <i class="ver_password fas fa-eye"></i>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <!-- GRUPO DIRECCION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__direccion">
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="form-control" name="direccion" id="direccion" placeholder="Dirección" maxlength="80">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO FECHA NACIMIENTO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                        <label for="fecha_nacimiento" class="formulario__label">Ingrese su fecha de nacimiento</label>
                                            <input  type="date" placeholder="Fecha de Nacimiento" name="fechanacimiento" id="fechanacimiento" class="form-control" min="1900-01-01" max="2006-01-01" >
                                            <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: red;"></p>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO GENERO -->
                                    <td>
                                        <div class="formulario__grupo">
                                            <select type="text" name="genero" id="genero" class="form-control" placeholder="Genero" class="combobox">
                                                <option value="0" selected>Seleccione un género</option>
                                                <option value="1">Masculino</option>
                                                <option value="2">Femenino</option>
                                            </select>
                                        </div>
                                    </td>
                                    <!-- GRUPO FECHA CONTRATACION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                            <input type="date" name="fechacontratacion" id="fechacontratacion" class="form-control">
                                            <p id="mensajeFechaContratacion" class="mensaje_error" style="color: red;"></p>
                                        </div>
                                    </td>
                                    </tr>
                                    <tr>
                                    <!-- GRUPO ROL -->
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" name="rol" id="rol" class="form-control" placeholder="rol" class="combobox">
                                                <option value="0" selected>Seleccione un rol</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Defecto</option>
                                            </select>
                                        </div>
                                    </td>
                                    <!-- GRUPO ESTADO USUARIO -->
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" class="form-control" name="estadoUser" id="estadoUser" placeholder="estadoUser" class="combobox">
                                                <option value="0" selected>Seleccione un estado</option>
                                                <option value="1">Activo</option>
                                                <option value="2">Inactivo</option>
                                            </select>
                                        </div>
                                    </td>
                                    <!-- Botón cancelar -->
                                    </tr>  
                                    <tr>
                                    <td>
                                    <button type="submit" value="Registrar" class="btn btn-primary" 
                                    style="border: 1px solid #000;background-color: blue; padding: 10px 100px;">Guardar</button>

                                    </td>
                                    <td>
                                        <button id="cancelarbtn" onclick="confirmarCancelar()" class="btn btn-danger" 
                                        style="border: 1px solid #000;background-color: red; padding: 10px 100px; margin-right: 
                                        50px; vertical-align: middle">Cancelar</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<script>
    function confirmarCancelar() {
        // Mostrar un cuadro de diálogo de confirmación
        const confirmacion = confirm("¿Estás seguro de que deseas cancelar?");

        // Si el usuario hace clic en "Aceptar", redirigir a la pantalla de usuarios
        if (confirmacion) {
            // Redirigir a la pantalla de usuarios (reemplaza con la URL correcta)
            window.location.href = "../Vistas/Usuario.php";
        }
    }
</script>


    <!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="../../EstilosLogin/js/script.js"></script>    
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="../javascript/validacionNuevoRegistroUsuario.js"></script>

</body>
</html>