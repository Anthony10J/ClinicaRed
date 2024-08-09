function validarCamposVacios(tratamiento) {
    if (tratamiento.trim() === '' ) {
        alertify.error("Los campos no pueden estar vacíos.");
        return false;
    }
    return true;
}
function verificarTratamiento() {
    return new Promise((resolve, reject) => {
        // Obtén el valor del campo de entrada
        var tratamiento = $('#tratamiento').val();

        // Espera 300 ms antes de realizar la solicitud AJAX
        setTimeout(() => {
            if (tratamiento !== '') {
                $.ajax({
                    type: 'POST',
                    url: '../C_Tratamientos/C_buscar_tratamiento.php', // Ruta al script PHP
                    data: { tratamiento: tratamiento }, // Asegúrate de enviar el valor correcto
                    dataType: 'json', // Asegúrate de que la respuesta sea JSON
                    success: function(response) {
                        if (response.existe) {
                            $('#mensaje_error').text('El tratamiento ya existe.').addClass('error').show();
                            resolve(false);
                        } else {
                            $('#mensaje_error').text('').removeClass('error').hide();
                            resolve(true);
                        }
                    },
                    error: function() {
                        alertify.error('Error al buscar el tratamiento.');
                        reject('error');
                    }
                });
            } else {
                $('#mensaje_error').text('').removeClass('error').hide();
                resolve(true);
            }
        }, 300); // Retraso de 300 ms antes de la solicitud
    });
}


$(document).ready(function() {
    // Agregar el evento focusout a la función verificarParametro
    $('#tratamiento').on('focusout', verificarTratamiento);
});

async function insertarTipoTratamiento(tratamiento) {
    // Validar campos vacíos
    if (!validarCamposVacios(tratamiento)) {
        return;
    }

    // Validar que el campo solo contenga letras y espacios
    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\/\-]+$/;
    if (!soloLetrasYEspacios.test(tratamiento.trim())) {
        alertify.error("El campo solo puede contener letras, espacios, barras y guiones.");
        return;
    }

    // Validar que no haya más de dos espacios consecutivos
    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(tratamiento)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return;
    }

    // Esperar a que la verificación del tratamiento termine
    const tratamientoValido = await verificarTratamiento();

    // Si el tratamiento ya existe (mensaje de error es visible), detén la ejecución
    if (!tratamientoValido) {
        return;
    }

    // Realizar la inserción del tratamiento si todas las validaciones son correctas
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
    var idTipoTerapia = $('#idTipoTerapia').val();
    var tratamiento_E = $('#tratamiento_E').val();

    // Validar que el campo no esté vacío
    if (tratamiento_E.trim() === '') {
        alertify.error('El campo no puede guardarse vacío.');
        return false;
    }

    // Validar que el campo solo contenga letras, espacios, barras y guiones
    var soloLetrasYEspacios = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\/\-]+$/;
    if (!soloLetrasYEspacios.test(tratamiento_E.trim())) {
        alertify.error("El campo solo puede contener letras, espacios, barras y guiones.");
        return false;
    }

    // Validar que no haya más de dos espacios consecutivos
    var dosEspaciosConsecutivos = /\s{3,}/;
    if (dosEspaciosConsecutivos.test(tratamiento_E)) {
        alertify.error("El campo no puede contener más de dos espacios consecutivos.");
        return false;
    }

    // Crear la cadena de datos para la solicitud AJAX
    var cadena = "idTipoTerapia=" + idTipoTerapia + 
                 "&tratamiento_E=" + tratamiento_E;

    // Realizar la solicitud AJAX para actualizar el tratamiento
    $.ajax({
        type: 'POST',
        url: '../C_Tratamientos/C_editar_terapia.php',
        data: cadena,
        success: function (respuesta) {
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
