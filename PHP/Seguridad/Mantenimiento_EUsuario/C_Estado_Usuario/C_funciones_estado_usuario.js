function verificarEstadoUsuario() {
    return new Promise((resolve, reject) => {
        var Estado_Usuario = $('#Estado_Usuario').val();

        setTimeout(() => {
            if (Estado_Usuario !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Estado_Usuario/C_buscar_estado_usuario.php',
                    data: { Estado_Usuario: Estado_Usuario },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('El estado de usuario ya existe.').addClass('visible');
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('visible');
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar el estado de usuario.');
                        reject(new Error('Error al buscar el estado de usuario.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('visible');
                resolve(true);
            }
        }, 300);
    });
}

function insertarEstadoUsuario() {
    var Estado_Usuario = $('#Estado_Usuario').val();
    var cadena = "Estado_Usuario=" + Estado_Usuario;

    if (Estado_Usuario.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!soloLetrasYEspacios.test(Estado_Usuario.trim())) {
        alertify.error("El campo solo puede contener letras.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(Estado_Usuario)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarEstadoUsuario().then(existe => {
        if (!existe) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../C_Estado_Usuario/C_guardar_estado_usuario.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaEstadoUsuario').load('../V_Estado_Usuario/V_mantenimiento_estado_usuario.php');
                    alertify.success("Estado de usuario registrado correctamente.");
                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar el estado de usuario.");
                }
            }
        });
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar el estado de usuario.");
    });
}

$(document).ready(function () {
    $('#Estado_Usuario').on('focusout', verificarEstadoUsuario);
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

    $('#Id_Estado').val(extraerDatos[0]);
    $('#Estado_Usuario_E').val(extraerDatos[1]);
}

function actualizarEstadoUsuario() {
    Id_Estado = $('#Id_Estado').val();
    Estado_Usuario_E = $('#Estado_Usuario_E').val();

    cadena = "Id_Estado=" + Id_Estado +
        "&Estado_Usuario_E=" + Estado_Usuario_E;

    if (Estado_Usuario_E.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    // Validar que solo contenga letras y espacios
    var letraEspacioRegex = /^[a-zA-Z\s]+$/;
    if (!letraEspacioRegex.test(Estado_Usuario_E)) {
        alertify.error("El campo solo puede contener letras y espacios.");
        return;
    }

    // Contar el número de espacios
    var espacioCount = (Estado_Usuario_E.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "Estado_Usuario_E=" + Estado_Usuario_E + "&Estado_Usuario_E=" + Estado_Usuario_E;

    $.ajax({
        type: 'POST',
        url: '../C_Estado_Usuario/C_editar_estado_usuario.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEstadoUsuario').load('../V_Estado_Usuario/V_mantenimiento_estado_usuario.php');
                alertify.success("Estado de usuario actualizado correctamente.");
                $('#modalEditarEstadoUsuario').modal('hide'); // Cerrar el modal

            } else {
                alertify.error("Fallo al actualizar el estado de usuario.");
            }
        }
    });
}

function validarSiNo(Id_Estado) {
    alertify.confirm('Eliminar estado de usuario', '¿Está seguro de eliminar el estado de usuario?',
        function () {
            eliminarEstadoUsuario(Id_Estado),
            setTimeout(function () {
                window.location.reload();
            }, 800);
        }
        , function () { alertify.error('Estado de usuario no eliminado.') });
}

function eliminarEstadoUsuario(Id_Estado) {
    cadena = "Id_Estado=" + Id_Estado;

    $.ajax({
        type: 'POST',
        url: '../C_Estado_Usuario/C_eliminar_estado_usuario.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaEstadoUsuario').load('../V_Estado_Usuario/V_mantenimiento_estado_usuario.php');
                alertify.success("Estado de usuario eliminado.");
            } else {
                alertify.error("Fallo al eliminar el estado de usuario.");
            }
        }
    });
}
