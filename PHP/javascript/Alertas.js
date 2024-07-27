var eliminarBtn = document.getElementById('eliminarBtn');
eliminarBtn.addEventListener('click', confirmarEliminar);

function confirmarEliminar() {
    Swal.fire({
        title: "Eliminar Paciente",
        text: "Estas seguro que deseas eliminar el Paciente?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                
                title: "Exito",
                text: "Registro Inactivo",
                icon: "success"

                 // Ocultar la fila de usuario de la tabla
                 // Ocultar la fila de paciente de la tabla
            });
           setTimeout(function() {
                window.location = "../Negocio/Paciente/V_Paciente/V_Paciente.php";
            }, 2000);
        }
    });
}

