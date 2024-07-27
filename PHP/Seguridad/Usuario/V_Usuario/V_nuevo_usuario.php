<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>CLÍNICA RED</title>
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">
    <meta content="" name="description">
    <meta content="" name="keywords">

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
    <link href="./Usuario.css" rel="stylesheet">

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
                    data: {
                        id: idUsuario
                    },
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
    <?php
    include '../../../Controladores/Conexion/Conexion_be.php';

    ?>


    <main id="main" class="table">
        <div class="container mt-4">
            <div class="col-12">
                <center>
                    <h2>Registro de Nuevo Usuario</h2>
                </center>
                <!-- <img src="../../Imagenes/logo2.jpg" style="align-items-left; width: 100px; height: 100px; border-radius: 50%;"> -->

                <form action="../C_Usuario/C_nuevo_usuario.php" method="POST" class="formulario__register" id="registerFormUser">
                    <div class="contenedor__todo">
                        <table class="table" style:"align-items-center">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- GRUPO DNI -->
                                        <div class="formulario__grupo" id="grupo__dni">
                                            <label for="dni" class="formulario__label">DNI</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" maxlength="13" pattern="[0-9]{13}" class="formulario__input" class="form-control" name="dni" id="dni" placeholder="DNI" required autocomplete="off">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO NOMBRE COMPLETO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__nombre">
                                            <label for="nombre" class="formulario__label">Nombre Completo</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" class="form-control" name="nombre" id="nombre" autocomplete="off" style="text-transform: uppercase" placeholder="Nombre completo" maxlength="80">
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
                                                <input type="email" class="formulario__input" class="form-control" name="correo2" id="correo2" autocomplete="off" placeholder="Correo Electrónico" maxlength="40">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO USUARIO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__usuario">
                                            <label for="usuario" class="formulario__label">Usuario</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" class="form-control" style="text-transform: uppercase" autocomplete="off" name="usuario" id="usuario" placeholder="Usuario" maxlength="15">
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
                                                <input type="password" class="formulario__input" name="password2" id="password2" autocomplete="off" placeholder="Contraseña" maxlength="30" style="width: 620px">
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
                                                <input type="password" class="formulario__input" class="form-control" name="password3" id="password3" autocomplete="off" placeholder="Confirmar contraseña" maxlength="30" style="width: 585px">
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
                                                <input type="text" class="formulario__input" class="form-control" name="direccion" id="direccion" autocomplete="off" style="text-transform: uppercase" placeholder="Dirección" maxlength="80">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO GENERO -->
                                    <td>
                                        <div class="formulario__grupo">
                                            <select type="text" class="formulario__input" name="genero" id="genero" class="form-control" autocomplete="off" placeholder="Genero" class="combobox">
                                                <option value="0" selected>Seleccione un género</option>
                                                <option value="1">MASCULINO</option>
                                                <option value="2">FEMENINO</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <!-- GRUPO FECHA NACIMIENTO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                            <label for="Fechavencimiento">Fecha de Nacimiento:</label>
                                            <input type="date" class="formulario__input" placeholder="Fecha de Nacimiento" autocomplete="off" name="fechanacimiento" id="fechanacimiento" class="form-control" min="1900-01-01" max="2006-01-01">
                                            <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: red;"></p>
                                        </div>
                                    </td>
                                    <!-- GRUPO FECHA CONTRATACION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                            <label for="Fechavencimiento">Fecha de Contratación:</label>
                                            <input type="date" class="formulario__input" name="fechacontratacion" id="fechacontratacion" autocomplete="off" class="form-control">
                                            <p id="mensajeFechaContratacion" class="mensaje_error" style="color: red;"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- GRUPO ROL -->
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" class="formulario__input" name="rol" id="rol" class="form-control" autocomplete="off" placeholder="rol" class="combobox">
                                                <option value="0" selected>Seleccione un rol</option>
                                                <option value="2">DEFECTO</option>
                                                <option value="3">USUARIO</option>
                                                <option value="4">ADMINISTRADOR</option>
                                                <option value="5">SECRETARIA</option>
                                                <option value="6">FISIATRA</option>
                                                <option value="7">TERAPEUTA</option>
                                            </select>
                                        </div>
                                    </td>
                                    <!-- GRUPO ESTADO USUARIO -->
                                    <td>
                                        <div class="gender-options">
                                            <div></div>
                                            <select type="int" class="formulario__input" class="form-control" name="estadoUser" id="estadoUser" autocomplete="off" placeholder="estadoUser" class="combobox">
                                                <option value="0" selected>Seleccione un estado</option>
                                                <option value="1">ACTIVO</option>
                                                <option value="2">INACTIVO</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button type="submit" id="Btnregistrar" class="btn btn-primary">Guardar</button>

                                    </td>
                                </form>
                                    <td>
                                        <!-- <a href="./V_usuario.php"> -->
                                        <button id="Btncancelar" class="btn btn-danger" type="button">Cancelar</button>
                                        <!-- </a> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        </div>
    </main>

     <script>
    var Btncancelar = document.getElementById('Btncancelar');
    Btncancelar.addEventListener('click', confirmarCancelar);

    function confirmarCancelar() {
        Swal.fire({
            title: "Quieres Cancelar esta Acción?",
            text: "Estas seguro que quieres Cancelar?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Cancelado",
                    text: "No se Guardaron registros",
                    icon: "success",
                    showConfirmButton: false
                });
               setTimeout(function() {
                    window.location = "./V_usuario.php";
                }, 1300);
            }
        });
    }
</script> 


    <!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="../../../../EstilosLogin/js/script.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="../../../javascript/validacionNuevoRegistroUsuario.js"></script>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

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
</body>

</html>