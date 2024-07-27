
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
      $this->SetTextColor(228, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE EXPEDIENTE CLINICO"), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      // $this->SetFillColor(228, 100, 0); //colorFondo
      // $this->SetTextColor(255, 255, 255); //colorTexto
      // $this->SetDrawColor(163, 163, 163); //colorBorde
      // $this->SetFont('Arial', 'B', 11);
      // $this->Cell(30, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      // $this->Cell(40, 10, utf8_decode('NÚMERO'), 1, 0, 'C', 1);
      // $this->Cell(40, 10, utf8_decode('TIPO'), 1, 0, 'C', 1);
      // $this->Cell(40, 10, utf8_decode('PRECIO'), 1, 0, 'C', 1);
      // $this->Cell(85, 10, utf8_decode('CARACTERÍSTICAS'), 1, 0, 'C', 1);
      // $this->Cell(40, 10, utf8_decode('ESTADO'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      // $this->SetY(-15); // Posición: a 1,5 cm del final
      // $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      // $hoy = date('d/m/Y');
      // $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

//include '../../recursos/Recurso_conexion_bd.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage("portrait"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

/*$consulta_reporte_alquiler = $conexion->query("  ");*/

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
$i = $i + 1;
/* TABLA */
// $pdf->Cell(30, 10, utf8_decode("N°"), 1, 0, 'C', 0);
// $pdf->Cell(40, 10, utf8_decode("numero"), 1, 0, 'C', 0);
// $pdf->Cell(40, 10, utf8_decode("nombre"), 1, 0, 'C', 0);
// $pdf->Cell(40, 10, utf8_decode("precio"), 1, 0, 'C', 0);
// $pdf->Cell(85, 10, utf8_decode("info"), 1, 0, 'C', 0);
// $pdf->Cell(40, 10, utf8_decode("total"), 1, 1, 'C', 0);



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
EVA.Descripcion AS EVALUACION,
REV.Descripcion AS DESC_EVALUACION,
REX.Resultado,
DATE (DEX.Fecha_Evaluacion) AS FECHA
FROM
    tbl_paciente AS P
    -- CLINICO
    inner JOIN tbl_cita_terapeutica AS CT on P.Id_Paciente = CT.Id_Paciente 
    INNER JOIN tbl_expediente AS EX on CT.Id_Expediente = EX.Id_Paciente
    INNER JOIN tbl_ms_usuario AS US on EX.id_Usuario = US.Id_Usuario
    INNER JOIN tbl_detalle_expediente AS DEX on EX.id_Expediente = DEX.Id_Expediente
    INNER JOIN tbl_resultado_expediente AS REX on DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
    INNER JOIN tbl_resultado_evaluacion AS REV on REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
    INNER JOIN tbl_evaluacion AS EVA on REV.Id_Evaluacion = EVA.Id_Evaluacion 
    INNER JOIN tbl_genero AS GEN on P.IdGenero = GEN.IdGenero
    -- TARJETON 
    -- INNER JOIN tbl_detalle_terapia AS DTE on CT.id_Cita_Terapia = DTE.Id_Cita_Terapia
    -- INNER JOIN tbl_detalle_terapia_tratamiento AS DTT on DTE.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
    -- INNER JOIN tbl_tipo_terapia AS TT on DTT.Id_Tipo_Terapia = TT.idTipoTerapia
    -- INNER JOIN tbl_tipo_tratamiento AS TIPOT on TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
    
WHERE
CT.id_Cita_Terapia = 3 and DEX.Id_Detalle_Expediente = 15");
$fila = mysqli_fetch_assoc($sql);

///Historial Clinico
$sqlclinico="SELECT DEX.Id_Detalle_Expediente, EVA.Descripcion, REV.Descripcion, REX.Resultado FROM tbl_cita_terapeutica AS CT 
INNER JOIN tbl_detalle_expediente AS DEX ON CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_resultado_expediente AS REX ON DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
INNER JOIN tbl_resultado_evaluacion AS REV ON REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
INNER JOIN tbl_evaluacion AS EVA ON REV.Id_Evaluacion = EVA.Id_Evaluacion
WHERE CT.id_Cita_Terapia = 3 AND EVA.Id_Evaluacion = 1 and DEX.Id_Detalle_Expediente = 15";
$clinico = mysqli_query($conexion, $sqlclinico);

////Examen Fisico
$sql1="SELECT DEX.Id_Detalle_Expediente, EVA.Descripcion, REV.Descripcion, REX.Resultado FROM tbl_cita_terapeutica AS CT 
INNER JOIN tbl_detalle_expediente AS DEX ON CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_resultado_expediente AS REX ON DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
INNER JOIN tbl_resultado_evaluacion AS REV ON REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
INNER JOIN tbl_evaluacion AS EVA ON REV.Id_Evaluacion = EVA.Id_Evaluacion
WHERE CT.id_Cita_Terapia = 3 AND EVA.Id_Evaluacion = 2 and DEX.Id_Detalle_Expediente = 15";
$resultado = mysqli_query($conexion, $sql1);

///Diagnostico
$sqldiagnostico="SELECT DEX.Id_Detalle_Expediente, EVA.Descripcion, REV.Descripcion, REX.Resultado FROM tbl_cita_terapeutica AS CT 
INNER JOIN tbl_detalle_expediente AS DEX ON CT.id_Cita_Terapia = DEX.Id_Cita_Terapia
INNER JOIN tbl_resultado_expediente AS REX ON DEX.Id_Detalle_Expediente = REX.Id_Detalle_Expediente
INNER JOIN tbl_resultado_evaluacion AS REV ON REX.Id_Resultado_Evaluacion = REV.Id_Resultado_Evaluacion
INNER JOIN tbl_evaluacion AS EVA ON REV.Id_Evaluacion = EVA.Id_Evaluacion
WHERE CT.id_Cita_Terapia = 3 AND EVA.Id_Evaluacion = 3 and DEX.Id_Detalle_Expediente = 15";
$diagnostico = mysqli_query($conexion, $sqldiagnostico);



// $fisico = mysqli_fetch_assoc($exfisico);
// $resultado = mysqli_query($conexion, $sql);
// while ($fila = mysqli_fetch_assoc($resultado)) {
//    $pdf->SetFont('Arial', 'B', 12);
//    $pdf->Cell(0, 10, '', 0, 1); // Título del formulario
//    $pdf->SetFont('Arial', '', 11);

//    // // Agregar cada campo como una línea en el formulario
//    // $pdf->Cell(100, 10, utf8_decode ('PACIENTE: '.$fila['PACIENTE']));
//    // $pdf->Cell(56, 10, utf8_decode ('GÉNERO: '.$fila['GENERO']), 0, 1, 'C');
//    // $pdf->SetFont('Arial', '', 10);
//    // // $pdf->Ln(); 
//    // $pdf->Cell(100, 10,  utf8_decode ('ID: '.$fila['Numero_Documento']));
//    // $pdf->Cell(50, 10,  utf8_decode ('FECHA: '.$fila['FECHA']), 0, 1, 'C');
//    // // $pdf->Ln(); 
//    // $pdf->Cell(106, 10,  utf8_decode ('EDAD: '.$fila['Edad']));
//    // $pdf->Cell(68, 10,  utf8_decode ('LATERALIDAD: '.$fila['']));
//    // // $pdf->Ln(); 
//    // $pdf->Ln();
//    // $pdf->Cell(106, 10,  utf8_decode ('REFERIDO: '.$fila['']));
//    // $pdf->Cell(190, 10,  utf8_decode ('OCUPACIÓN: '.$fila['Ocupacion']));
//    // $pdf->Ln();
//    // $pdf->MultiCell(106, 10,  utf8_decode ('EVALUADOR: '.$fila['EVALUADOR']));
//    // $pdf->MultiCell(100, 10,  utf8_decode ('DIRECCIÓN: '.$fila['Direccion']));
//    // // $pdf->Cell(100, 10, 'Telefono: ', utf8_decode($fila['']);
//    // // $pdf->Ln();
//    // $pdf->MultiCell(100, 10,  utf8_decode ('MOTIVO CONSULTA: '.$fila['Descripcion_Cita']));
//    // $pdf->Ln();

   
//    $pdf->Ln(10); // Salto de línea entre formularios
// }
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "INFORMACION DEL PACIENTE", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(90, 5, utf8_decode('PACIENTE'), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode('Dirección'), 0, 1, 'L');
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
$pdf->Cell(50, 5, 'REFERIDO', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['EVALUADOR']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($fila['']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'LATERALIDAD', 0, 0, 'L');
$pdf->Cell(50, 5, 'FECHA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($fila['FECHA']), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'MOTIVO DE CONSULTA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['Descripcion_Cita']), 0, 0, 'L');

$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "HISTORIAL CLINICO", 1, 1, 'C', 1);
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
$pdf->Cell(196, 5, "EXAMEN FISICO ", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(2);
//Examen Fisico

while ($fila = mysqli_fetch_assoc($resultado)) {
   // Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
$pdf->SetFont('Arial', 'B', 10);

// Imprimir la Descripción en negrita
$pdf->Cell(15, 5, utf8_decode($fila['Descripcion']. ': '), 0, 0, 'L');
// Restablecer la fuente a la normal
$pdf->SetFont('Arial', '', 10);

// Imprimir el Resultado sin negrita
$pdf->Cell(90, 5, utf8_decode($fila['Resultado']), 0, 1, 'L');
$pdf->Ln(3);

}
//Diagnostico
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "DIAGNOSTICO ", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Ln(2);

while ($fila3 = mysqli_fetch_assoc($diagnostico)) {
   // Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
$pdf->SetFont('Arial', 'B', 10);

// Imprimir la Descripción en negrita
$pdf->Cell(20, 5, utf8_decode($fila3['Descripcion']. ': '), 0, 0, 'L');
// Restablecer la fuente a la normal
$pdf->SetFont('Arial', '', 10);
$pdf->Ln(5);
// Imprimir el Resultado sin negrita
$pdf->Cell(90, 5, utf8_decode($fila3['Resultado']), 0, 1, 'L');
}
$pdf->SetY(-15);

// Establece la fuente para el pie de página
$pdf->SetFont('Arial', 'I', 8);

// Agrega el pie de página
$pdf->Cell(0, 10, 'Este es el pie de página', 0, 0, 'C');

$pdf->Ln(3);
$pdf->Output('Expediente.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>