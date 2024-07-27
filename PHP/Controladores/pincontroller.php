<?php
include 'Conexion_be.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $pin = $_POST["pin"];
    $pinvalidado = $_POST["pinvalidado"];

     // Verificar si los pines coinciden
     if ($pin == $pinvalidado) {
        // Verificar si el PIN tiene al menos 5 caracteres
        if (strlen($pin) >= 5) {
            // Continuar con la inserción del pin en la base de datos
            $query = "INSERT INTO tbl_pin(Pin, Fecha_Creacion)
                      VALUES ('$pin', NOW())";
            $resultado_query = mysqli_query($conexion, $query);
            if ($resultado_query) {
                echo '
                    <script>
                        alert("PIN almacenado correctamente.")
                        window.location = "../Vistas/Pin.php";
                    </script>
                ';
            } else {
                echo '
                    <script>
                        alert("Inténtalo de nuevo, PIN no almacenado.")
                        window.location = "../Vistas/Pin.php";
                    </script>
                ';   
            }
        } else {
            echo '
                <script>
                    alert("El PIN debe tener al menos 5 caracteres.")
                    window.location = "../Vistas/Pin.php";
                </script>
            ';
        }
    } else {
        echo '
            <script>
                alert("Los pines no coinciden.")
                window.location = "../Vistas/Pin.php";
            </script>
        ';
    }
}

mysqli_close($conexion);
?>