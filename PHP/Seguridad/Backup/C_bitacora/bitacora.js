$('#deleteButton').click(function(e) {
    e.preventDefault(); // Evita que el botón envíe el formulario automáticamente

    var fechaDesde = $('#min').val();
    var fechaHasta = $('#max').val();

    // Validar que ambas fechas están ingresadas
    if (!fechaDesde || !fechaHasta) {
        Swal.fire({
            title: 'Error',
            text: 'Por favor, ingrese ambas fechas.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return; // Salir de la función si no se han ingresado las fechas
    }

    // Convertir las fechas a objetos Date para compararlas
    var dateDesde = new Date(fechaDesde);
    var dateHasta = new Date(fechaHasta);
    var fechaActual = new Date();

    // Validar que la fechaDesde no sea mayor que fechaHasta
    if (dateDesde > dateHasta) {
        Swal.fire({
            title: 'Error',
            text: 'La fecha de inicio no puede ser mayor que la fecha de fin.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return; // Salir de la función si la validación falla
    }

    // Validar que la fechaHasta no sea mayor que la fecha actual
    if (dateHasta > fechaActual) {
        Swal.fire({
            title: 'Error',
            text: 'La fecha de fin no puede ser mayor que la fecha actual.',
            icon: 'error',
            confirmButtonText: 'Aceptar'
        });
        return; // Salir de la función si la validación falla
    }

    // Verificar registros en el rango de fechas
    $.ajax({
        url: '../C_bitacora/C_eliminar_bitacora.php',
        type: 'POST',
        data: {
            min: fechaDesde,
            max: fechaHasta
        },
        success: function(response) {
            var data = JSON.parse(response);
            if (data.success) {
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Una vez eliminados, no podrás recuperar estos registros.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Realizar la eliminación
                        $.ajax({
                            url: '../C_bitacora/C_eliminar_bitacora.php',
                            type: 'POST',
                            data: {
                                min: fechaDesde,
                                max: fechaHasta,
                                action: 'delete' // Indicar que se debe realizar la eliminación
                            },
                            success: function(response) {
                                var deleteData = JSON.parse(response);
                                if (deleteData.success) {
                                    Swal.fire(
                                        'Eliminado!',
                                        deleteData.message,
                                        'success'
                                    ).then(() => {
                                        // Agregar un retraso antes de recargar la página
                                        setTimeout(function() {
                                            location.reload(); // Recargar la página para reflejar los cambios
                                        }, 1000); // 2000 milisegundos = 2 segundos
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        deleteData.message,
                                        'error'
                                    );
                                }
                            },
                            
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'No se pudo eliminar los datos.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            } else {
                Swal.fire({
                    title: 'No hay registros',
                    text: data.message,
                    icon: 'info',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function() {
            Swal.fire(
                'Error!',
                'No se pudo verificar los datos.',
                'error'
            );
        }
    });
});
