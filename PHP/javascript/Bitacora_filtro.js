$(document).ready(function () {
    function inicializarTable() {
        $('#tablaAgenda').DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            dom: 'lBfrtip',
            paging: true,
            buttons: [{
                extend: 'excelHtml5',
                text: '<button id="" class="fas fa-file-excel"> Excel </button>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                    modifier: {
                        page: 'current'
                    }
                }
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                text: '<i class="fas fa-file-pdf"> PDF </i>',
                orientation: 'portrait',
                customize: function (doc) {
                    // Título y fecha/hora
                    doc.content.unshift({
                        text: 'Reporte de Bitácora',
                        fontSize: 15,
                        alignment: 'center',
                        margin: [0, 20, 0, 10]
                    });
                    var now = new Date();
                    doc.content.unshift({
                        text: 'Fecha: ' + now.toLocaleDateString() + ' Hora: ' + now.toLocaleTimeString(),
                        alignment: 'left',
                        margin: [0, 0, 0, 20]
                    });

                    // Footer
                    doc['footer'] = function (currentPage, pageCount) {
                        return {
                            margin: [10, 0],
                            columns: [{
                                fontSize: 10,
                                text: 'Página ' + currentPage.toString() + ' de ' + pageCount,
                                alignment: 'center',
                                bold: true
                            }]
                        };
                    };
                },
                exportOptions: {
                    columns: [0, 1, 2, 3, 4],
                    modifier: {
                        page: 'current'
                    },
                    orthogonal: 'export',
                    filter: 'applied'
                }
            }],
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "Todos"]
            ],
            "columnDefs": [{
                "targets": 0,
                "data": null,
                "defaultContent": "",
                "title": "N°",
                "render": function (data, type, row, meta) {
                    return meta.row + 1;
                }
            }]
        });
    }

    $('#filtro').click(function () {
        var start_date = $('#star').val();
        var end_date = $('#fin').val();
        var cadena = "start_date=" + start_date +
            "&end_date=" + end_date;

        // Destruir la tabla actual
        $('#tablaAgenda').DataTable().destroy();

        // Hacer la llamada AJAX
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

                    // Re-inicializar la tabla
                    inicializarTable();
                }
            }
        });
    });

    // Inicializa la tabla al cargar la página
    inicializarTable();
});



