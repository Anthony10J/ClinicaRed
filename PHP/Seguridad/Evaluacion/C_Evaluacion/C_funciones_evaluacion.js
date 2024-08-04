function verificarExamen() {
    return new Promise((resolve, reject) => {
        var descripcion = $('#descripcion').val();

        setTimeout(() => {
            if (descripcion !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Evaluacion/C_buscar_examen.php',
                    data: { descripcion: descripcion },
                    dataType: 'json',
                    success: function (response) {
                        if (response.existe) {
                            $('#mensaje_error').text('La evaluación ya existe.').addClass('visible');
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('visible');
                            resolve(true);
                        }
                    },
                    error: function () {
                        alertify.error('Error al buscar la evaluación.');
                        reject(new Error('Error al buscar la evaluación.'));
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('visible');
                resolve(true);
            }
        }, 300);
    });
}

function insertarEvaluacion() {
    var descripcion = $('#descripcion').val();
    var cadena = "descripcion=" + descripcion;

    if (descripcion.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
    if (!soloLetrasYEspacios.test(descripcion.trim())) {
        alertify.error("El campo solo puede contener letras.");
        return;
    }

    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(descripcion)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    verificarExamen().then(existe => {
        if (!existe) {
            return;
        }

        $.ajax({
            type: 'POST',
            url: '../C_Evaluacion/C_guardar_evaluacion.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaEvaluacion').load('../V_Evaluacion/V_mantenimiento_evaluacion.php');
                    alertify.success("Evaluación registrada correctamente.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar la evaluación.");
                }
            }
        });
    }).catch(error => {
        console.error(error);
        alertify.error("Error al verificar la evaluación.");
    });
}

$(document).ready(function() {
    $('#descripcion').on('focusout', verificarExamen);
});

function cargarDatos(datos) {
    extraerDatos = datos.split('||');

    $('#Id_Evaluacion_E').val(extraerDatos[0]);
    $('#descripcionE').val(extraerDatos[1]);
}

function actualizarEvaluacion() {
    var Id_Evaluacion_E = $('#Id_Evaluacion_E').val();
    var descripcionE = $('#descripcionE').val().trim(); // Trim para eliminar espacios al inicio y al final

    // Validar que descripcionE no esté vacío
    if (descripcionE === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return;
    }

    // Validar que solo contenga letras y espacios
    var letraEspacioRegex = /^[a-zA-Z\s]+$/;
    if (!letraEspacioRegex.test(descripcionE)) {
        alertify.error("El campo solo puede contener letras y espacios.");
        return;
    }

    // Contar el número de espacios
    var espacioCount = (descripcionE.match(/\s/g) || []).length;
    if (espacioCount > 1) {
        alertify.error("El campo no puede contener más de dos espacios.");
        return;
    }

    var cadena = "Id_Evaluacion_E=" + Id_Evaluacion_E + "&descripcionE=" + descripcionE;

    $.ajax({
        type: 'POST',
        url: '../C_Evaluacion/C_editar_evaluacion.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaEvaluacion').load('../V_Evaluacion/V_mantenimiento_evaluacion.php');
                alertify.success("Evaluación actualizada correctamente.");
                $('#modalEditarEvaluacion').modal('hide'); // Cerrar el modal
                setTimeout(function() {
                    window.location.reload();
                }, 800);
            } else {
                alertify.error("Fallo al actualizar la evaluación.");
            }
        }
    });
}

function validarSiNo(Id_Evaluacion_E) {
    alertify.confirm('Eliminar Evaluación', '¿Está seguro de eliminar la evaluación?', 
        function(){ eliminarEvaluacion(Id_Evaluacion_E),
            setTimeout(function() {
                window.location.reload();
            }, 800); }
        , function(){ alertify.error('Evaluación no eliminada.')});
}

function eliminarEvaluacion(Id_Evaluacion_E) {
    cadena = "Id_Evaluacion_E=" + Id_Evaluacion_E;

    $.ajax({
        type: 'POST',
        url: '../C_Evaluacion/C_eliminar_evaluacion.php',
        data: cadena,
        success: function (respuesta) {
            console.log(respuesta)
            if (respuesta == 1) {
                $('#tablaEvaluacion').load('../V_Evaluacion/V_mantenimiento_evaluacion.php');
                alertify.success("Evaluación eliminada.");
            } else {
                alertify.error("Fallo al eliminar la evaluación.");
            }
        }
    });
}
