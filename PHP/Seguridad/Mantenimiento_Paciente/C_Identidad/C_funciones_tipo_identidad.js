function verificarTipoIdentificacion() {
    return new Promise((resolve, reject) => {
        var identidad = $('#identidad').val();

        setTimeout(() => {
            if (identidad !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Identidad/C_buscar_tipo_identificacion.php',
                    data: { identidad: identidad },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('El tipo de identificación ya existe.').addClass('error').show();
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('visible');
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar el tipo de identificación.');
                        reject(new Error('Error al buscar el tipo de identificación.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('visible');
                resolve(true);
            }
        }, 300);
    });
}

function insertarTipoIdentidad() {
    var identidad = $('#identidad').val();
    var cadena = "identidad=" + identidad;

    if (identidad.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!soloLetrasYEspacios.test(identidad.trim())) {
        alertify.error("El campo solo puede contener letras.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(identidad)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarTipoIdentificacion().then(existe => {
        if (!existe) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../C_Identidad/C_guardar_identidad.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaTipoIdentidad').load('../V_Identidad/V_mantenimiento_identidad.php');
                    alertify.success("Tipo de identificación registrado correctamente.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar el tipo de identificación.");
                }
            }
        });
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar el tipo de identificación.");
    });
}

$(document).ready(function() {
    $('#identidad').on('focusout', verificarTipoIdentificacion);
});

function cargarDatos(datos) {
    extraerDatos = datos.split('||');

    $('#Id_Tipo_Documento').val(extraerDatos[0]);
    $('#identidad_E').val(extraerDatos[1]);
}

function actualizarTipoIdentidad() {
    var Id_Tipo_Documento = $('#Id_Tipo_Documento').val();
    var identidad_E = $('#identidad_E').val().trim();

    if (identidad_E === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var letraEspacioRegex = /^[a-zA-Z\s]+$/;
    if (!letraEspacioRegex.test(identidad_E)) {
        alertify.error("El campo solo puede contener letras y espacios.");
        return;
    }

    var espacioCount = (identidad_E.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "Id_Tipo_Documento=" + Id_Tipo_Documento + "&identidad_E=" + identidad_E;

    $.ajax({
        type: 'POST',
        url: '../C_Identidad/C_editar_identidad.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoIdentidad').load('../V_Identidad/V_mantenimiento_identidad.php');
                alertify.success("Tipo de identificación actualizado correctamente.");
                $('#modalEditarIdentidad').modal('hide');
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar el tipo de identificación.");
            }
        }
    });
}

function validarSiNo(Id_Tipo_Documento) {
    alertify.confirm('Eliminar Tipo de Identificación', '¿Está seguro de eliminar el tipo de identificación?', 
        function(){ eliminarIdentidad(Id_Tipo_Documento),
            setTimeout(function() {
                window.location.reload();
            }, 800); }
        , function(){ alertify.error('Tipo de identificación no eliminado.')});
}

function eliminarIdentidad(Id_Tipo_Documento) {
    cadena = "Id_Tipo_Documento=" + Id_Tipo_Documento;

    $.ajax({
        type: 'POST',
        url: '../C_Identidad/C_eliminar_identidad.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaTipoIdentidad').load('../V_Identidad/V_mantenimiento_identidad.php');
                alertify.success("Tipo de identificación eliminado.");
            } else {
                alertify.error("Fallo al eliminar el tipo de identificación.");
            }
        }
    });
}
