
$(document).ready(function() {
    // ... (resto del código de la tabla)

    $('#deleteButton').click(function() {
        // Obtener los valores de las fechas
        var min = $('#min').val();
        var max = $('#max').val();

        // Confirmar la eliminación
        if (confirm('¿Estás seguro de que deseas eliminar los registros entre ' + min + ' y ' + max + '?')) {
            $.ajax({
                url: '../Vistas/Eliminar_bitacora.php', // Archivo PHP para procesar la eliminación
                type: 'POST',
                data: { min: min, max: max },
                success: function(response) {
                    // Actualizar la tabla después de la eliminación
                    table.ajax.reload();
                    alert(response); // Mostrar un mensaje de éxito o error
                },
                error: function(xhr, status, error) {
                    alert('Error al eliminar los registros: ' + error);
                }
            });
        }
    });
});
