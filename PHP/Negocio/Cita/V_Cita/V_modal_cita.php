<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
include '../../../Seguridad/Roles_permisos/permisos/Obtener_Id_Objeto.php';
$id_rol = $_SESSION['IdRol'];
$id_objeto = Obtener_Id_Objeto('V_modal_cita');
$Permisos_Objeto = Obtener_Permisos_Rol_Objeto($id_rol, $id_objeto);

if ($Permisos_Objeto["Permiso_Consultar"] !== "1") {
    header("Location: /PHP/Seguridad/Roles_permisos/permisos/V_error_permiso.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>CLÍNICA RED</title>
    <link rel="shortcut icon" href="/EstilosLogin/images/pestana.png" type="image/x-icon">

    <!-- Favicons -->
    <link href="../../../../assets/img/red-logo.jpeg" rel="icon">
    <link href="../../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

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



    <!-- Favicons -->
    <link href="../../../../assets/img/red-logo.jpeg" rel="icon">
    <link href="../../../../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="../../../../librerias/librerias.css">
    <!-- archivo de encapsulamiento de librerias CSS -->
    <link rel="stylesheet" href="V_gestion_cita.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"> </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- <script type="module" src="../../../../librerias/librerias.js"></script> -->

    <!-- ----------------CODIGO PARA GENERAR REPORTES------------------>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script> <!-- ESTILOS DE LA TABLA -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
    <!-- MOSTRAR BOTONES DE REPORTE -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> LIBRERIA DE EXCEL  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> <!-- IMPRIME PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> <!-- LIBRERIA PDF -->
    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script> <!-- LIBRERIA HTML -->
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"> </script> <!-- ICONOS -->

    <!-- librerias javascript -->
    <script src="../C_Cita/C_funciones_citas.js"></script> <!-- Funciones para el CRUD -->
    <!-- <script type="module" src="../C_Parametros/C_validacion_parametros.js"></script> Funciones de validación -->
    <script src="../../../../librerias/bootstrap/js/bootstrap.js"></script> <!-- libreria Bootstrap -->
    <script src="../../../../librerias/alertifyjs/js/alertify.js"></script> <!-- libreria Alertify -->


</head>

<body>

    <?php
    include '../../../../Recursos/Componentes/header.php';
    include '../../../../Recursos/Componentes/SideBar.html';
    ?>
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Gestión de Citas</h1>
         
        </div><!-- End Page Title -->

        <div class="container mt-4">
            <div id="tablaCitas"></div>
        </div>

        <!-- MODAL AGENDAR CITA -->

        <div class="modal fade" id="modalAgendarCita" tabindex="-1" aria-labelledby="modalAgendarCitaLabel"
            aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header">
                       
                            <h1 class="modal-title fs-5" id="modalAgendarCitaLabel">Agendar Cita</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
             
                    </div>

                    <div class="modal-body">

                        <label for="DNI">DNI:</label>
                        <input type="text" name="DNI" id="DNI" placeholder="DNI Paciente" class="form-control input-sm">

                        <label for="Id_Paciente" hidden>Id Paciente:</label>
                        <input type="text" id="Id_Paciente" hidden name="Id_Paciente" placeholder="Id del paciente"
                            class="form-control input-sm" readonly>

                        <label for="Id_Expediente" hidden>Id Expediente:</label>
                        <input type="text" id="Id_Expediente" name="Id_Expediente" hidden
                            placeholder="Id del Expediente" class="form-control input-sm" readonly>

                        <label for="nombrePaciente">Nombre Paciente:</label>
                        <input type="text" id="nombrePaciente" placeholder="Nombre del paciente" name="nombrePaciente"
                            class="form-control input-sm mayuscula" readonly>

                        <script>
                            $(document).ready(function () {
                                $('#DNI').on('input', function () {
                                    var dni = $(this).val();
                                    if (dni !== '') {
                                        // Realizar consulta AJAX para buscar el nombre asociado al DNI
                                        $.ajax({
                                            type: 'POST',
                                            url: '../C_Cita/C_buscar_expediente.php', // Ruta al script PHP para buscar el nombre
                                            data: {
                                                dni: dni
                                            },
                                            success: function (response) {
                                                var datos = response.split("||");
                                                // Asignar el nombre y el ID del paciente a los campos correspondientes
                                                $('#nombrePaciente').val(datos[0]); // Asignar el nombre al campo nombrePaciente
                                                $('#Id_Paciente').val(datos[1]); // Asignar el ID del paciente al campo Id_Paciente
                                                $('#Id_Expediente').val(datos[2]); // Asignar el ID del paciente al campo Id_Paciente

                                            },
                                            error: function () {
                                                alert('Error al buscar el paciente.');
                                            }
                                        });
                                    } else {
                                        // Limpiar el campo de nombre si el campo de DNI está vacío
                                        $('#nombrePaciente').val('');
                                        $('#Id_Paciente').val('');
                                        $('#Id_Expediente').val('');
                                    }
                                });
                            });
                        </script>
                        <!-- <label for="tipoCita">Tipo Cita:</label>
        <input type="text" id="tipoCita" class="form-control input-sm"> -->

                        <div class="doctor-options">
                            <label for="tipoCita" class="formulario__label">Tipo Cita:</label>
                            <select type="int" autocomplete="off" name="tipoCita" id="tipoCita"
                                class="combobox form-control input-sm">
                                <option value="0" selected>Seleccione:</option>

                                <?php
                                // Conexión a la base de datos
                                include ('../../../Controladores/Conexion/Conexion_be.php');

                                // Consulta SQL para obtener los géneros
                                $query = "SELECT Id_Tipo_Cita, Descripcion FROM tbl_tipo_cita";
                                $resultado = mysqli_query($conexion, $query);

                                // Iterar sobre los resultados y generar las opciones del select
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo '<option value="' . $fila['Id_Tipo_Cita'] . '">' . $fila['Descripcion'] . '</option>';
                                }
                                // Liberar resultado
                                mysqli_free_result($resultado);
                                // Cerrar conexión
                                mysqli_close($conexion);
                                ?>
                            </select>
                            <!-- <p id="mensajeGenero2" class="mensaje_error" style="color: #bb2929;" ></p> -->
                        </div>

                        <label for="motivoCita">Motivo:</label>
                        <input type="text" id="motivoCita" placeholder="Motivo de la cita"
                            class="form-control input-sm mayuscula">

                        <!-- <label for="nombreDoctor">Doctor:</label>
                    <input type="text" id="nombreDoctor" class="form-control input-sm"> -->

                        <div class="doctor-options">
                            <label for="especialidad">Especialidad:</label>
                            <select id="especialidad" name="especialidad" class="combobox form-control input-sm">
                                <option value="">Seleccione una especialidad</option>
                                <option value="fisiatra">FISIATRA</option>
                                <option value="fisioterapeuta">FISIOTERAPEUTA</option>
                            </select>

                            <label for="especialista">Especialista:</label>

                            <div id="subespecialidades" class="doctor-options"></div>


                            <script>
                                const especialidadSelect = document.getElementById("especialidad");
                                const subespecialidadesDiv = document.getElementById("subespecialidades");

                                // Función para crear el segundo combo box
                                function crearSegundoComboBox(especialidad) {
                                    // Limpiar el contenido del div
                                    subespecialidadesDiv.innerHTML = "";

                                    // Crear un nuevo elemento select
                                    const subespecialidadSelect = document.createElement("select");
                                    subespecialidadSelect.setAttribute("name", "subespecialidad");
                                    subespecialidadSelect.setAttribute("id", "subespecialidad");
                                    subespecialidadSelect.setAttribute("class", "combobox form-control input-sm");
                                    const option2 = document.createElement("option");
                                    option2.setAttribute("value", "");
                                    option2.textContent = "Seleccione especialista";
                                    option2.setAttribute("class", "combobox form-control input-sm");
                                    subespecialidadSelect.appendChild(option2);

                                    // Opciones para Fisiatra
                                    if (especialidad === "fisiatra") {
                                        <?php
                                        // Conexión a la base de datos
                                        include ('../../../Controladores/Conexion/Conexion_be.php');

                                        // Consulta SQL para obtener los géneros
                                        $query = "SELECT Id_Usuario, Nombre FROM tbl_ms_usuario WHERE IdRol IN ( 6)";
                                        $resultado = mysqli_query($conexion, $query);

                                        ?>

                                        const subespecialidadesFisiatra = [
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                                echo '["' . $fila['Id_Usuario'] . '","' . $fila['Nombre'] . '"],';
                                            }
                                            ?>
                                        ];
                                        subespecialidadesFisiatra.forEach((subespecialidad) => {
                                            const [id, nombre] = subespecialidad;
                                            const option = document.createElement("option");
                                            option.setAttribute("value", id);
                                            option.textContent = nombre;
                                            option.setAttribute("class", "combobox form-control input-sm");
                                            subespecialidadSelect.appendChild(option);
                                        });
                                    }
                                    <?php
                                    // Liberar resultado
                                    mysqli_free_result($resultado);
                                    // Cerrar conexión
                                    //mysqli_close($conexion);
                                    ?>
                                    // Opciones para Fisioterapeuta
                                    if (especialidad === "fisioterapeuta") {
                                        <?php
                                        // Consulta SQL para obtener los roles
                                        $query2 = "SELECT Id_Usuario, Nombre FROM tbl_ms_usuario WHERE IdRol IN (7)";
                                        $resultado2 = mysqli_query($conexion, $query2);

                                        ?>
                                        const subespecialidadesFisioterapeuta = [
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($resultado2)) {
                                                echo '["' . $fila['Id_Usuario'] . '","' . $fila['Nombre'] . '"],';
                                            }
                                            ?>
                                        ]; // Función para obtener las subespecialidades de la base de datos
                                        subespecialidadesFisioterapeuta.forEach((subespecialidad) => {
                                            const [id, nombre] = subespecialidad;
                                            const option = document.createElement("option");
                                            option.setAttribute("value", id);
                                            option.textContent = nombre;
                                            option.setAttribute("class", "combobox form-control input-sm");
                                            subespecialidadSelect.appendChild(option);
                                        });
                                    }
                                    <?php
                                    // Liberar resultado
                                    mysqli_free_result($resultado2);
                                    // Cerrar conexión
                                    mysqli_close($conexion);
                                    ?>

                                    // Agregar el nuevo combo box al div
                                    subespecialidadesDiv.appendChild(subespecialidadSelect);
                                }

                                // Agregar un evento "change" al primer combo box
                                especialidadSelect.addEventListener("change", (event) => {
                                    const especialidadSeleccionada = event.target.value;
                                    crearSegundoComboBox(especialidadSeleccionada);
                                });

                                // Cargar el segundo combo box al cargar la página
                                window.onload = () => { crearSegundoComboBox(""); };
                            </script>

                        </div>

                        <label for="fechaCita">Fecha Cita:</label>
                        <input type="date" id="fechaCita" class="form-control input-sm">

                        <label for="horaCita">Hora Cita:</label>
                        <input type="time" id="horaCita" class="form-control input-sm">
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
                        <button type="submit" id="guardarCita" class="btn btn-primary btn-block">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA VER CITA -->
        <div class="modal fade" id="modalVerCita" tabindex="-1" aria-labelledby="modalVerCitaLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalVerCitaLabel">Ver Cita</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">

                        <label for="idCita_L" hidden>Id Cita:</label>
                        <input type="text" id="idCita_L" hidden readonly class="form-control input-sm">

                        <!-- <label for="DNI_L">DNI:</label>
                <input type="text" id="DNI_L" readonly class="form-control input-sm"> -->

                        <label for="nombrePaciente_L">Nombre Paciente:</label>
                        <input type="text" id="nombrePaciente_L" readonly class="form-control input-sm">

                        <label for="tipoCita_L">Tipo Cita:</label>
                        <input type="text" id="tipoCita_L" readonly class="form-control input-sm">

                        <label for="motivoCita_L">Motivo:</label>
                        <input type="text" id="motivoCita_L" readonly class="form-control input-sm">

                        <label for="nombreDoctor_L">Especialista:</label>
                        <input type="text" id="nombreDoctor_L" readonly class="form-control input-sm">

                        <label for="fechaCita_L">Fecha Cita:</label>
                        <input type="date" id="fechaCita_L" readonly class="form-control input-sm">

                        <label for="horaCita_L">Hora Cita:</label>
                        <input type="text" id="horaCita_L" readonly class="form-control input-sm">

                        <!-- Estado Cita -->
                        <label for="Id_Estado_Cita" hidden >Estado Cita:</label>
                        <input type="hidden" id="Id_Estado_Cita" readonly class="form-control input-sm">
                        
                        <!-- Id Especialista -->
                        <label for="Id_Especialista" hidden >Id Especialista:</label>
                        <input type="hidden" id="Id_Especialista" readonly class="form-control input-sm">

                        <!-- Id Usuario -->
                        <label for="Id_Usuario" hidden >Id Usuario:</label>
                        <input type="hidden" id="Id_Usuario_L" readonly class="form-control input-sm">

                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="VerParametro" class="btn btn-primary">Actualizar</button> -->
                    </div>
                </div>
            </div>
        </div>

        <!-- MODAL PARA EDITAR CITA -->
        <div class="modal fade" id="modalEditarCita" tabindex="-1" aria-labelledby="modalEditarCitaLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditarCitaLabel">Editar Cita</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>

                    <div class="modal-body">

                        <!-- <label for="idCita_E" hidden>Id Cita:</label> -->
                        <input type="text" id="idCita_E" name="idCita_E" hidden class="form-control input-sm">

                        <label for="nombrePaciente_E">Nombre Paciente:</label>
                        <input type="text" id="nombrePaciente_E" name="nombrePaciente_E" readonly
                            class="form-control input-sm">

                        <!-- <label for="tipoCita_E">Tipo Cita:</label>
                <input type="text" id="tipoCita_E" name="tipoCita_E" class="form-control input-sm"> -->

                        <div class="doctor-options">
                            <label for="tipoCita_E" class="formulario__label">Tipo Cita:</label>
                            <select type="int" autocomplete="off" name="tipoCita_E" id="tipoCita_E"
                                class="combobox form-control input-sm">

                                <?php
                                // Conexión a la base de datos
                                include ('../../../Controladores/Conexion/Conexion_be.php');

                                // Consulta SQL para obtener los géneros
                                $query = "SELECT Id_Tipo_Cita, Descripcion FROM tbl_tipo_cita";
                                $resultado = mysqli_query($conexion, $query);

                                // Iterar sobre los resultados y generar las opciones del select
                                while ($fila = mysqli_fetch_assoc($resultado)) {
                                    echo '<option value="' . $fila['Id_Tipo_Cita'] . '">' . $fila['Descripcion'] . '</option>';
                                }
                                // Liberar resultado
                                mysqli_free_result($resultado);
                                // Cerrar conexión
                                mysqli_close($conexion);
                                ?>
                            </select>
                            <!-- <p id="mensajeGenero2" class="mensaje_error" style="color: #bb2929;" ></p> -->
                        </div>

                        <label for="motivoCita_E">Motivo:</label>
                        <input type="text" id="motivoCita_E" name="motivoCita_E"
                            class="form-control input-sm mayuscula">

                        <!-- <label for="nombreDoctor_E">Doctor:</label>
                <input type="text" id="nombreDoctor_E" name="nombreDoctor_E" class="form-control input-sm"> -->

                        <div class="doctor-options">
                            <label for="especialidad_E">Especialidad:</label>
                            <select id="especialidad_E" name="especialidad_E" class="combobox form-control input-sm">
                                <option value="">Seleccione una especialidad</option>
                                <option value="fisiatra">FISIATRA</option>
                                <option value="fisioterapeuta">FISIOTERAPEUTA</option>
                            </select>

                            <label for="especialista_E">Especialista:</label>

                            <div id="subespecialidades_E" class="doctor-options"> </div>


                            <script>
                                const especialidadSelect2 = document.getElementById("especialidad_E");
                                const subespecialidadesDiv2 = document.getElementById("subespecialidades_E");

                                // Función para crear el segundo combo box
                                function crearSegundoComboBox2(especialidad) {
                                    // Limpiar el contenido del div
                                    subespecialidadesDiv2.innerHTML = "";

                                    // Crear un nuevo elemento select
                                    const subespecialidadSelect2 = document.createElement("select");
                                    subespecialidadSelect2.setAttribute("name", "subespecialidad_E");
                                    subespecialidadSelect2.setAttribute("id", "subespecialidad_E");
                                    subespecialidadSelect2.setAttribute("class", "combobox form-control input-sm");
                                    const option2 = document.createElement("option");
                                    option2.setAttribute("value", "");
                                    option2.textContent = "Seleccione especialista";
                                    option2.setAttribute("class", "combobox form-control input-sm");
                                    subespecialidadSelect2.appendChild(option2);

                                    // Opciones para Fisiatra
                                    if (especialidad === "fisiatra") {
                                        <?php
                                        // Conexión a la base de datos
                                        include ('../../../Controladores/Conexion/Conexion_be.php');

                                        // Consulta SQL para obtener los géneros
                                        $query = "SELECT Id_Usuario, Nombre FROM tbl_ms_usuario WHERE IdRol IN ( 6)";
                                        $resultado = mysqli_query($conexion, $query);

                                        ?>

                                        const subespecialidadesFisiatra2 = [
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($resultado)) {
                                                echo '["' . $fila['Id_Usuario'] . '","' . $fila['Nombre'] . '"],';
                                            }
                                            ?>
                                        ];
                                        subespecialidadesFisiatra2.forEach((subespecialidad) => {
                                            const [id, nombre] = subespecialidad;
                                            const option = document.createElement("option");
                                            option.setAttribute("value", id);
                                            option.textContent = nombre;
                                            option.setAttribute("class", "combobox form-control input-sm");
                                            subespecialidadSelect2.appendChild(option);
                                        });
                                    }
                                    <?php
                                    // Liberar resultado
                                    mysqli_free_result($resultado);
                                    // Cerrar conexión
                                    //mysqli_close($conexion);
                                    ?>
                                    // Opciones para Fisioterapeuta
                                    if (especialidad === "fisioterapeuta") {
                                        <?php
                                        // Consulta SQL para obtener los géneros
                                        $query2 = "SELECT Id_Usuario, Nombre FROM tbl_ms_usuario WHERE IdRol IN (7)";
                                        $resultado2 = mysqli_query($conexion, $query2);

                                        ?>
                                        const subespecialidadesFisioterapeuta2 = [
                                            <?php
                                            while ($fila = mysqli_fetch_assoc($resultado2)) {
                                                echo '["' . $fila['Id_Usuario'] . '","' . $fila['Nombre'] . '"],';
                                            }
                                            ?>
                                        ]; // Función para obtener las subespecialidades de la base de datos
                                        subespecialidadesFisioterapeuta2.forEach((subespecialidad) => {
                                            const [id, nombre] = subespecialidad;
                                            const option = document.createElement("option");
                                            option.setAttribute("value", id);
                                            option.textContent = nombre;
                                            option.setAttribute("class", "combobox form-control input-sm");
                                            subespecialidadSelect2.appendChild(option);
                                        });
                                    }
                                    <?php
                                    // Liberar resultado
                                    mysqli_free_result($resultado2);
                                    // Cerrar conexión
                                    mysqli_close($conexion);
                                    ?>

                                    // Agregar el nuevo combo box al div
                                    subespecialidadesDiv2.appendChild(subespecialidadSelect2);
                                }

                                // Agregar un evento "change" al primer combo box
                                especialidadSelect2.addEventListener("change", (event) => {
                                    const especialidadSeleccionada = event.target.value;
                                    crearSegundoComboBox2(especialidadSeleccionada);
                                });

                                // Cargar el segundo combo box al cargar la página
                                window.onload = () => { crearSegundoComboBox2(""); };
                            </script>

                        </div>

                        <label for="fechaCita_E">Fecha Cita:</label>
                        <input type="date" id="fechaCita_E" name="fechaCita_E" class="form-control input-sm">

                        <label for="horaCita_E">Hora Cita:</label>
                        <input type="time" id="horaCita_E" name="horaCita_E" class="form-control input-sm">

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button> -->
                        <button type="button" id="actualizarCita" class="btn btn-primary btn-block">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <!-- dentro del main va la tabla o informacion -->

    <?php
    include '../../../../Recursos/Componentes/footer.html';
    ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
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
</body>

</html>

<script>
    $(document).ready(function () {
        $('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
    });
</script>

<script>
    $(document).ready(function () {
        $('#guardarCita').click(function () {
            //('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
            motivoCita = $('#motivoCita').val();
            fechaCita = $('#fechaCita').val()
            horaCita = $('#horaCita').val()
            Id_Paciente = $('#Id_Paciente').val()
            tipoCita = $('#tipoCita').val()
            subespecialidad = $('#subespecialidad').val();
            Id_Expediente = $('#Id_Expediente').val()
            insertarCita(motivoCita, fechaCita, horaCita, Id_Paciente, tipoCita, subespecialidad, Id_Expediente);
            setTimeout(function () {
                window.location.reload();
            }, 270);
        });

        $('#actualizarCita').click(function () {
            actualizarCita();
            setTimeout(function () {
                window.location.reload();
            }, 270);
        });
    });
</script>