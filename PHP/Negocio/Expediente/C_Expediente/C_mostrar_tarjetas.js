var tarjetasMostradas = [];
// Definir una variable para almacenar el ID del tratamiento actual
var tratamientoActual = "";

// Función para eliminar un tratamiento del array tarjetasMostradas
function eliminarTratamiento(tratamiento) {
  var index = tarjetasMostradas.indexOf(tratamiento);
  if (index !== -1) {
    tarjetasMostradas.splice(index, 1); // Eliminar el tratamiento de la lista
    console.log("Tratamiento eliminado:", tratamiento);
    console.log("Tratamientos restantes:", tarjetasMostradas);
  }
}

// Definir una función para llamar a ExpedienteTerapeutico después de mostrar las tarjetas
function mostrarTarjetasYExpedienteTerapeutico(selectedValue) {
  // Verificar si el tratamiento seleccionado ya ha sido mostrado
  if (tarjetasMostradas.includes(selectedValue)) {
    // Resto del código para mostrar el mensaje y retornar
    Swal.fire("Ya has seleccionado este tratamiento");
    return;
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var tarjetasHTML = this.responseText;

      // Determinar en qué columna agregar las tarjetas alternadamente
      var columnaActual = document.getElementById("contenedor-tarjetas-columna1");
      var tarjetasColumna1 = document.querySelectorAll("#contenedor-tarjetas-columna1 .card").length;
      var tarjetasColumna2 = document.querySelectorAll("#contenedor-tarjetas-columna2 .card").length;

      if (tarjetasColumna2 < tarjetasColumna1) {
        columnaActual = document.getElementById("contenedor-tarjetas-columna2");
      }

      var nuevaTarjeta = document.createElement("div");
      // nuevaTarjeta.classList.add("card");
      nuevaTarjeta.dataset.tratamiento = selectedValue; // Asignar el tratamiento como un atributo de datos
      nuevaTarjeta.innerHTML = tarjetasHTML;

      columnaActual.appendChild(nuevaTarjeta);

      var tarjetasMostradasEvent = new CustomEvent('tarjetasMostradas', { detail: selectedValue });
      document.dispatchEvent(tarjetasMostradasEvent);

      // Agregar evento de clic a las nuevas tarjetas
      // nuevaTarjeta.addEventListener('click', function() {
      //   var tratamiento = this.dataset.tratamiento; // Recuperar el tratamiento asociado a la tarjeta
      //   eliminarTratamiento(tratamiento); // Eliminar el tratamiento del array tarjetasMostradas
      //   this.remove(); // Eliminar la tarjeta del DOM
      // });
      var closeButton = nuevaTarjeta.querySelector('.icono-x-circle');
      closeButton.addEventListener('click', function() {
        var tratamiento = nuevaTarjeta.dataset.tratamiento;
        eliminarTratamiento(tratamiento);
        nuevaTarjeta.remove();
      });

      // Agregar el tratamiento actual a la lista de tratamientos mostrados
      tarjetasMostradas.push(selectedValue);
      console.log(tarjetasMostradas);
    }
  };

  xhttp.open("POST", "../V_Expediente/V_tarjetas_expediente_terapeutico.php?tratamiento=" + selectedValue, true);
  xhttp.send();
}

// Manejar el evento de cambio en el combobox de tratamientos
document.getElementById("tratamiento").addEventListener("change", function() {
  var selectedValue = this.value;

  if (selectedValue != "0") {
    // Verificar si el tratamiento actual es diferente al seleccionado
    if (selectedValue != tratamientoActual) {
      mostrarTarjetasYExpedienteTerapeutico(selectedValue);
      tratamientoActual = selectedValue; // Actualizar la variable del tratamiento actual
      this.value = "0";
    } else {
      // Si el tratamiento ya ha sido mostrado, limpiar el tratamiento actual
      tratamientoActual = "";
    }
  }
});

// Función para enviar el valor de Id_Cita al controlador PHP
function enviarIdCita(idCita) {
  // Crear un objeto FormData para enviar datos al servidor
  var formData = new FormData();

  // Agregar el valor de Id_Cita al formData
  formData.append('Id_Cita', idCita);

  // Realizar una solicitud AJAX para enviar los datos al controlador PHP
  var xhr = new XMLHttpRequest();
  xhr.open('POST', '../../Procesos/C_procesos/C_estado_finalizado_cita_F.php');
  xhr.onload = function () {
      if (xhr.status === 200) {
          // Manejar la respuesta del servidor si es necesario
          console.log(xhr.responseText);
      } else {
          // Manejar errores si ocurren
          console.error('Error al enviar datos al servidor');
      }
  };
  xhr.send(formData);
  }

// Función para recopilar y enviar los datos al servidor
function guardarDatos() {
    var datosTarjetas = {}; // Objeto para almacenar los datos de las tarjetas

    // Recorrer todas las tarjetas y recopilar los datos
    var tarjetas = document.querySelectorAll('.formulario__input');
    tarjetas.forEach(function(tarjeta) {
        var id = tarjeta.id;
        var valor = tarjeta.value.trim(); // Obtener el valor del campo y eliminar espacios en blanco
        // Verificar si el input no tiene el atributo 'readonly'
        if (!tarjeta.hasAttribute('readonly') && valor !== '') { // Verificar si el campo tiene datos y no es de solo lectura
            datosTarjetas[id] = valor; // Agregar los datos al objeto
        }
    });

    // Verificar si hay datos para enviar al servidor
    if (Object.keys(datosTarjetas).length === 0) {
        // Si no hay datos para guardar, mostrar alerta de SweetAlert2
        Swal.fire({
            title: 'Atención',
            text: 'No hay datos para guardar.',
            icon: 'warning', // Ícono de advertencia
            confirmButtonText: 'Aceptar' // Texto del botón de confirmación
        });
    } else {
        // Si hay datos para guardar, mostrar alerta de confirmación de SweetAlert2
        Swal.fire({
            title: 'Confirmación',
            text: '¿Estás seguro que deseas guardar los datos?',
            icon: 'question', // Ícono de pregunta
            showCancelButton: true, // Mostrar botón de cancelación
            confirmButtonText: 'Guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
              var idCita = document.getElementById('Id_Cita').value;
                
              // Enviar el valor de Id_Cita al controlador PHP
              enviarIdCita(idCita);
                // Si el usuario confirma, enviar los datos al servidor
                var datosJSON = JSON.stringify(datosTarjetas);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../C_Expediente/C_procesar_tarjeta.php', true);
                xhr.setRequestHeader('Content-Type', 'application/json'); // Especificar el tipo de contenido como JSON
                xhr.onload = function() {
                    // Manejar la respuesta del servidor aquí si es necesario
                    console.log(xhr.responseText);
                    
                    // Mostrar alerta de éxito después de guardar los datos
                    Swal.fire({
                        title: 'Éxito',
                        text: 'Los datos se han guardado correctamente.',
                        icon: 'success',
                        timer: 2000, // Cerrar automáticamente después de 2 segundos
                        showConfirmButton: false // Ocultar botón de confirmación
                    }).then(() => {
                        // Redirigir al usuario a una nueva página después de guardar los datos
                        window.location.href = '/PHP/Vistas/Main.php';
                    });
                };
                xhr.send(datosJSON);
            }
        });
    }
}

// Seleccionar el botón de guardar por su ID
var botonGuardar = document.getElementById('guardarDatos');

// Agregar el evento 'click' al botón de guardar
botonGuardar.addEventListener('click', function(event) {
    // Prevenir el comportamiento predeterminado del formulario (si el botón está dentro de un formulario)
    event.preventDefault();
    
    // Llamar a la función 'guardarDatos' cuando se haga clic en el botón
    guardarDatos();
});


  