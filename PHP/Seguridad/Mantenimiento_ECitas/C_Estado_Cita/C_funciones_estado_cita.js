function verificarEstadoCita() {
    return new Promise((resolve, reject) => {
        var Estado_Cita = $('#Estado_Cita').val();

        setTimeout(() => {
            if (Estado_Cita !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Estado_Cita/C_buscar_estado_cita.php',
                    data: { Estado_Cita: Estado_Cita },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('El estado de cita ya existe.').addClass('visible');
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('visible');
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar el estado de cita.');
                        reject(new Error('Error al buscar el estado cita.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('visible');
                resolve(true);
            }
        }, 300);
    });
}

function insertarEstadoCita() {
    var Estado_Cita = $('#Estado_Cita').val();
    var cadena = "Estado_Cita=" + Estado_Cita;

    if (Estado_Cita.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!soloLetrasYEspacios.test(Estado_Cita.trim())) {
        alertify.error("El campo solo puede contener letras.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(Estado_Cita)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarEstadoCita().then(existe => {
        if (!existe) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../C_Estado_Cita/C_guardar_estado_cita.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaEstadoCita').load('../V_Estado_Cita/V_mantenimiento_estado_cita.php');
                    alertify.success("Estado de cita registrada correctamente.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar el estado de cita.");
                }
            }
        });
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar el estado de cita.");
    });
}

$(document).ready(function() {
    $('#Estado_Cita').on('focusout', verificarEstadoCita);
});


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

    $('#Id_Estado_Cita').val(extraerDatos[0]);
    $('#Estado_Cita_E').val(extraerDatos[1]);
}

function actualizarEstadoCita() {
    var Id_Estado_Cita = $('#Id_Estado_Cita').val();
    var Estado_Cita_E = $('#Estado_Cita_E').val().trim(); // Trim para eliminar espacios al inicio y al final

    // Validar que Estado_Cita_E no esté vacío
    if (Estado_Cita_E === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    // Validar que solo contenga letras y espacios
    var letraEspacioRegex = /^[a-zA-Z\s]+$/;
    if (!letraEspacioRegex.test(Estado_Cita_E)) {
        alertify.error("El campo solo puede contener letras y espacios.");
        return;
    }

    // Contar el número de espacios
    var espacioCount = (Estado_Cita_E.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "Id_Estado_Cita=" + Id_Estado_Cita + "&Estado_Cita_E=" + Estado_Cita_E;

    $.ajax({
        type: 'POST',
        url: '../C_Estado_Cita/C_editar_estado_cita.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEstadoCita').load('../V_Estado_Cita/V_mantenimiento_estado_cita.php');
                alertify.success("Estado de cita actualizado correctamente.");
                $('#modalEditarEstadoCita').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar el estado de cita.");
            }
        }
    });
}


function validarSiNo(Id_Tipo_Documento){
    alertify.confirm('Eliminar Estado de Cita', '¿Está seguro de eliminar el Estado de cita?', 
                  function(){ eliminartipocita(Id_Tipo_Documento),
                    setTimeout(function() {
                        window.location.reload();
                    }, 800); }
                , function(){ alertify.error('Estado de cita no eliminado.')});
}

function eliminartipocita(Estado_Cita){
    cadena = "Estado_Cita=" + Estado_Cita;

    $.ajax({
        type: 'POST',
        url: '../C_Estado_Cita/C_eliminar_estado_cita.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaEstadoCita').load('../V_Estado_Cita/V_mantenimiento_estado_cita.php');
                alertify.success("Estado de cita eliminado.");
            } else {
                alertify.error("Fallo al eliminar el estado de cita.");
            }
        }
    });
}
