<?php
include('../../../../Recursos/SweetAlerts.php');
include '../../../Controladores/Conexion/Conexion_be.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>ClÍNICA RED</title>
    <link rel="shortcut icon" href="./EstilosLogin/images/pestana.png" type="image/x-icon">

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
    
    <link href="./nuevopaciente.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

  
</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>


    <main id="main" class="table">
        <div class="container mt-4">
            <div class="col-12">
                <center>
                    <h2>Registro de Nuevo Paciente</h2>
                </center>
                <!-- <img src="../../Imagenes/logo2.jpg" style="align-items-left; width: 100px; height: 100px; border-radius: 50%;"> -->
                <form action="../C_Paciente/C_nuevo_paciente.php" method="POST" class="formulario__register" id="registerFormPaciente">
                    <div class="contenedor__todo">
                        <table class="table" style:"align-items-center">
                            <tbody>
                                <tr>
                                    <!-- GRUPO NOMBRE COMPLETO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__nombre">
                                            <label for="nombre">Nombre Completo</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" name="nombre" class="form-control"  id="nombre" autocomplete="off" style="text-transform: uppercase" placeholder="Ingrese su nombre completo." maxlength="80">
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <?php
                                    $sql = "SELECT * FROM tbl_genero";
                                    $genero = mysqli_query($conexion, $sql);
                                    ?>
                                    <!-- GRUPO GENERO -->
                                    <td>
                                        <div class="formulario__grupo">
                                            <label for="genero">Género</label>
                                             <select type="text" class="formulario__input" name="genero" id="mensajeGenero1" class="form-control" autocomplete="off" placeholder="Genero" class="combobox">
                                                <option value="0">Seleccione un género</option>
                                                <?php
                                                foreach ($genero as $value) {
                                                ?>
                                                    <option value="<?php echo $value['IdGenero']; ?>"><?php echo $value['Descripcion']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <p id="mensajeGenero2" class="mensaje_error" style="color: #bb2929;" ></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <!-- GRUPO FECHA NACIMIENTO -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__fecha">
                                            <label for="fechanacimiento">Fecha de Nacimiento:</label>
                                            <div class="formulario__grupo-input">
                                                <input type="date" class="formulario__input" placeholder="Fecha de Nacimiento" autocomplete="off" name="fechanacimiento" id="fechanacimiento">
                                            </div>
                                            <!-- <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: red;"></p> -->
                                            <p id="mensajeFechaNacimiento" class="mensaje_error" style="color: #bb2929;"></p>

                                        </div>
                                    </td>
                                    <!-- GRUPO DIRECCION -->
                                    <td>
                                        <div class="formulario__grupo" id="grupo__direccion">
                                            <label for="direccion">Dirección</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" class="formulario__input" name="direccion" id="direccion" autocomplete="off" style="text-transform: uppercase" placeholder="Ingrese su dirección" maxlength="80" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $sql = "SELECT * FROM tbl_tipo_documento";
                                    $resultado = mysqli_query($conexion, $sql);
                                    ?>
                                    <!-- GRUPO TIPO DE DOCUMENTO -->
                                    <td>
                                        <div class="gender-options">
                                            <label for="tipo_documento">Tipo de Documento</label>
                                            <select type="int" class="formulario__input" name="tipo_documento" id="mensajeDocumento1" class="form-control" autocomplete="off" class="combobox">
                                                <option value="0" selected>SELECCIONE TIPO DE DOCUMENTO</option>
                                                <?php
                                                // Recorrer los resultados y mostrarlos en la tabla
                                                foreach ($resultado as $fila) {
                                                ?>
                                                    <option value="<?php echo $fila['Id_Tipo_Documento']; ?>"><?php echo $fila['Descripcion']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <p id="mensajeDocumento2" class="mensaje_error" style="color: #bb2929;" ></p>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- GRUPO NÚMERO DE DOCUMENTO -->
                                        <div class="formulario__grupo" id="grupo__numero_de_documento">
                                            <label for="numero_de_documento">Número de Documento</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" maxlength="15" class="formulario__input" name="numero_de_documento" id="numero_de_documento" placeholder=" INGRESE SU NÚMERO DE DOCUMENTO" autocomplete="off" required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                        <script>
                                            // Enlazar el evento input al campo #numero_de_documento
                                            $('#numero_de_documento').on('focusout', verificarDNI);

                                            function verificarDNI() {
                                                // Obtén el valor del campo de entrada
                                                var numero_de_documento = $('#numero_de_documento').val();

                                                // Si el campo está vacío, oculta el mensaje de error y sale de la función
                                                if (numero_de_documento === '') {
                                                    $('#grupo_numero_de_documento .formularioinput-error').removeClass('formulario_input-error-activo');
                                                    $('#grupo_numero_de_documento').removeClass('formulariogrupo-incorrecto').addClass('formulario_grupo-correcto');
                                                    return;
                                                }

                                                // Realiza la solicitud AJAX para verificar si el número de documento ya existe en la base de datos
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '../../../Consultas/ValidarDNI_Pacient.php', // Ruta al script PHP
                                                    data: {
                                                        numero_de_documento: numero_de_documento
                                                    },
                                                    dataType: 'json',
                                                    success: function(response) {
                                                        if (response.existe) {
                                                            // Si el número de documento ya existe, muestra un mensaje de error
                                                            $('#grupo_numero_de_documento').addClass('formulariogrupo-incorrecto').removeClass('formulario_grupo-correcto');
                                                            $('#grupo_numero_de_documento .formulario_input-error').text('El número de identificación ya existe');
                                                            $('#grupo_numero_de_documento .formularioinput-error').addClass('formulario_input-error-activo');

                                                            // Deshabilitar el botón de envío del formulario (si lo deseas)
                                                            $('#boton_enviar').prop('disabled', true);
                                                        } else {
                                                            // Si el número de documento no existe, oculta el mensaje de error
                                                            $('#grupo_numero_de_documento').removeClass('formulariogrupo-incorrecto').addClass('formulario_grupo-correcto');
                                                            $('#grupo_numero_de_documento .formularioinput-error').removeClass('formulario_input-error-activo');

                                                            // Habilitar el botón de envío del formulario (si lo deseas)
                                                            $('#boton_enviar').prop('disabled', false);
                                                        }
                                                    },
                                                    error: function() {
                                                        // Maneja errores de la solicitud AJAX
                                                        alertify.error('Error al buscar el número de documento.');
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <!-- GRUPO OCUPACIÓN -->
                                        <div class="formulario__grupo" id="grupo__ocupacion">
                                            <label for="ocupacion">Ocupación</label>
                                            <div class="formulario__grupo-input">
                                                <input type="text" style="text-transform: uppercase" maxlength="50" class="formulario__input" name="ocupacion" id="ocupacion" placeholder="INGRESE SU OCUPACIÓN" autocomplete="off" title="Ingrese solo letras (hasta 50 caracteres)." required>
                                            </div>
                                            <p class="formulario__input-error"></p>
                                        </div>
                                    </td>
                                    <td>
                                        <!-- GRUPO ESTADO USUARIO -->
                                        <!-- <div class="gender-options">
                                            <label for="estadoPaciente">Estado</label>
                                            <select type="int" class="formulario__input" class="form-control" name="estadoPaciente" id="estadoPaciente" autocomplete="off" class="combobox">
                                                <option value="">Seleccione un estado</option>
                                                <option value="1">ACTIVO</option>
                                                <option value="0">INACTIVO</option>
                                            </select>
                                        </div> -->
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                    <div class="formulario__grupo formulario__grupo-btn-enviar">
                                        <button type="submit" id="Btnregistrar" class="btn btn-primary">Guardar</button>
                                    </div>
                                    </td>
                                    <td>
                                        <button id="Btncancelar" class="btn btn-danger" onclick="confirmarCancelar()">Cancelar</button>
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
    var Btncancelar = document.getElementById('Btncancelar');
    Btncancelar.addEventListener('click', confirmarCancelar);

    function confirmarCancelar() {
        Swal.fire({
            title: "¿Quieres Cancelar esta Acción?",
            // text: "Estas seguro que quieres Cancelar?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Si, Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Cancelado",
                    text: "No se guardaron registros",
                    icon: "success",
                    showConfirmButton: false
                });
                setTimeout(function() {
                    window.location.href = "./V_Paciente.php";
                }, 1300);
            }
        });
    }
</script> 

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <br><br><br>
<?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>

      <!-- Vendor JS Files -->
      <script src="../../../../assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../../../../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../../../assets/vendor/chart.js/chart.umd.js"></script>
    <script src="../../../../assets/vendor/echarts/echarts.min.js"></script>
    <script src="../../../../assets/vendor/quill/quill.min.js"></script>
    <script src="../../../../assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../../../../assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="../../../../assets/vendor/php-email-form/validate.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>

    <!-- Template Main JS File -->
    <script src="../../../../assets/js/main.js"></script>

    <!-- Bootstrap JS Bundle (Bootstrap JS + Popper.js) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->

    <!-- Datatables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="../../../javascript/validacionPaciente.js"></script>

</body>

</html>