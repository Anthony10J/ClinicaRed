function validarCamposVacios(tratamiento) {
    if (tratamiento.trim() === '' ) {
        alertify.error("Los campos no pueden estar vacíos.");
        return false;
    }
    return true;
}
function verificarTratamiento() {
    // Obtén el valor del campo de entrada
    var tratamiento = $('#tratamiento').val();
    
    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (tratamiento !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_Tratamientos/C_buscar_tratamiento.php', // Ruta al script PHP
                data: {
                    tratamiento: tratamiento // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function(response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('El tratamiento ya existe.').addClass('error').show();
                        // alertify.error("El parámetro ya existe.");
                        return false;
                    } else {
                        // Si el tratamiento no existe, oculta el mensaje de error
                        $('#mensaje_error').text('').removeClass('error').hide();
                    }
                },
                error: function() {
                    alertify.error('Error al buscar el tratamiento.');
                    // Puedes mostrar un mensaje de error en la interfaz de usuario si es necesario
                }
            });
        } else {
            // Si el campo está vacío, oculta el mensaje de error
            $('#mensaje_error').text('').removeClass('error').hide();
        }
    }, ); // Retraso de 300 ms antes de la solicitud
}

$(document).ready(function() {
    // Agregar el evento focusout a la función verificarParametro
    $('#tratamiento').on('focusout', verificarTratamiento);
});

function insertarTipoTratamiento(tratamiento) {
    if (!validarCamposVacios(tratamiento)) {
        return;
    }

    // Verifica si el parámetro ya existe utilizando la función verificarParametro()
    // Asumiendo que verificarParametro() retorna true si el parámetro existe y false si no existe.
    verificarTratamiento();

    // Si se muestra un mensaje de error, detén la ejecución de insertarParametro
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }

    cadena = "tratamiento=" + tratamiento;
    $.ajax({
        type: 'POST',
        url: '../C_Tratamientos/C_guardar_terapia.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoTratamiento').load('../V_ETerapeutico/V_mantenimiento_tratamiento.php');
                alertify.success("Tratamiento registrado correctamente.");
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al guardar el tratamiento.");
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
    $('#CbxTratamiento_E').val(extraerDatos[1]);
    $('#tratamiento_E').val(extraerDatos[2]);
    $('#idTipoTerapia').val(extraerDatos[3]);
}

function actualizarTipoTratamiento() {
    idTipoTerapia = $('#idTipoTerapia').val();
    tratamiento_E = $('#tratamiento_E').val();

    cadena = "idTipoTerapia=" + idTipoTerapia + 
             "&tratamiento_E=" + tratamiento_E;

             if(tratamiento_E.trim() === ''){
                alertify.error('El campo no puede guardarse vacío.');
                return false;
            }
    $.ajax({
        type: 'POST',
        url: '../C_Tratamientos/C_editar_terapia.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaTipoTratamiento').load('../V_ETerapeutico/V_mantenimiento_tratamiento.php');
                alertify.success("Tratamiento actualizado correctamente.");
                $('#modalEditarTratamiento').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar el tratamiento.");
            }
        }
    });
}


function validarSiNo(idTipoTerapia){
    alertify.confirm('Eliminar Tratamiento', '¿Está seguro de eliminar el tratamiento?', 
                  function(){ eliminarTratamiento(idTipoTerapia),
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);}
                , function(){ alertify.error('Tratamiento no eliminado.')});
}

function eliminarTratamiento(idTipoTerapia){
    cadena = "idTipoTerapia=" + idTipoTerapia;

    $.ajax({
        type: 'POST',
        url: '../C_Tratamientos/C_eliminar_terapia.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoTratamiento').load('../V_ETerapeutico/V_mantenimiento_tratamiento.php');
                alertify.success("Tratamiento eliminado.");
                $('#modalEditarTratamiento').modal('hide'); // Cerrar el modal
            } else {
                alertify.error("Fallo al eliminar el tratamiento.");
            }
        }
    });
}
