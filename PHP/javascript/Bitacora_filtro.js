$(document).ready(function () {
    $('#filtro').click(function () {
        var start_date = $('#star').val();
        var end_date = $('#fin').val();
        cadena = "start_date=" + start_date +
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
                            "</tr>";
                        $('#tablaAgenda tbody').append(newRow);
                    });
                  
                    inicializarTable();
                }
            }
        });
    });
});


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
                
                        // Calcula la longitud máxima de los datos por columna
                        const maxLengths = [];
                        doc.content.forEach(function(section) {
                            if (section.table) {
                                const tableData = section.table.body;

                                // Inicializa la longitud máxima de cada columna
                                if (maxLengths.length === 0) {
                                    for (let i = 0; i < tableData[0].length; i++) {
                                        maxLengths.push(0);
                                    }
                                }

                                // Calcula la longitud máxima de los datos por columna
                                tableData.forEach(function(row) {
                                    row.forEach(function(cell, index) {
                                        const cellLength = cell.text ? cell.text.length : 0;
                                        if (cellLength > maxLengths[index]) {
                                            maxLengths[index] = cellLength;
                                        }
                                    });
                                });
                            }
                        });

                        // Establece los anchos de las columnas en función de las longitudes máximas
                        doc.content.forEach(function(section) {
                            if (section.table) {
                                const totalLength = maxLengths.reduce((sum, length) => sum + length, 0);
                                const columnWidths = maxLengths.map(length => (length / totalLength) * 100 + '%');

                                // Aplica los anchos calculados a la tabla
                                section.table.widths = columnWidths;
                                section.table.widths = columnWidths;
                                section.table.body.forEach(row => {
                                    row.forEach(cell => {
                                        cell.alignment = 'center';
                                    });
                                });
                            }
                        });
              // Agregar un título al reporte
              var title = 'Reporte de Bitácora';
              // Obtener la fecha y hora actual
              var now = new Date();
              var date = now.getDate() + '/' + (now.getMonth() + 1) + '/' + now.getFullYear();
              var horas = now.getHours() + ':' + now.getMinutes() + ':' + now.getSeconds();
              // Agregar el título y la fecha/hora al PDF

              doc.content.splice(1, 0, {
                  text: title,
                  fontSize: 15,
                  alignment: 'center'
              });
              doc.content.splice(2, 0, {
                  text: 'Fecha: ' + date + '\nHora: ' + horas,
                  alignment: 'left',
                  margin: [0, 1, 0, 0], // [left, top, right, bottom]
              });

              doc["footer"] = function (currentPage, pageCount) {
                  return {
                      margin: 10,
                      columns: [{
                          fontSize: 10,
                          text: [{
                              text: "Página " +
                                  currentPage.toString() +
                                  " de " +
                                  pageCount,
                              alignment: "center",
                              bold: true
                          },],
                          alignment: "center",
                      },],
                  };
              };
          },
            
            exportOptions: {
                columns: [0, 1, 2, 3, 4],
                modifier: {
                    page: 'current'
                },
                // Obtener los datos filtrados al momento de generar el PDF
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
