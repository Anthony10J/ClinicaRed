function verificarTipoCita() {
    return new Promise((resolve, reject) => {
        var Tipo_Cita = $('#Tipo_Cita').val();

        setTimeout(() => {
            if (Tipo_Cita !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Tipo_Cita/C_buscar_tipo_cita.php',
                    data: { Tipo_Cita: Tipo_Cita },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('El tipo de cita ya existe.').addClass('visible');
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('visible');
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar el tipo de cita.');
                        reject(new Error('Error al buscar el tipo de cita.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('visible');
                resolve(true);
            }
        }, 300);
    });
}

function insertarTipoCita() {
    var Tipo_Cita = $('#Tipo_Cita').val();
    var cadena = "Tipo_Cita=" + Tipo_Cita;

    if (Tipo_Cita.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!soloLetrasYEspacios.test(Tipo_Cita.trim())) {
        alertify.error("El campo solo puede contener letras.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(Tipo_Cita)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarTipoCita().then(existe => {
        if (!existe) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../C_Tipo_Cita/C_guardar_tipo_cita.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaTipoCita').load('../V_Tipo_Cita/V_mantenimiento_tipo_cita.php');
                    alertify.success("Tipo de cita registrada correctamente.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar el tipo de cita.");
                }
            }
        });
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar el tipo de cita.");
    });
}

$(document).ready(function() {
    $('#Tipo_Cita').on('focusout', verificarTipoCita);
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

    $('#Id_Tipo_Cita').val(extraerDatos[0]);
    $('#Tipo_Cita_E').val(extraerDatos[1]);
}

function actualizarTipoCita() {
    var Id_Tipo_Cita = $('#Id_Tipo_Cita').val();
    var Tipo_Cita_E = $('#Tipo_Cita_E').val().trim(); // Trim para eliminar espacios al inicio y al final

    // Validar que Tipo_Cita_E no esté vacío
    if (Tipo_Cita_E === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    // Validar que solo contenga letras y espacios
    var letraEspacioRegex = /^[a-zA-Z\s]+$/;
    if (!letraEspacioRegex.test(Tipo_Cita_E)) {
        alertify.error("El campo solo puede contener letras y espacios.");
        return;
    }

    // Contar el número de espacios
    var espacioCount = (Tipo_Cita_E.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "Id_Tipo_Cita=" + Id_Tipo_Cita + "&Tipo_Cita_E=" + Tipo_Cita_E;

    $.ajax({
        type: 'POST',
        url: '../C_Tipo_Cita/C_editar_tipo_cita.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoCita').load('../V_Tipo_Cita/V_mantenimiento_tipo_cita.php');
                alertify.success("Tipo de cita actualizado correctamente.");
                $('#modalEditarTipoCita').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar el tipo de cita.");
            }
        }
    });
}


function validarSiNo(Id_Tipo_Documento){
    alertify.confirm('Eliminar Tipo de Cita', '¿Está seguro de eliminar el tipo de cita?', 
                  function(){ eliminartipocita(Id_Tipo_Documento),
                    setTimeout(function() {
                        window.location.reload();
                    }, 800); }
                , function(){ alertify.error('Tipo de cita no eliminado.')});
}

function eliminartipocita(Tipo_Cita){
    cadena = "Tipo_Cita=" + Tipo_Cita;

    $.ajax({
        type: 'POST',
        url: '../C_Tipo_Cita/C_eliminar_tipo_cita.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaTipoCita').load('../V_Tipo_Cita/V_mantenimiento_tipo_cita.php');
                alertify.success("Tipo de cita eliminado.");
            } else {
                alertify.error("Fallo al eliminar el tipo de cita.");
            }
        }
    });
}
