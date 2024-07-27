function validarCamposVacios(parametro, valorParametro) {
    if (parametro.trim() === '' || valorParametro.trim() === '') {
        alertify.error("Los campos no pueden estar vacíos.");
        return false;
    }
    return true;
}

function validarCeros(parametro, valorParametro) {
    if (parametro.trim() === '0' || valorParametro.trim() === '0') {
        alertify.error("No está permitido guardar 0.");
        return false;
    }
    return true;
}

function validarNegativos(parametro, valorParametro) {
    if (parametro.trim() < 0 || valorParametro.trim() < 0) {
        alertify.error("No está permitido guardar valores negativos.");
        return false;
    }
    return true;
}

function validarCaracteresEspeciales(valorParametro) {
    // Define una lista de caracteres especiales que quieras evitar
    const caracteresEspeciales = /[!#$%^&*()_+\-=[\]{};':"\\|,<>/?]+/;

    // Verifica si el valor del campo de entrada contiene caracteres especiales
    if (caracteresEspeciales.test(valorParametro)) {
        alertify.error("No se permiten caracteres especiales");
        return false;
    }

    // Si no se encuentran caracteres especiales, devuelve true
    return true;
}


// Definición de la función para verificar el parámetro
function verificarParametro() {
    // Obtén el valor del campo de entrada
    var parametro = $('#parametro').val();

    // Espera 300 ms antes de realizar la solicitud AJAX
    setTimeout(() => {
        if (parametro !== '') {
            $.ajax({
                type: 'POST',
                url: '../C_Parametros/C_buscar_parametro.php', // Ruta al script PHP
                data: {
                    parametro: parametro // Asegúrate de enviar el valor correcto
                },
                dataType: 'json', // Asegúrate de que la respuesta sea JSON
                success: function (response) {
                    // Verifica la respuesta y muestra u oculta el mensaje de error según corresponda
                    if (response.existe) {
                        // Si el parámetro ya existe, muestra el mensaje de error
                        $('#mensaje_error').text('El parámetro ya existe.').addClass('error').show();
                        // alertify.error("El parámetro ya existe.");
                        return false;
                    } else {
                        // Si el parámetro no existe, oculta el mensaje de error
                        $('#mensaje_error').text('').removeClass('error').hide();
                    }
                },
                error: function () {
                    alertify.error('Error al buscar el parámetro.');
                    // Puedes mostrar un mensaje de error en la interfaz de usuario si es necesario
                }
            });
        } else {
            // Si el campo está vacío, oculta el mensaje de error
            $('#mensaje_error').text('').removeClass('error').hide();
        }
    }, 300); // Retraso de 300 ms antes de la solicitud
}

$(document).ready(function () {
    // Agregar el evento focusout a la función verificarParametro
    $('#parametro').on('focusout', verificarParametro);
});


function insertarParametro(parametro, valorParametro) {
    // Si los campos están vacíos, muestra un mensaje de error y detén la ejecución
    if (!validarCamposVacios(parametro, valorParametro)) {
        return;
    }

    if (!validarCeros(parametro, valorParametro)) {
        return;
    }
    if (!validarNegativos(parametro, valorParametro)) {
        return;
    }
    if (!validarCaracteresEspeciales(parametro) || !validarCaracteresEspeciales(valorParametro)) {
        return;
    }

    // Verifica si el parámetro ya existe utilizando la función verificarParametro()
    // Asumiendo que verificarParametro() retorna true si el parámetro existe y false si no existe.
    verificarParametro();

    // Si se muestra un mensaje de error, detén la ejecución de insertarParametro
    if ($('#mensaje_error').is(':visible')) {
        // El mensaje de error es visible, significa que el parámetro ya existe
        // Por lo tanto, no procedemos con la inserción
        return;
    }


    // Procede con la inserción si el parámetro no existe y los campos no están vacíos
    cadena = "parametro=" + parametro +
        "&valorParametro=" + valorParametro;
    $.ajax({
        type: 'POST',
        url: '../C_Parametros/C_guardar_parametro.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaParametros').load('../V_Parametros/V_mantenimiento_parametros.php');
                alertify.success("Parámetro registrado correctamente.");
                // window.location.reload();
                setTimeout(function () {
                    window.location.reload();
                }, 800);

            } else {
                alertify.error("Fallo al guardar el parámetro.");
            }
        }
    });
}


function cargarDatosLectura(datos) {
    extraerDatos = datos.split('||');

    $('#Id_Parametro_L').val(extraerDatos[0]);
    $('#parametro_L').val(extraerDatos[1]);
    $('#valorParametro_L').val(extraerDatos[2]);
    $('#creadoPor_L').val(extraerDatos[3]);
    $('#fechaCreacion_L').val(extraerDatos[4]);
    $('#modificadoPor_L').val(extraerDatos[5]);
    $('#fechaModificacion_L').val(extraerDatos[6]);
}

function cargarDatos(datos) {
    extraerDatos = datos.split('||');

    $('#Id_Parametro').val(extraerDatos[0]);
    $('#parametroE').val(extraerDatos[1]);
    $('#valorParametroE').val(extraerDatos[2]);
}

// function validarCampos() {
//     // Obtener los valores de los campos
//     var parametroE = $('#parametroE').val();
//     var valorParametroE = $('#valorParametroE').val();

//     // Verificar si los campos están vacíos
//     if (parametroE.trim() === '' || valorParametroE.trim() === '') {
//         // Mostrar un mensaje de error
//         alertify.error("No puede dejar campos vacíos.");
//         return false; // Detener el proceso de actualización
//     }
//     return true; // Campos válidos
// }
function actualizaParametro() {

    Id_Parametro = $('#Id_Parametro').val();
    parametroE = $('#parametroE').val();
    valorParametroE = $('#valorParametroE').val();

    cadena = "Id_Parametro=" + Id_Parametro +
        "&parametroE=" + parametroE +
        "&valorParametroE=" + valorParametroE;

    if (valorParametroE.trim() === '') {
        alertify.error('El campo no puede guardarse vacío.');
        return false;
    } else if (valorParametroE.trim() === '0') {
        alertify.error('No está permitido guardar 0.');
        return false;
    } else if (valorParametroE.trim() < 0) {
        alertify.error('No está permitido guardar valores negativos.');
        return false;
    } else if (!validarCaracteresEspeciales(valorParametroE)) {
        return false;
    } else {
        $.ajax({
            type: 'POST',
            url: '../C_Parametros/C_editar_parametro.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaParametros').load('../V_Parametros/V_mantenimiento_parametros.php');
                    alertify.success("Parámetro actualizado correctamente.");
                    setTimeout(function () {
                        window.location.reload();
                    }, 800);

                } else {
                    alertify.error("Fallo al actualizar el parámetro.");
                }
            }
        });
    }
}


function validarSiNo(Id_Parametro) {
    alertify.confirm('Eliminar Parámetro', '¿Está seguro de eliminar el parámetro?',
        function () {
            eliminarParametro(Id_Parametro),
                setTimeout(function () {
                    window.location.reload();
                }, 800);
        }
        , function () { alertify.error('Parámetro no eliminado.') });
}

function eliminarParametro(Id_Parametro) {
    cadena = "Id_Parametro=" + Id_Parametro;

    $.ajax({
        type: 'POST',
        url: '../C_Parametros/C_eliminar_parametro.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaParametros').load('../V_Parametros/V_mantenimiento_parametros.php');
                alertify.success("Parámetro eliminado.");
            } else {
                alertify.error("Fallo al eliminar el parámetro.");
            }
        }
    });
}