<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
$conexion = mysqli_connect("localhost", "root","", "clinica_red"); 

$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];


$query = "SELECT b.Id_Bitacora, b.Fecha, u.Id_Usuario AS Usuario, b.Accion, b.Descripcion
FROM tbl_bitacora b
INNER JOIN tbl_ms_usuario u ON b.Id_Usuario = u.Id_Usuario
          WHERE DATE (b.Fecha) BETWEEN '$start_date' AND '$end_date' ORDER BY b.fecha DESC";

if (strtotime($end_date) < strtotime($start_date)) {
    echo json_encode(array("error" => "La fecha final no puede ser anterior a la fecha inicial"));
    exit();
}
if ($result = mysqli_query($conexion, $query)) {
    $data = array();
  
    while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
    }
    if (strtotime($end_date) < strtotime($start_date)) {
        echo json_encode(array("error" => "La fecha final no puede ser anterior a la fecha inicial"));
        exit();
    }
    mysqli_free_result($result);
  
    // Codificar el array $data en JSONf
    $json_data = json_encode($data);
  
    // Enviar el JSON
    echo $json_data;
 }
  
  mysqli_close($conexion);
  
  ?>