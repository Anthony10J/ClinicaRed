<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <title></title>
</head>

<body>

</body>

</html>

<script>

    function MostrarAlerta(icon, title, message, url) {
        Swal.fire({
            icon: icon,
            title: title,
            text: message,
        }).then(() => {
            window.location = url;
        });
    }
    
//-------------------------------------------------------------------------------//
//                          PROHIBIDO MODIFICAR                                 //
//-----------------------------------------------------------------------------//
function confirmarEnvio() {
    // Verificar si hay campos con datos antes de enviar el formulario
    var formHasData = false;
    var formData = new FormData(document.querySelector('form'));
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
                // Si el usuario hace clic en "Guardar", se envía el formulario
                document.querySelector('form').submit();
                // window.location.href = './V_modal_expediente.php';
                
            }
            
        });
    }
}
//-------------------------------------------------------------------------------//
//                          PROHIBIDO MODIFICAR                                 //
//-----------------------------------------------------------------------------//

function cancelar() {
        // Mostrar la alerta de confirmación antes de enviar el formulario
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas Cancelar?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario hace clic en "Guardar", se envía el formulario
                document.querySelector('form').submit();
                
            }
            
        });

}
</script>