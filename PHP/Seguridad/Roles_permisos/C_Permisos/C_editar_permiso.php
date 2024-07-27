<?php
// Incluir el archivo de conexión a la base de datos
include '../../../Controladores/Conexion/Conexion_be.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si los datos del formulario están presentes
    if (isset($_POST["permisos"])) {
        $permisos = $_POST["permisos"];

        // Recorrer los permisos y actualizar la base de datos
        foreach ($permisos as $rol => $objetos) {
            foreach ($objetos as $objeto => $acciones) {
                $agregar = $acciones["agregar"] == "1" ? 1 : 0;
                $eliminar = $acciones["eliminar"] == "1" ? 1 : 0;
                $actualizar = $acciones["actualizar"] == "1" ? 1 : 0;
                $consultar = $acciones["consultar"] == "1" ? 1 : 0;
                $reportes = $acciones["reportes"] == "1" ? 1 : 0;

                // Actualizar los permisos en la base de datos
                $sql = "UPDATE tbl_ms_permisos SET 
                        Permiso_Insercion = $agregar,
                        Permiso_Eliminacion = $eliminar,
                        Permiso_Actualizacion = $actualizar,
                        Permiso_Consultar = $consultar,
                        Permiso_Reportes = $reportes
                        WHERE Id_Rol = (SELECT Id_Rol FROM tbl_ms_roles WHERE Rol = '$rol')
                        AND Id_Objeto = (SELECT Id_Objetos FROM tbl_ms_objetos WHERE Objeto = '$objeto')";

                if (mysqli_query($conexion, $sql)) {
                     // Redirigir a una página de éxito
                     header("Location: ../permisos/V_permisos.php");
                } else {
                    echo "Error al actualizar los permisos: " . mysqli_error($conexion);
                }
            }
        }
    } else {
        echo "No se recibieron datos del formulario.";
    }
} else {
    echo "Acceso no permitido.";
}
?>
