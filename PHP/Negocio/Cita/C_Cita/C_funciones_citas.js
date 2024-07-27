function insertarCita(motivoCita, fechaCita, horaCita, Id_Paciente, tipoCita, subespecialidad, Id_Expediente) {
    cadena = "motivoCita=" + motivoCita +
        "&fechaCita=" + fechaCita +
        "&horaCita=" + horaCita +
        "&Id_Paciente=" + Id_Paciente +
        "&tipoCita=" + tipoCita +
        "&subespecialidad=" + subespecialidad +
        "&Id_Expediente=" + Id_Expediente;
    $.ajax({
        type: 'POST',
        url: '../C_Cita/C_guardar_cita.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
                alertify.success("Cita registrada correctamente.");
            } else {
                alertify.error("Fallo al guardar la cita.");
            }
        }
    });
}

function actualizarCita() {
    idCita_E = $('#idCita_E').val();
    tipoCita_E = $('#tipoCita_E').val();
    motivoCita_E = $('#motivoCita_E').val();
    subespecialidad_E = $('#subespecialidad_E').val();
    fechaCita_E = $('#fechaCita_E').val();
    horaCita_E = $('#horaCita_E').val();
    
    cadena = "idCita_E=" + idCita_E +
    "&tipoCita_E=" + tipoCita_E +
    "&motivoCita_E=" + motivoCita_E +
        "&subespecialidad_E=" + subespecialidad_E +
        "&fechaCita_E=" + fechaCita_E +
        "&horaCita_E=" + horaCita_E;
        
        $.ajax({
            type: 'POST',
            url: '../C_Cita/C_editar_cita.php',
            data: cadena,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
                    alertify.success("Cita actualizada correctamente.");
                } else {
                    alertify.error("Fallo al actualizar la cita.");
                }
            }
        });
    }
    
    function confirmarCita(idCita_L) {
        alertify.confirm('Cancelar Cita', '¿Estás seguro de cancelar la cita?',
        function () {
            cancelarCita(idCita_L)
        }
        , function () { alertify.error('Cita no cancelada.') });
}
        function cargarDatosLectura(datos) {
            extraerDatos = datos.split('||');
        
            $('#idCita_L').val(extraerDatos[0]);
            $('#tipoCita_L').val(extraerDatos[1]);
            $('#motivoCita_L').val(extraerDatos[2]);
            $('#nombrePaciente_L').val(extraerDatos[3]);
            $('#nombreDoctor_L').val(extraerDatos[4]);
            $('#fechaCita_L').val(extraerDatos[5]);
            $('#horaCita_L').val(extraerDatos[6]);
            $('#Id_Estado_Cita').val(extraerDatos[7]);
            $('#Id_Especialista').val(extraerDatos[8]);
            $('#Id_Usuario_L').val(extraerDatos[9]);
            // $('#Id_Usuario_L').val(extraerDatos[10]);
        }
        
        function cargarDatos(datos) {
            let extraerDatos = datos.split('||');
        
            $('#idCita_E').val(extraerDatos[0]);
            $('#tipoCita_E').val(extraerDatos[1]);
            $('#motivoCita_E').val(extraerDatos[2]);
            $('#nombrePaciente_E').val(extraerDatos[3]);
            $('#subespecialidad_E').val(extraerDatos[4]);
            $('#fechaCita_E').val(extraerDatos[5]); // Cambiado de 'fechaCita_L' a 'fechaCita_E'
            $('#horaCita_E').val(extraerDatos[6]);
            $('#Id_Estado_Cita').val(extraerDatos[7]);
            $('#Id_Especialista').val(extraerDatos[8]);
            $('#Id_Usuario_L').val(extraerDatos[9]);
        }

function cancelarCita(idCita_L) {
    cadena = "idCita_L=" + idCita_L;

    $.ajax({
        type: 'POST',
        url: '../C_Cita/C_eliminar_cita.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
                alertify.success("Cita cancelada.");
                setTimeout(function () {
                    window.location.reload();
                }, 370);
            } else {
                alertify.error("Fallo al cancelar la cita.");
            }
        }
    });
}

function cambiarEstado_EnEspera(idCita_L) {
   
    alertify.confirm('Cambiar Estado de la Cita', '¿Estás seguro de cambiar el estado de Pendiente a En Espera?',
        function () {
            var Id_Especialista = $('#Id_Especialista').val();
            
            // Verificar el estado del especialista
            $.ajax({
                type: 'POST',
                url: '../C_Cita/C_verificar_estado_especialista.php',
                data: { Id_Especialista: Id_Especialista },
                success: function (respuesta) {
                    if (respuesta === "3") {
                        alertify.error("El Evaluador está atendiendo a un paciente. Por favor, esperar un momento.");
                    } else if (respuesta === "2") {
                        alertify.error("El Evaluador ya tiene una cita en espera. No puede tener más de una cita en estado de espera.");
                    } else {
                      
                        CambiarEstadoEnEspera(idCita_L);
                    }
                },
                error: function () {
                    alertify.error("Error al verificar el estado del especialista.");
                }
            });
        },
        function () {
            alertify.error('No se actualizó el estado de la cita.');
        }
    );
}

function CambiarEstadoEnEspera(idCita_L) {
    var cadena = "idCita_L=" + idCita_L;

    $.ajax({
        type: 'POST',
        url: '../C_Cita/C_estado_espera_cita.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#idCita_L').val('');
                $('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
                alertify.success("Se actualizó el estado de la cita");
            } else {
                alertify.error("Fallo al cambiar el estado de la cita.");
            }
        }
    });
}



// function validarEstado_AtencionCita() {
//     Id_Estado_Cita = $('#Id_Estado_Cita').val();
//     Id_Especialista = $('#Id_Especialista').val();
//     Id_Usuario_L = $('#Id_Usuario_L').val();

//     if (Id_Especialista = Id_Usuario_L && Id_Estado_Cita === '3') {
//         alertify.error("El Evaluador está atendiendo a un paciente. Por favor, esperar un momento.")
//         return;
//     }
// }

function cambiarEstado_Pendiente(idCita_L) {
    alertify.confirm('Cambiar Estado de la Cita', '¿Estás seguro de cambiar el estado En Espera a Pendiente?',
        function () {
            CambiarEstadoPendiente(idCita_L),
                setTimeout(function () {
                    window.location.reload();
                }, 400);
        }
        , function () { alertify.error('No se actualizó el estado de la cita.') });
}

function CambiarEstadoPendiente(idCita_L) {
    cadena = "idCita_L=" + idCita_L;

    $.ajax({
        type: 'POST',
        url: '../C_Cita/C_estado_pendiente_cita.php',
        data: cadena,
        success: function (respuesta) {
            if (respuesta == 1) {
                $('#tablaCitas').load('../V_Cita/V_gestion_cita.php');
                alertify.success("Se actualizó el estado de la cita");
            } else {
                alertify.error("Fallo al cambiar el estado de la cita.");
            }
        }
    });
}


