function verificarTipoTerapia() {
    return new Promise((resolve, reject) => {
        var terapia = $('#terapia').val();

        setTimeout(() => {
            if (terapia !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_ETerapeutico/C_buscar_terapia.php',
                    data: { terapia: terapia },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('La terapia ya existe.').addClass('error').show();
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('error').hide();
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar la terapia.');
                        reject(new Error('Error al buscar la terapia.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('error').hide();
                resolve(true);
            }
        }, 300);
    });
}

function insertarTipoTerapia() {
    var terapia = $('#terapia').val();
    var cadena = "terapia=" + terapia;

    if (terapia.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\/\-]+$/;
    if (!soloLetrasYEspacios.test(terapia.trim())) {
        alertify.error("El campo solo puede contener letras, espacios, barras y guiones.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(terapia)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarTipoTerapia().then(existe => {
        if (!existe) {
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
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar la terapia.");
    });
}

$(document).ready(function() {
    $('#terapia').on('focusout', verificarTipoTerapia);
});

function cargarDatos(datos) {
    extraerDatos = datos.split('||');

    $('#Id_Terapia_E').val(extraerDatos[0]);
    $('#terapiaE').val(extraerDatos[1]);
}

function actualizarTipoTerapia() {
    var Id_Terapia_E = $('#Id_Terapia_E').val();
    var terapiaE = $('#terapiaE').val().trim();

    if (terapiaE === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\/\-]+$/;
    if (!soloLetrasYEspacios.test(terapiaE.trim())) {
        alertify.error("El campo solo puede contener letras, espacios, barras y guiones.");
        return;
    }

    var espacioCount = (terapiaE.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "Id_Terapia_E=" + Id_Terapia_E + "&terapiaE=" + terapiaE;

    $.ajax({
        type: 'POST',
        url: '../C_ETerapeutico/C_editar_tratamiento.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoTerapia').load('../V_ETerapeutico/V_mantenimiento_terapeutico.php');
                alertify.success("Terapia actualizada correctamente.");
                $('#modalEditarTerapia').modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar la terapia.");
            }
        }
    });
}

function validarSiNo(Id_Terapia_E) {
    alertify.confirm('Eliminar Terapia', '¿Está seguro de eliminar la terapia?', 
        function(){ eliminarTerapia(Id_Terapia_E),
            setTimeout(function() {
                window.location.reload();
            }, 800); }
        , function(){ alertify.error('Terapia no eliminada.')});
}

function eliminarTerapia(Id_Terapia_E) {
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
