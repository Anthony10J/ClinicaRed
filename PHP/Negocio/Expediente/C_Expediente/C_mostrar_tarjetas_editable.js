var tarjetasMostradas = [];
var tratamientoActual = "";

// Función para eliminar un tratamiento del array tarjetasMostradas
function eliminarTratamiento(tratamiento) {
  var index = tarjetasMostradas.indexOf(tratamiento);
  if (index !== -1) {
    tarjetasMostradas.splice(index, 1);
    tratamientoActual = ""; // Actualizar tratamientoActual
    console.log("Tratamiento eliminado:", tratamiento);
    console.log("Tratamientos restantes:", tarjetasMostradas);
  }
}

function mostrarTarjetasYExpedienteTerapeutico(selectedValue) {
  if (tarjetasMostradas.includes(selectedValue)) {
    Swal.fire("Ya has seleccionado este tratamiento");
    return;
  }

  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var tarjetasHTML = this.responseText;

      var columnaActual = document.getElementById("contenedor-tarjetas-columna1");
      var tarjetasColumna1 = document.querySelectorAll("#contenedor-tarjetas-columna1 .card").length;
      var tarjetasColumna2 = document.querySelectorAll("#contenedor-tarjetas-columna2 .card").length;

      if (tarjetasColumna2 < tarjetasColumna1) {
        columnaActual = document.getElementById("contenedor-tarjetas-columna2");
      }

      var nuevaTarjeta = document.createElement("div");
      nuevaTarjeta.dataset.tratamiento = selectedValue;
      nuevaTarjeta.innerHTML = tarjetasHTML;
      columnaActual.appendChild(nuevaTarjeta);

      var tarjetasMostradasEvent = new CustomEvent('tarjetasMostradas', { detail: selectedValue });
      document.dispatchEvent(tarjetasMostradasEvent);

      var closeButton = nuevaTarjeta.querySelector('.icono-x-circle');
      closeButton.addEventListener('click', function() {
        var tratamiento = nuevaTarjeta.dataset.tratamiento;
        eliminarTratamiento(tratamiento);
        nuevaTarjeta.remove();
      });

      tarjetasMostradas.push(selectedValue);
      tratamientoActual = selectedValue; // Actualizar tratamientoActual aquí
      console.log(tarjetasMostradas);
    }
  };

  xhttp.open("POST", "../V_Expediente/V_tarjetas_terapeutico_editable.php?tratamiento=" + selectedValue, true);
  xhttp.send();
}

document.getElementById("tratamiento").addEventListener("change", function() {
  var selectedValue = this.value;

  if (selectedValue != "0") {
    mostrarTarjetasYExpedienteTerapeutico(selectedValue);
    this.value = "0";
  }
});
/////////////////////////////////////

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
                // Si el usuario confirma, enviar los datos al servidor
                var datosJSON = JSON.stringify(datosTarjetas);

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '../C_Expediente/C_procesar_tarjetas_editable.php', true);
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
                        window.location.href = './V_modal_expediente.php';
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


