$(document).ready(function () {
    $('#filtro').click(function () {
        var start_date = $('#star').val();
        var end_date = $('#fin').val();
        var cadena = "start_date=" + start_date +
            "&end_date=" + end_date;
            $('#tablaAgenda').DataTable().destroy();
        $.ajax({
            url: '../Controladores/Filtro_Bitacora.php',
            type: 'post',
            data: cadena,
            dataType: 'json',
            success: function (response) {
                $('#tablaAgenda tbody').empty();
                if (response.length === 0) {
                    alert("No se encontraron resultados");
                } else {
                    $.each(response, function (index, item) {
                        var newRow = "<tr>" +
                            "<td>" + item.Id_Bitacora + "</td>" +
                            "<td>" + item.Usuario + "</td>" +
                            "<td>" + item.Accion + "</td>" +
                            "<td>" + item.Fecha + "</td>" +
                            "<td>" + item.Descripcion + "</td>" +
                            "<td>" + item.Objeto + "</td>" +
                            "</tr>";
                        $('#tablaAgenda tbody').append(newRow);
                    });
                  
                    inicializarTable();
                  
                }
            }
        });
    });
});


