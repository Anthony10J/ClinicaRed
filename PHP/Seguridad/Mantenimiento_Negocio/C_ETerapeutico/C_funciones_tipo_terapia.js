function verificarTipoTerapia() {
    // Obtén el valor del campo de entrada
    var terapia = $('#terapia').val();

    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (terapia !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_ETerapeutico/C_buscar_terapia.php', // Ruta al script PHP
                data: {
                    terapia: terapia // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function (response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('La terapia ya existe.').addClass('error').show();
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

$(document).ready(function() {
    // Agregar el evento focusout a la función verificarParametro
    $('#terapia').on('focusout', verificarTipoTerapia);
});

function insertarTipoTerapia(terapia) {
    cadena = "terapia=" + terapia;

    if(terapia.trim() === ''){
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    verificarTipoTerapia
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }

    $.ajax({
        type: 'POST',
        url: '../C_ETerapeutico/C_guardar_tratamiento.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoTerapia').load('../V_ETerapeutico/V_mantenimiento_terapeutico.php');
                alertify.success("Terapia registrada correctamente.");
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al guardar la terapia.");
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

    $('#Id_Terapia_E').val(extraerDatos[0]);
    $('#terapiaE').val(extraerDatos[1]);
}

function actualizarTipoTerapia() {
    Id_Terapia_E = $('#Id_Terapia_E').val();
    terapiaE = $('#terapiaE').val();

    cadena = "Id_Terapia_E=" + Id_Terapia_E +
        "&terapiaE=" + terapiaE;

        if(terapiaE.trim() === ''){
            alertify.error("Los campos no pueden estar vacíos.");
            return
        }
    $.ajax({
        type: 'POST',
        url: '../C_ETerapeutico/C_editar_tratamiento.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoTerapia').load('../V_ETerapeutico/V_mantenimiento_terapeutico.php');
                alertify.success("Terapia actualizada correctamente.");
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar la terapia.");
            }
        }
    });
}

function validarSiNo(Id_Terapia_E){
    alertify.confirm('Eliminar Terapia', '¿Está seguro de eliminar la terapia?', 
                  function(){ eliminarTerapia(Id_Terapia_E),  
                    setTimeout(function() {
                        window.location.reload();
                    }, 800); }
                , function(){ alertify.error('Terapia no eliminada.')});
}

function eliminarTerapia(Id_Terapia_E){
    cadena = "Id_Terapia_E=" + Id_Terapia_E;

    $.ajax({
        type: 'POST',
        url: '../C_ETerapeutico/C_eliminar_tratamiento.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoTerapia').load('../V_ETerapeutico/V_mantenimiento_terapeutico.php');
                alertify.success("Terapia eliminada.");
            } else {
                alertify.error("Fallo al eliminar la Terapia.");
            }
        }
    });
}
