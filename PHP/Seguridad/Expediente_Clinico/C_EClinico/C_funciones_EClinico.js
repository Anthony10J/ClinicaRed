function validarCamposVacios(evaluacionR) {
    if (evaluacionR.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return false;
    }
    return true;
}
function verificarEvaluacion() {
    // Obtén el valor del campo de entrada
    var evaluacionR = $('#evaluacionR').val();

    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (evaluacionR !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_EClinico/C_buscar_descripcion_evaluacion.php', // Ruta al script PHP
                data: {
                    evaluacionR: evaluacionR // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function (response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('La evaluacion ya existe.').addClass('error').show();
                        // alertify.error("El parámetro ya existe.");
                        return false;
                    } else {
                        // Si el parámetro no existe, oculta el mensaje de error
                        $('#mensaje_error').text('').removeClass('error').hide();
                    }
                },
                error: function () {
                    alertify.error('Error al buscar la evaluacion.');
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
    $('#evaluacionR').on('focusout', verificarEvaluacion);
});

function insertarTipoEvaluacionR(evaluacionR) {
    if (!validarCamposVacios(evaluacionR)) {
        return;
    }

    // Verifica si el parámetro ya existe utilizando la función verificarParametro()
    // Asumiendo que verificarParametro() retorna true si el parámetro existe y false si no existe.
    verificarEvaluacion();

    // Si se muestra un mensaje de error, detén la ejecución de insertarParametro
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }
    cadena = "evaluacionR=" + evaluacionR;
    $.ajax({
        type: 'POST',
        url: '../C_EClinico/C_guardar_EClinico.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEvaluacionR').load('../V_EClinico/V_mantenimiento_EClinico.php');
                alertify.success("Evaluación registrada correctamente.");
                // $('#modalEditarEvaluacionR').modal('hide'); // Cerrar el modal
               
            } else {
                alertify.error("Fallo al guardar la evaluación.");
                
            }
        }
    });
}

// function cargarDatosLectura(datos) {
//     extraerDatos = datos.split('||');

//     $('#Id_Parametro_L').val(extraerDatos[0]);
//     $('#parametro_L').val(extraerDatos[1]);
//     $('#valorParametro_L').val(extraerDatos[2]);
//     $('#creadoPor_L').val(extraerDatos[3]);
//     $('#fechaCreacion_L').val(extraerDatos[4]);
//     $('#modificadoPor_L').val(extraerDatos[5]);
//     $('#fechaModificacion_L').val(extraerDatos[6]);  
// }

function cargarDatos(datos) {
    extraerDatos = datos.split('||');

    // $('#I').val(extraerDatos[0]);
    $('#Id_Resultado_Evaluacion').val(extraerDatos[0]);
    $('#evaluacionR_E').val(extraerDatos[2]);
}

function actualizarTipoEvaluacionR() {
    Id_Resultado_Evaluacion = $('#Id_Resultado_Evaluacion').val();
    evaluacionR_E = $('#evaluacionR_E').val();

    cadena = "Id_Resultado_Evaluacion=" + Id_Resultado_Evaluacion + 
             "&evaluacionR_E=" + evaluacionR_E;

             if(evaluacionR_E.trim() === ''){
                alertify.error('El campo no puede guardarse vacío.');
                return false;
            }
    $.ajax({
        type: 'POST',
        url: '../C_EClinico/C_editar_EClinico.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaEvaluacionR').load('../V_EClinico/V_mantenimiento_EClinico.php');
                alertify.success("Evaluación actualizada correctamente.");
                $('#modalEditarEvaluacionR').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar la evaluación.");
            }
        }
    });
}


function validarSiNo(Id_Resultado_Evaluacion){
    alertify.confirm('Eliminar Evaluación', '¿Está seguro de eliminar la evaluación?', 
                  function(){ eliminarEvaluacion(Id_Resultado_Evaluacion),
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);} 
                , function(){ alertify.error('Evaluación no eliminada.')});
}

function eliminarEvaluacion(Id_Resultado_Evaluacion){
    cadena = "Id_Resultado_Evaluacion=" + Id_Resultado_Evaluacion;

    $.ajax({
        type: 'POST',
        url: '../C_EClinico/C_eliminar_EClinico.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEvaluacionR').load('../V_EClinico/V_mantenimiento_EClinico.php');
                alertify.success("Evaluación eliminada.");
                $('#modalEditarEvaluacion').modal('hide'); // Cerrar el modal
            } else {
                alertify.error("Fallo al eliminar la evaluación.");
            }
        }
    });
}
