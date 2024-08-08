function confirmarEnvioEditable() {
    // Verificar si hay campos con datos antes de enviar el formulario
    var formHasData = false;
    var form = document.querySelector('form');
    var formData = new FormData(form);
    formData.forEach(function(value) {
        if (value.trim() !== '') {
            formHasData = true;
        }
    });

    if (!formHasData) {
        // Si no hay datos, mostrar mensaje de advertencia y no enviar el formulario
        Swal.fire({
            title: 'Atención',
            text: 'No hay datos para guardar.',
            icon: 'warning',
            confirmButtonText: 'Aceptar'
        });
    } else {
        // Mostrar la alerta de confirmación antes de enviar el formulario
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas guardar los datos?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario usando fetch
                fetch(form.action, {
                    method: form.method,
                    body: formData
                }).then(response => {
                    if (response.ok) {
                        // Mostrar mensaje de éxito y redirigir
                        Swal.fire({
                            title: 'Éxito',
                            text: 'Los datos se han guardado correctamente.',
                            icon: 'success',
                            timer: 2000, // Cerrar automáticamente después de 2 segundos
                            showConfirmButton: false
                        }).then(() => {
                            // Redirigir después de mostrar el mensaje de éxito
                            window.location.href = '/PHP/Negocio/Expediente/V_Expediente/V_modal_expediente.php';
                        });
                    } else {
                        // Manejar errores en caso de que la respuesta no sea correcta
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error al guardar los datos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        });
                    }
                }).catch(error => {
                    // Manejar errores de red
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error al enviar la solicitud.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar'
                    });
                });
            }
        });
    }
}