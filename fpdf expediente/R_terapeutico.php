<?php
session_start();

if (isset($_POST['id_Cita_Terapia']) && isset($_POST['Detalle_Terapia'])) {
    // Acceder a las variables de sesión
    $id_cita = $_POST['id_Cita_Terapia'];
    $Id_Detalle_Terapia = $_POST['Detalle_Terapia'];

    // Ahora puedes usar $id_Tera$Id_Detalle_Terapia y $id_paciente según lo necesites
    // echo "ID de cita: $id_cita <br>";
    // echo "ID Detalle Terapia: $Id_Detalle_Terapia <br>";

    // También puedes realizar cualquier otra lógica que necesites con estas variables
} else {
    // Si las variables de sesión no existen, puedes redirigir o mostrar un mensaje de error
    // echo "Las variables de sesión no están disponibles.";
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
      $this->Cell(100, 10, utf8_decode("EXPEDIENTE TERAPEUTICO"), 0, 1, 'C', 0);
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

// $consulta_reporte_alquiler = $conexion->query("  ");

/*while ($datos_reporte = $consulta_reporte_alquiler->fetch_object()) {      
   }*/
$i = $i + 1;

$sql =  mysqli_query($conexion,"SELECT P.Nombre AS PACIENTE, TIMESTAMPDIFF(
   YEAR,
   P.FechaNacimiento,
   CURDATE()) AS Edad, CT.Descripcion_Cita, U.Nombre AS EVALUADOR, DATE(DT.Fecha_Terapia) AS FECHA_TERAPIA, DT.Numero_Sesiones
   FROM tbl_paciente AS P
  INNER JOIN tbl_cita_terapeutica AS CT ON P.Id_Paciente = CT.Id_Paciente
   INNER JOIN tbl_ms_usuario AS U ON CT.Id_Especialista = U.Id_Usuario
   INNER JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia
   WHERE CT.id_Cita_Terapia = $id_cita");
$fila = mysqli_fetch_assoc($sql);

//----------------------------------------------------------------------------------------------------------//
//                                              MEDIOS FISICOS                                             //
//--------------------------------------------------------------------------------------------------------//
$sqlfisicos="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 2 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$fisico = mysqli_query($conexion, $sqlfisicos);

//----------------------------------------------------------------------------------------------------------//
//                                              MASOTERAPIA                                                //
//--------------------------------------------------------------------------------------------------------//
$sqlmasoterapia="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 3 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$masoterapia = mysqli_query($conexion, $sqlmasoterapia);

//----------------------------------------------------------------------------------------------------------//
//                                              ELECTROTERAPIA                                             //
//--------------------------------------------------------------------------------------------------------//
$sqlelectro="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 4 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$electroterapia = mysqli_query($conexion, $sqlelectro);

//----------------------------------------------------------------------------------------------------------//
//                                              ULTRASONIDO                                                //
//--------------------------------------------------------------------------------------------------------//
$sqlultrasonido="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 5 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$ultrasonido = mysqli_query($conexion, $sqlultrasonido);

//----------------------------------------------------------------------------------------------------------//
//                                              LASER                                                //
//--------------------------------------------------------------------------------------------------------//
$sqllaser="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 6 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$laser = mysqli_query($conexion, $sqllaser);

//----------------------------------------------------------------------------------------------------------//
//                                              MAGNOTERAPIA                                               //
//--------------------------------------------------------------------------------------------------------//
$sqlmagno="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 1 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$magnoterapia = mysqli_query($conexion, $sqlmagno);

//----------------------------------------------------------------------------------------------------------//
//                                              MOVILIDAD ARTICULAR                                        //
//--------------------------------------------------------------------------------------------------------//
$sqlmovilidad="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 7 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$movilidad = mysqli_query($conexion, $sqlmovilidad);

//----------------------------------------------------------------------------------------------------------//
//                                              TRACCION                                                   //
//--------------------------------------------------------------------------------------------------------//
$sqltraccion="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 8 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$traccion = mysqli_query($conexion, $sqltraccion);

//----------------------------------------------------------------------------------------------------------//
//                                              PRESOTERAPIA                                               //
//--------------------------------------------------------------------------------------------------------//
$sqlpreso="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 10 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$presoterapia = mysqli_query($conexion, $sqlpreso);

//----------------------------------------------------------------------------------------------------------//
//                                              OSCILACION PROFUNDA                                        //
//--------------------------------------------------------------------------------------------------------//
$sqloscilacion="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 11 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$oscilacion = mysqli_query($conexion, $sqloscilacion);

//----------------------------------------------------------------------------------------------------------//
//                                              TERAPIA OCUPACIONAL                                        //
//--------------------------------------------------------------------------------------------------------//
$sqlterapia="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 9 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$terapia1 = mysqli_query($conexion, $sqlterapia);

//----------------------------------------------------------------------------------------------------------//
//                                              EJERCICIO                                                  //
//--------------------------------------------------------------------------------------------------------//
$sqlejercicio="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 12 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$ejercicio = mysqli_query($conexion, $sqlejercicio);

//----------------------------------------------------------------------------------------------------------//
//                                              GIMNASIO                                                   //
//--------------------------------------------------------------------------------------------------------//
$sqlgimnasio="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 13 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$gimnasio = mysqli_query($conexion, $sqlgimnasio);

//----------------------------------------------------------------------------------------------------------//
//                                              EN BARRAS                                                  //
//--------------------------------------------------------------------------------------------------------//
$sqlbarras="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 14 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$barras = mysqli_query($conexion, $sqlbarras);

//----------------------------------------------------------------------------------------------------------//
//                                              EN CAMASTRON                                               //
//--------------------------------------------------------------------------------------------------------//
$sqlcamastron="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 15 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$camastron = mysqli_query($conexion, $sqlcamastron);

//----------------------------------------------------------------------------------------------------------//
//                                              DESTREZAS MANUALES                                         //
//--------------------------------------------------------------------------------------------------------//
$sqldestrezas="SELECT TT.Nombre AS TIPO_TERAPIA, DTT.Resultado
FROM tbl_cita_terapeutica AS CT 
LEFT JOIN tbl_detalle_terapia AS DT ON CT.id_Cita_Terapia = DT.Id_Cita_Terapia LEFT JOIN tbl_detalle_terapia_tratamiento AS DTT ON DT.Id_Detalle_Terapia = DTT.Id_Detalle_Terapia
LEFT JOIN tbl_tipo_terapia AS TT ON DTT.Id_Tipo_Terapia = TT.idTipoTerapia
LEFT JOIN tbl_tipo_tratamiento AS TIPOT ON TT.Id_Tipo_Tratamiento = TIPOT.Id_Tipo_Tratamiento
WHERE
CT.id_Cita_Terapia = $id_cita AND TT.Id_Tipo_Tratamiento = 16 AND DT.Id_Detalle_Terapia = $Id_Detalle_Terapia ";
$destrezas = mysqli_query($conexion, $sqldestrezas);


$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(135, 206, 235);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(191, 5, "INFORMACION DEL PACIENTE", 0, 1, 'C', 1);
$pdf->Ln(2);

$pdf->SetTextColor(0, 0, 0); // Establecer el color del texto a negro
$pdf->Cell(90, 5, utf8_decode('PACIENTE'), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode('EVALUADOR'), 0, 0, 'L');
$pdf->Cell(20, 5, utf8_decode('FECHA'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['PACIENTE']), 0, 0, 'L');
$pdf->SetFillColor(255, 255, 255); // Establecer el color de fondo a blanco
$pdf->SetTextColor(0, 0, 0); // Establecer el color del texto a negro
$pdf->MultiCell(100, 5, utf8_decode($fila['EVALUADOR']), 0, 0, 'L');
$pdf->SetXY(86, $pdf->GetY() - 5); // Alinea la siguiente celda a la misma altura que la celda anterior
$pdf->Cell(90, 5, utf8_decode($fila['FECHA_TERAPIA']), 0, 0, 'R');
$pdf->Ln(5);


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'EDAD', 0, 1, 'L');
// $pdf->Cell(50, 5, utf8_decode('N° Sesiones'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($fila['Edad']), 0, 1, 'L');

$pdf->SetTextColor(0,0,0); // Establecer color de texto blanco
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(90, 5, 'MOTIVO DE CONSULTA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->MultiCell(90, 5, utf8_decode($fila['Descripcion_Cita']), 0, 0, 'L');
$pdf->SetTextColor(0,0,0); // Establecer color de texto blanco
$pdf->Ln(4);


///MEDIOS FISICOS

// $tituloImpreso = false;
// while ($fisico1 = mysqli_fetch_assoc($fisico)) {
//     Verificar si el título aún no se ha impreso
//     if (!$tituloImpreso) {
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("MEDIOS FíSICOS"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);
        
//         Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }

//     Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
//     $pdf->SetFont('Arial', 'B', 8);
//     $pdf->Cell(50, 3, utf8_decode($fisico1['TIPO_TERAPIA']. ': '), 0, 0, 'L');

//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($fisico1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///MASOTERAPIA
// $tituloImpreso = false;
// while ($masoterapia1 = mysqli_fetch_assoc($masoterapia)) {
//     if (!$tituloImpreso) {
//         $pdf->SetY(99);
//         $pdf->SetX(106); // Cambia el valor según tu necesidad
        
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("MASOTERAPIA"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }

//     // Establecer la posición X para mover a la derecha
//     $pdf->SetX(105); // Cambia el valor según tu necesidad

//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($masoterapia1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($masoterapia1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }
// //ULTRASONIDO
// $tituloImpreso = false;
// while ($ultra1 = mysqli_fetch_assoc($ultrasonido)) {
//     // Verificar si el título aún no se ha impreso
//     if (!$tituloImpreso) {
//         $pdf->SetY(160);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("ULTRASONIDO"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);
        
//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     // Establecer el tamaño de la fuente y el tipo de letra para el texto en negrita
//     $pdf->SetFont('Arial', 'B', 8);

//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($ultra1['TIPO_TERAPIA']. ': '), 0, 0, 'L');

//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($ultra1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///LASER
// $tituloImpreso = false;
// while ($laser1 = mysqli_fetch_assoc($laser)) {
//     if (!$tituloImpreso) {
//         $pdf->SetY(160);
//         $pdf->SetX(106); // Cambia el valor según tu necesidad
        
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("LÁSER"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }

//     // Establecer la posición X para mover a la derecha
//     $pdf->SetX(105); // Cambia el valor según tu necesidad

//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($laser1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($laser1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///MAGNOTERAPIA 
// $tituloImpreso = false;
// while ($magno1 = mysqli_fetch_assoc($magnoterapia)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(220);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("MAGNOTERAPIA"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($magno1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($magno1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///MOVILIDAD ARTICULAR 
// $tituloImpreso = false;
// while ($movilidad1 = mysqli_fetch_assoc($movilidad)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(220);
//       $pdf->SetX(106);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("MOVILIDAD ARTICULAR"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetX(105);
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($movilidad1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($movilidad1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///ELECTROTERAPIA
// $tituloImpreso = false;
// while ($electro1 = mysqli_fetch_assoc($electroterapia)) {
//     if (!$tituloImpreso) {
//       //   $pdf->SetY(500);
//         $pdf->AddPage();
//         $pdf->Ln(7);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("ELECTROTERAPIA"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($electro1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($electro1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///TRACCION 
// $tituloImpreso = false;
// while ($traccion1 = mysqli_fetch_assoc($traccion)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(55);
//       $pdf->SetX(106);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("MOVILIDAD ARTICULAR"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetX(105);
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($traccion1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);

//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($traccion1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///PRESOTERAPIA 
// $tituloImpreso = false;
// while ($preso1 = mysqli_fetch_assoc($presoterapia)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(157);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("PRESOTERAPIA"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($preso1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);

//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($preso1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///OSCILACION PROFUNDA 
// $tituloImpreso = false;
// while ($oscilacion1 = mysqli_fetch_assoc($oscilacion)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(157);
//       $pdf->SetX(106);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("OSCILACION PROFUNDA"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetX(105);
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($oscilacion1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($oscilacion1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///TERAPIA OCUPACIONAL
// $tituloImpreso = false;
// while ($terapia1 = mysqli_fetch_assoc($terapia1)) {
//     if (!$tituloImpreso) {
//       //   $pdf->SetY(500);
//         $pdf->AddPage();
//         $pdf->Ln(7);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("TERAPIA OCUPACIONAL"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($terapia1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($terapia1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///EJERCICIO 
// $tituloImpreso = false;
// while ($ejercicio1 = mysqli_fetch_assoc($ejercicio)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(55);
//       $pdf->SetX(106);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("EJERCICIO"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetX(105);
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(55, 3, utf8_decode($ejercicio1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($ejercicio1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///GIMNASIO
// $tituloImpreso = false;
// while ($gimnasio1 = mysqli_fetch_assoc($gimnasio)) {
//     if (!$tituloImpreso) {
//       //   $pdf->SetY(500);
//         $pdf->Ln(0);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("GIMNASIO"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($gimnasio1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($gimnasio1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///EN BARRAS 
// $tituloImpreso = false;
// while ($barras1 = mysqli_fetch_assoc($barras)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(165);
//       $pdf->SetX(106);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("EN BARRAS"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetX(105);
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(55, 3, utf8_decode($barras1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($barras1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///EN CAMASTRON
// $tituloImpreso = false;
// while ($camastron1 = mysqli_fetch_assoc($camastron)) {
//     if (!$tituloImpreso) {
//       //   $pdf->SetY(500);
//         $pdf->AddPage();
//         $pdf->Ln(7);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("EN CAMASTRON"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(50, 3, utf8_decode($camastron1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($camastron1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

// ///DESTREZAS MANUALES 
// $tituloImpreso = false;
// while ($destrezas1 = mysqli_fetch_assoc($destrezas)) {
//     if (!$tituloImpreso) {
//       $pdf->SetY(55);
//       $pdf->SetX(106);
//         $pdf->SetFont('Arial', 'B', 10);
//         $pdf->SetFillColor(135, 206, 235);
//         $pdf->SetTextColor(255, 255, 255);
//         $pdf->Cell(95, 5, utf8_decode("DESTREZAS MANUALES"), 0, 1, 'C', 1);
//         $pdf->SetTextColor(0, 0, 0);
//         $pdf->Ln(3);

//         // Cambiar el valor de la variable para que no se vuelva a imprimir el título
//         $tituloImpreso = true;
//     }
//     $pdf->SetX(105);
//     $pdf->SetFont('Arial', 'B', 8);
//     // Imprimir la Descripción en negrita
//     $pdf->Cell(55, 3, utf8_decode($destrezas1['TIPO_TERAPIA']. ': '), 0, 0, 'L');
//     // Restablecer la fuente a la normal
//     $pdf->SetFont('Arial', '', 8);
//     $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
//     $pdf->MultiCell(45, 3, utf8_decode($destrezas1['Resultado']), 0,  'L'); 
//     $pdf->SetTextColor(0, 0, 0);
//     $pdf->Ln(3);
// }

function imprimirTerapia($pdf, $titulo, $terapia) {
    $datosDisponibles = false;
    $columnaActual = 1; // Variable para alternar entre columnas izquierda (1) y derecha (2)
    $datosTerapia = array(); // Array para almacenar los datos de la terapia
    
    // Almacenar los datos de la terapia en un array
    while ($row = mysqli_fetch_assoc($terapia)) {
        if (!empty($row['Resultado'])) {
            $datosTerapia[] = $row;
            $datosDisponibles = true;
        }
    }

    // Imprimir el título solo si hay datos disponibles
    if ($datosDisponibles) {
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(135, 206, 235);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Ln(4);
        $pdf->Cell(191, 5, utf8_decode($titulo), 0, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(5);
    }
    
    // Imprimir los datos de la terapia si hay datos disponibles
    foreach ($datosTerapia as $row) {
        // Alternar entre columnas izquierda y derecha
        if ($columnaActual == 1) {
            $pdf->SetX(10); // Establecer posición X para la columna izquierda
            $columnaActual = 2;
        } else {
            $pdf->SetX(108); // Establecer posición X para la columna derecha
            $columnaActual = 1;
        }
        // Imprimir los datos de la terapia
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->Cell(50, 3, utf8_decode($row['TIPO_TERAPIA']. ': '), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 8);
        $pdf->SetFillColor(255, 255, 255); // Establecer color de fondo blanco
        $pdf->MultiCell(45, 3, utf8_decode($row['Resultado']), 0,  'L'); 
        $pdf->SetTextColor(0, 0, 0);
    }
}

// Verificar y imprimir cada tipo de terapia
if (mysqli_num_rows($fisico) > 0) {
    imprimirTerapia($pdf, "MEDIOS FÍSICOS", $fisico);
}
if (mysqli_num_rows($masoterapia) > 0) {
    imprimirTerapia($pdf, "MASOTERAPIA", $masoterapia);
}
if (mysqli_num_rows($ultrasonido) > 0) {
    imprimirTerapia($pdf, "ULTRASONIDO", $ultrasonido);
}
if (mysqli_num_rows($laser) > 0) {
    imprimirTerapia($pdf, "LÁSER", $laser);
}
if (mysqli_num_rows($magnoterapia) > 0) {
    imprimirTerapia($pdf, "MAGNETOTERAPIA", $magnoterapia);
}
if (mysqli_num_rows($movilidad) > 0) {
    imprimirTerapia($pdf, "MOVILIDAD", $movilidad);
}
if (mysqli_num_rows($electroterapia) > 0) {
    imprimirTerapia($pdf, "ELECTROTERAPIA", $electroterapia);
}
if (mysqli_num_rows($traccion) > 0) {
    imprimirTerapia($pdf, "TRACCIÓN", $traccion);
}
if (mysqli_num_rows($presoterapia) > 0) {
    imprimirTerapia($pdf, "PRESOTERAPIA", $presoterapia);
}
if (mysqli_num_rows($oscilacion) > 0) {
    imprimirTerapia($pdf, "OSCILACION PROFUNDA", $oscilacion);
}
if (mysqli_num_rows($terapia1) > 0) {
    imprimirTerapia($pdf, "TERAPIA OCUPACIONAL", $terapia1);
}
if (mysqli_num_rows($ejercicio) > 0) {
    imprimirTerapia($pdf, "EJERCICIO", $ejercicio);
}
if (mysqli_num_rows($gimnasio) > 0) {
    imprimirTerapia($pdf, "EN GIMNASIO", $gimnasio);
}
if (mysqli_num_rows($barras) > 0) {
    imprimirTerapia($pdf, "EN BARRAS", $barras);
}
if (mysqli_num_rows($camastron) > 0) {
    imprimirTerapia($pdf, "EN CAMASTRON", $camastron);
}
if (mysqli_num_rows($destrezas) > 0) {
    imprimirTerapia($pdf, "DESTREZAS MANUALES", $destrezas);
}

if (isset($nombre) && isset($nombre['PACIENTE'])) {
    $nombre_archivo_pdf = 'Expediente Terapeutico ' . $fila['PACIENTE'] . '.pdf';
    } else {
        // Manejar el caso en el que $nombre o $nombre['PACIENTE'] no están definidos
        // Por ejemplo, puedes asignar un valor predeterminado al nombre del archivo
        $nombre_archivo_pdf = 'Expediente Terapeutico.pdf';
    }
    
$pdf->Output($nombre_archivo_pdf, 'I');

// $pdf->Output('Terapeutico.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
?>