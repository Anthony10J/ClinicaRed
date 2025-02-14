<?php
// Verificar si la sesión ya está activa
if (session_status() === PHP_SESSION_ACTIVE) {
    // La sesión ya está iniciada, no necesitas iniciarla nuevamente
} else {
    // La sesión aún no está iniciada, entonces la inicias
    session_start();
}
$conexion = mysqli_connect("localhost", "u452119581_RED","T3chTit4n$2024", "u452119581_clinica_red"); 

$start_date = date("Y-m-d", strtotime($_POST['start_date']));
$end_date =  date("Y-m-d", strtotime($_POST['end_date']));


// Verificar que la fecha final no sea anterior a la fecha inicial
if (strtotime($end_date) < strtotime($start_date)) {
    echo json_encode(array("error" => "La fecha final no puede ser anterior a la fecha inicial"));
    exit();
}

$query = "SELECT b.Id_Bitacora, b.Fecha, u.Id_Usuario AS Usuario, b.Accion, b.Descripcion, b.Id_Objeto
FROM tbl_bitacora b
INNER JOIN tbl_ms_usuario u ON b.Id_Usuario = u.Id_Usuario
INNER JOIN tbl_ms_objetos o ON b.Id_Objeto = o.Id_Objetos
WHERE DATE (b.Fecha) BETWEEN '$start_date' AND '$end_date' 
ORDER BY b.fecha DESC";

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