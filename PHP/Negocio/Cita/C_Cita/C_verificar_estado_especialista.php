<?php
include('../../../Controladores/Conexion/Conexion_be.php'); // Asegúrate de incluir el archivo de conexión a la base de datos

if (isset($_POST['Id_Especialista'])) {
    $Id_Especialista = $_POST['Id_Especialista'];
    
    // Consulta para verificar si el especialista tiene alguna cita en estado 3 o 2
    $query = "SELECT Id_Estado_Cita FROM tbl_cita_terapeutica WHERE Id_Especialista = '$Id_Especialista' AND (Id_Estado_Cita = '3' OR Id_Estado_Cita = '2')";
    $result = mysqli_query($conexion, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['Id_Estado_Cita'] == '3') {
            echo "3"; // El especialista está atendiendo a un paciente
        } else if ($row['Id_Estado_Cita'] == '2') {
            echo "2"; // El especialista ya tiene una cita en espera
        }
    } else {
        echo "1"; // El especialista no está atendiendo a un paciente ni tiene una cita en espera
    }
}
?>
