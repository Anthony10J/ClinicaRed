function verificarGenero() {
    return new Promise((resolve, reject) => {
        var Genero = $('#Genero').val();

        setTimeout(() => {
            if (Genero !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Genero/C_buscar_genero.php',
                    data: { Genero: Genero },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('El género ya existe.').addClass('visible');
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('visible');
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar el género.');
                        reject(new Error('Error al buscar el género.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('visible');
                resolve(true);
            }
        }, 300);
    });
}

function insertarGenero() {
    var Genero = $('#Genero').val();
    var cadena = "Genero=" + Genero;

    if (Genero.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!soloLetrasYEspacios.test(Genero.trim())) {
        alertify.error("El campo solo puede contener letras.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(Genero)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarGenero().then(existe => {
        if (!existe) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../C_Genero/C_guardar_genero.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaGenero').load('../V_Genero/V_mantenimiento_genero.php');
                    alertify.success("Género registrado correctamente.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar el género.");
                }
            }
        });
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar el género.");
    });
}

$(document).ready(function() {
    $('#Genero').on('focusout', verificarGenero);
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

    $('#IdGenero').val(extraerDatos[0]);
    $('#Genero_E').val(extraerDatos[1]);
}

function actualizarGenero() {
    var IdGenero = $('#IdGenero').val();
    var Genero_E = $('#Genero_E').val().trim(); // Trim para eliminar espacios al inicio y al final

    // Validar que Genero_E no esté vacío
    if (Genero_E === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    // Validar que solo contenga letras y espacios
    var letraEspacioRegex = /^[a-zA-Z\s]+$/;
    if (!letraEspacioRegex.test(Genero_E)) {
        alertify.error("El campo solo puede contener letras y espacios.");
        return;
    }

    // Contar el número de espacios
    var espacioCount = (Genero_E.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "IdGenero=" + IdGenero + "&Genero_E=" + Genero_E;

    $.ajax({
        type: 'POST',
        url: '../C_Genero/C_editar_genero.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaGenero').load('../V_Genero/V_mantenimiento_genero.php');
                alertify.success("Género actualizado correctamente.");
                $('#modalEditarGenero').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar el género.");
            }
        }
    });
}


function validarSiNo(IdGenero){
    alertify.confirm('Eliminar Género', '¿Está seguro de eliminar el género?', 
                  function(){ eliminarGenero(IdGenero),
                    setTimeout(function() {
                        window.location.reload();
                    }, 800); }
                , function(){ alertify.error('Género no eliminado.')});
}

function eliminarGenero(IdGenero){
    cadena = "IdGenero=" + IdGenero;

    $.ajax({
        type: 'POST',
        url: '../C_Genero/C_eliminar_genero.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaGenero').load('../V_Genero/V_mantenimiento_genero.php');
                alertify.success("género eliminado.");
            } else {
                alertify.error("Fallo al eliminar el género.");
            }
        }
    });
}
