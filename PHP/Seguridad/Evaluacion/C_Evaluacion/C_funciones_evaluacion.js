function verificarExamen() {
    // Obtén el valor del campo de entrada
    var descripcion = $('#descripcion').val();

    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (descripcion !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_Evaluacion/C_buscar_examen.php', // Ruta al script PHP
                data: {
                    descripcion: descripcion // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function (response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('La evaluación ya existe.').addClass('error').show();
                        // alertify.error("El parámetro ya existe.");
                        return false;
                    } else {
                        // Si el parámetro no existe, oculta el mensaje de error
                        $('#mensaje_error').text('').removeClass('error').hide();
                    }
                },
                error: function () {
                    alertify.error('Error al buscar la evaluación.');
                    // Puedes mostrar un mensaje de error en la interfaz de usuario si es necesario
                }
            });
        } else {
            // Si el campo está vacío, oculta el mensaje de error
            $('#mensaje_error').text('').removeClass('error').hide();
        }
    }, ); // Retraso de 300 ms antes de la solicitud
}

$(document).ready(function () {
    // Agregar el evento focusout a la función verificarParametro
    $('#descripcion').on('focusout', verificarExamen);
});

function verificarExamenEdit() {
    // Obtén el valor del campo de entrada
    var descripcionE = $('#descripcionE').val();

    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (descripcionE !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_Evaluacion/C_buscar_examen.php', // Ruta al script PHP
                data: {
                    descripcionE: descripcionE // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function (response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('La evaluación ya existe.').addClass('error').show();
                        // alertify.error("El parámetro ya existe.");
                        return false;
                    } else {
                        // Si el parámetro no existe, oculta el mensaje de error
                        $('#mensaje_error').text('').removeClass('error').hide();
                    }
                },
                error: function () {
                    alertify.error('Error al buscar la evaluación.');
                    // Puedes mostrar un mensaje de error en la interfaz de usuario si es necesario
                }
            });
        } else {
            // Si el campo está vacío, oculta el mensaje de error
            $('#mensaje_error').text('').removeClass('error').hide();
        }
    }, 300); // Retraso de 300 ms antes de la solicitud
}

$(document).ready(function () {
    // Agregar el evento focusout a la función verificarParametro
    $('#descripcionE').on('focusout', verificarExamenEdit);
});

function insertarEvaluacion(descripcion) {
    cadena = "descripcion=" + descripcion;
    if (descripcion.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return false;
    }

    // Verifica si el parámetro ya existe utilizando la función verificarParametro()
    // Asumiendo que verificarParametro() retorna true si el parámetro existe y false si no existe.
    verificarExamen();

    // Si se muestra un mensaje de error, detén la ejecución de insertarParametro
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }

    $.ajax({
        type: 'POST',
        url: '../C_Evaluacion/C_guardar_evaluacion.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEvaluacion').load('../V_Evaluacion/V_mantenimiento_evaluacion.php');
                alertify.success("Evaluacion registrada correctamente.");
                setTimeout(function () {
                    window.location.reload();
                }, 400);

            } else {
                alertify.error("Fallo al guardar la evaluacion.");
            }
        }
    });
}

function cargarDatos(datos) {
    extraerDatos = datos.split('||');
    $('#Id_Evaluacion_E').val(extraerDatos[0]);
    $('#descripcionE').val(extraerDatos[1]);
}

function actualizarEvaluacion() {
    Id_Evaluacion_E = $('#Id_Evaluacion_E').val();
    descripcionE = $('#descripcionE').val();

    cadena = "Id_Evaluacion_E=" + Id_Evaluacion_E +
        "&descripcionE=" + descripcionE;

    if (descripcionE.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return false;
    }

    verificarExamenEdit();

    // Si se muestra un mensaje de error, detén la ejecución de insertarParametro
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }
    $.ajax({
        type: 'POST',
        url: '../C_Evaluacion/C_editar_evaluacion.php',
        data: cadena,
        success: function (respuesta) {

            if (respuesta == 1) {
                $('#tablaEvaluacion').load('../V_Evaluacion/V_mantenimiento_evaluacion.php');
                alertify.success("Evaluacion actualizada correctamente.");
                setTimeout(function () {
                    window.location.reload();
                }, 500);

            } else {
                alertify.error("Fallo al actualizar la evaluacion.");
            }
        }


    });
}

function validarSiNo(Id_Evaluacion_E) {
    alertify.confirm('Eliminar Evaluación', '¿Está seguro de eliminar la evaluación?',
        function () {
            eliminarEvaluacion(Id_Evaluacion_E)
        }
        , function () { alertify.error('Evaluación no eliminada.') });
}



function eliminarEvaluacion(Id_Evaluacion_E) {
    cadena = "Id_Evaluacion_E=" + Id_Evaluacion_E;

    $.ajax({
        type: 'POST',
        url: '../C_Evaluacion/C_eliminar_evaluacion.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEvaluacion').load('../V_Evaluacion/V_mantenimiento_evaluacion.php');
                alertify.success("Evaluación eliminada.");
                setTimeout(function () {
                    window.location.reload();
                }, 800);
                $('#modalEditarEvaluacion').modal('hide'); // Cerrar el modal

            } else {
                alertify.error("Fallo al eliminar la evaluación.");
            }
        }
    });
}