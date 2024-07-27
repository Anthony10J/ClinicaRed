
function insertarExpediente(Id_Paciente) {
    Id_Expediente = $('#Id_Expediente').val();
    if (Id_Expediente > 0) {
        alertify.error("El paciente ya tiene un expediente creado.");
        return false;
    } else {
        cadena = "&Id_Paciente=" + Id_Paciente;
        $.ajax({
            type: 'POST',
            url: '../C_Expediente/C_guardar_expediente.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaExpediente').load('../V_Expediente/V_gestion_expediente.php');
                    alertify.success("Expediente registrado correctamente.");
                    setTimeout(function() {
                        window.location.reload();
                    }, 800);
                } else {
                    alertify.error("Fallo al guardar el expediente.");
                }
            }
        });
    }
}

function cargarDatosLectura(datos) {
    extraerDatos = datos.split('||');

    $('#idExpediente_L').val(extraerDatos[0]);
    $('#numero_identificacion_L').val(extraerDatos[1]);
    $('#paciente_L').val(extraerDatos[2]);
    $('#creadoP_L').val(extraerDatos[3]);
    $('#fechaC_L').val(extraerDatos[4]);
}