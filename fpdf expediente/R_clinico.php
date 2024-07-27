<?php
session_start();

if (isset($_POST['id_Cita_Terapia']) && isset($_POST['Detalle_Expediente'])) {
    // Acceder a las variables de sesión
    $id_cita = $_POST['id_Cita_Terapia'];
    $Id_Detalle_Expediente = $_POST['Detalle_Expediente'];

    // Ahora puedes usar $id_expediente y $id_paciente según lo necesites
   //  echo "ID de cita: $id_cita <br>";
   //  echo "ID Detalle Expediente: $Id_Detalle_Expediente <br>";

    // También puedes realizar cualquier otra lógica que necesites con estas variables
} else {
    // Si las variables de sesión no existen, puedes redirigir o mostrar un mensaje de error
    echo "Las variables de sesión no están disponibles.";
}
?>
<?php
include '../PHP/Controladores/Conexion/Conexion_be.php';
require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      //include '../../recursos/Recurso_conexion_bd.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      $this->Image('logo3.jpeg', 175, 7, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('CLINICA RED'), 0, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* FECHA */
      date_default_timezone_set('America/Mexico_City'); // Establece la zona horaria a México
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(96, 10, utf8_decode("Fecha: " . date('d/m/Y')), 0, 0, '', 0);
      $this->Ln(5);

      /* HORA */
      $this->Cell(10);  // mover a la derecha
      $this->SetFont('Arial', 'B', 10);
      $this->Cell(59, 10, utf8_decode("Hora: " . date('H:i:s')), 0, 0, '', 0);
      $this->Ln(5);


      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0,133,220);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("EXPEDIENTE CLÍNICO"), 0, 1, 'C', 0);
      $this->Ln(0);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)
      $this->SetY(-25); // Posición: a 1,5 cm del final
      $this->Cell(0, 10, utf8_decode('Río de Piedras, 20 Ave, 1-2 calle, 3 cuadras arriba de la fuente luminosa detrás de Tacontento'),0,0, 'C' ); //pie de pagina(numero de pagina)
      $this->SetY(-20); // Posición: a 1,5 cm del final
      $this->Cell(0, 10, utf8_decode('Tel. 9631-8142'),0,0, 'C' ); //pie de pagina(numero de pagina)
   
   }
}

$pdf = new PDF();
$pdf->AddPage("portrait"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
// $i = $i + 1;

$sql =  mysqli_query($conexion,"SELECT
P.Nombre AS PACIENTE,
P.Numero_Documento,
TIMESTAMPDIFF(
    YEAR,
    P.FechaNacimiento,
    CURDATE()) AS Edad,
    P.Direccion,
    P.Ocupacion,
    US.Nombre AS EVALUADOR,
    CT.Descripcion_Cita,
    GEN.Descripcion AS GENERO,
    DEX.Lateralidad,
    DEX.Referido,
    DATE(DEX.Fecha_Evaluacion) AS FECHA
FROM
    tbl_paciente AS P
INNER JOIN tbl_expediente AS E
ON
    P.Id_Paciente = E.Id_Paciente
INNER JOIN tbl_cita_terapeutica AS CT
ON
    P.Id_Paciente = CT.Id_Paciente
INNER JOIN tbl_detalle_expediente AS DEX
ON
    CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_ms_usuario AS US
ON
    CT.Id_Especialista = US.Id_Usuario
INNER JOIN tbl_genero AS GEN
ON
    P.IdGenero = GEN.IdGenero
WHERE
CT.id_Cita_Terapia = $id_cita and DEX.Id_Detalle_Expediente = $Id_Detalle_Expediente");
$fila = mysqli_fetch_assoc($sql);
$nombre = mysqli_fetch_assoc($sql);

///Historial Clinico
$sqlclinico="SELECT DEX.Id_Detalle_Expediente, EVA.Descripcion, REV.Descripcion, REX.Resultado FROM tbl_cita_terapeutica AS CT 
INNER JOIN tbl_detalle_expediente AS DEX ON CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_resultado_expediente AS REX ON DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
INNER JOIN tbl_resultado_evaluacion AS REV ON REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
INNER JOIN tbl_evaluacion AS EVA ON REV.Id_Evaluacion = EVA.Id_Evaluacion
WHERE CT.id_Cita_Terapia = $id_cita AND EVA.Id_Evaluacion = 1 and DEX.Id_Detalle_Expediente = $Id_Detalle_Expediente";
$clinico = mysqli_query($conexion, $sqlclinico);

////Examen Fisico
$sql1="SELECT DEX.Id_Detalle_Expediente, EVA.Descripcion, REV.Descripcion, REX.Resultado FROM tbl_cita_terapeutica AS CT 
INNER JOIN tbl_detalle_expediente AS DEX ON CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_resultado_expediente AS REX ON DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
INNER JOIN tbl_resultado_evaluacion AS REV ON REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
INNER JOIN tbl_evaluacion AS EVA ON REV.Id_Evaluacion = EVA.Id_Evaluacion
WHERE CT.id_Cita_Terapia = $id_cita AND EVA.Id_Evaluacion = 2 and DEX.Id_Detalle_Expediente = $Id_Detalle_Expediente";
$resultado = mysqli_query($conexion, $sql1);

///Diagnostico
$sqldiagnostico="SELECT DEX.Id_Detalle_Expediente, EVA.Descripcion, REV.Descripcion, REX.Resultado FROM tbl_cita_terapeutica AS CT 
INNER JOIN tbl_detalle_expediente AS DEX ON CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_resultado_expediente AS REX ON DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
INNER JOIN tbl_resultado_evaluacion AS REV ON REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
INNER JOIN tbl_evaluacion AS EVA ON REV.Id_Evaluacion = EVA.Id_Evaluacion
WHERE CT.id_Cita_Terapia = $id_cita AND EVA.Id_Evaluacion = 3 and DEX.Id_Detalle_Expediente = $Id_Detalle_Expediente";
$diagnostico = mysqli_query($conexion, $sqldiagnostico);


$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(135, 206, 235);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(191, 5, "INFORMACION DEL PACIENTE", 0, 1, 'C', 1);
$pdf->Ln(2);

$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(90, 5, utf8_decode('PACIENTE'), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode('DIRECCIÓN'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['PACIENTE']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($fila['Direccion']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'ID', 0, 0, 'L');
$pdf->Cell(50, 5, 'EDAD', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['Numero_Documento']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($fila['Edad']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'GENERO', 0, 0, 'L');
$pdf->Cell(50, 5, 'OCUPACION', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['GENERO']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($fila['Ocupacion']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'EVALUADOR', 0, 0, 'L');
// $pdf->Cell(50, 5, 'REFERIDO', 0, 1, 'L');
$pdf->Cell(50, 5, 'FECHA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['EVALUADOR']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($fila['FECHA']), 0, 1, 'L');
// $pdf->Cell(56, 5, utf8_decode($fila['']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
// $pdf->Cell(90, 5, 'LATERALIDAD', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
// $pdf->Cell(90, 5, utf8_decode($fila['']), 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'MOTIVO DE CONSULTA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['Descripcion_Cita']), 0, 0, 'L');

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(135, 206, 235);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(191, 5, utf8_decode ("HISTORIAL CLÍNICO"), 0, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(2);



///Historial Clinico
while ($fila2 = mysqli_fetch_assoc($clinico)) {
   // Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
$pdf->SetFont('Arial', 'B', 10);

// Imprimir la Descripción en negrita
$pdf->Cell(20, 5, utf8_decode($fila2['Descripcion']. ': '), 0, 0, 'L');
// Restablecer la fuente a la normal
$pdf->SetFont('Arial', '', 10);

// Imprimir el Resultado sin negrita
$pdf->Cell(90, 5, utf8_decode($fila2['Resultado']), 0, 1, 'L');
$pdf->Ln(3);

}
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(191, 5, utf8_decode("EXAMEN FÍSICO "), 0, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(2);

//Examen Fisico
while ($fila = mysqli_fetch_assoc($resultado)) {
   // Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
$pdf->SetFont('Arial', 'B', 10);

// Imprimir la Descripción en negrita
$pdf->Cell(15, 5, utf8_decode($fila['Descripcion']. ': '), 0, 0, 'L');
// Restablecer la fuente a la normal

$pdf->SetTextColor(0,0,0); // Establecer color de texto blanco
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(100, 5, utf8_decode($fila['Resultado']), 0, 'L', 0); // Se eliminó el último parámetro ya que es el valor predeterminado

$pdf->Ln(3);
$pdf->SetTextColor(0, 0, 0);

}
//Diagnostico
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(191, 5, utf8_decode("DIAGNÓSTICO "), 0, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(2);

while ($fila3 = mysqli_fetch_assoc($diagnostico)) {
   // Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
$pdf->SetFont('Arial', 'B', 10);

// Imprimir la Descripción en negrita
$pdf->Cell(20, 5, utf8_decode($fila3['Descripcion']. ': '), 0, 0, 'L');
// Restablecer la fuente a la normal
$pdf-> Ln(5);
$pdf->SetFont('Arial', '', 10);
// Imprimir el Resultado sin negrita
$pdf->Cell(90, 5, utf8_decode($fila3['Resultado']), 0, 1, 'L');
}

if (isset($nombre) && isset($nombre['PACIENTE'])) {
    $nombre_archivo_pdf = 'Expediente Clinico ' . $nombre['PACIENTE'] . '.pdf';
} else {
    $nombre_archivo_pdf = 'Expediente Clinico.pdf';
}

$pdf->Output($nombre_archivo_pdf, 'I');
?>