function verificarTipoIdentificacion() {
    // Obtén el valor del campo de entrada
    var identidad = $('#identidad').val();

    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (identidad !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_Identidad/C_buscar_tipo_identificacion.php', // Ruta al script PHP
                data: {
                    identidad: identidad // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function (response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('El tipo de identificación ya existe.').addClass('error').show();
                        // alertify.error("El parámetro ya existe.");
                        return false;
                    } else {
                        // Si el parámetro no existe, oculta el mensaje de error
                        $('#mensaje_error').text('').removeClass('error').hide();
                    }
                },
                error: function () {
                    alertify.error('Error al buscar el tipo de identificación.');
                    // Puedes mostrar un mensaje de error en la interfaz de usuario si es necesario
                }
            });
        } else {
            // Si el campo está vacío, oculta el mensaje de error
            $('#mensaje_error').text('').removeClass('error').hide();
        }
    }, 300); // Retraso de 300 ms antes de la solicitud
}

$(document).ready(function() {
    // Agregar el evento focusout a la función verificarParametro
    $('#identidad').on('focusout', verificarTipoIdentificacion);
});

function insertarTipoIdentidad(identidad) {
    cadena = "identidad=" + identidad;

    if(identidad.trim()===''){
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    verificarTipoIdentificacion();

    // Si se muestra un mensaje de error, detén la ejecución de insertarParametro
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }
    $.ajax({
        type: 'POST',
        url: '../C_Identidad/C_guardar_identidad.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoIdentidad').load('../V_Identidad/V_mantenimiento_identidad.php');
                alertify.success("Tipo de identifiación registrado correctamente.");
                //$('#modalNuevaIdentidad').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al guardar el tipo de identificación.");
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

    $('#Id_Tipo_Documento').val(extraerDatos[0]);
    $('#identidad_E').val(extraerDatos[1]);
}

function actualizarTipoIdentidad() {
    Id_Tipo_Documento = $('#Id_Tipo_Documento').val();
    identidad_E = $('#identidad_E').val();

    cadena = "Id_Tipo_Documento=" + Id_Tipo_Documento +
        "&identidad_E=" + identidad_E;

        if(identidad_E.trim()===''){
            alertify.error("Los campos no pueden estar vacíos.");
            return;
        }

    $.ajax({
        type: 'POST',
        url: '../C_Identidad/C_editar_identidad.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoIdentidad').load('../V_Identidad/V_mantenimiento_identidad.php');
                alertify.success("Tipo de identifiación actualizado correctamente.");
                $('#modalEditarIdentidad').modal('hide'); // Cerrar el modal

            } else {
                alertify.error("Fallo al actualizar el tipo de identificación.");
            }
        }
    });
}

function validarSiNo(Id_Tipo_Documento){
    alertify.confirm('Eliminar Tipo de Identificación', '¿Está seguro de eliminar el tipo de identificación?', 
                  function(){ eliminarIdentidad(Id_Tipo_Documento),
                    setTimeout(function() {
                        window.location.reload();
                    }, 800); }
                , function(){ alertify.error('Tipo de identifiación no eliminado.')});
}

function eliminarIdentidad(Id_Tipo_Documento){
    cadena = "Id_Tipo_Documento=" + Id_Tipo_Documento;

    $.ajax({
        type: 'POST',
        url: '../C_Identidad/C_eliminar_identidad.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaTipoIdentidad').load('../V_Identidad/V_mantenimiento_identidad.php');
                alertify.success("Tipo de identifiación eliminado.");
            } else {
                alertify.error("Fallo al eliminar el tipo de identificación.");
            }
        }
    });
}
