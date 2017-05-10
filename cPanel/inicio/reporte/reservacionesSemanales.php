<?php
session_start();

require('fpdf.php');
include '../../../bd/db.php';

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {

    $this->Image('../../static/img/logo.png', 15, 5, 270, 34);
    $this->SetFont('Arial', 'B', 15);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(110, 54, 'RESERVACIONES SEMANALES');
    $this->Ln(25);

    if($this->PageNo() > 1) {
        $this->Ln(40);      
    }

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 93, 70, 93);

    for ($i = 0; $i < count($header); $i++)
      $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);

    $this->Ln();

    $this->SetTextColor(0);

    $this->SetFont('Times');
  }

  function Footer() {

    $this->SetY(-15);
    $this->SetFont('Arial', 'I', 8);
    $this->Cell(0, 10, utf8_decode('Página ' . $this->PageNo() . '/Hotel Madison'), 0, 0, 'C');
  }

}

$pdf = new PDF("L");
$pdf->AddPage();

$pdf -> SetY(65);

$hoy = date("Y-m-d");
$ahora = date("h:i a");

$primer_dia = mktime();
$ultimo_dia = mktime();

while(date("w",$primer_dia)!=1){
  $primer_dia -= 3600;
}

while(date("w",$ultimo_dia)!=0){
  $ultimo_dia += 3600;
}

$lunes = date("Y-m-d",$primer_dia);
$domingo = date("Y-m-d",$ultimo_dia);

$semana = "SELECT * FROM vista_reservacion WHERE (
  (fecha_habitacion <='$lunes' AND hasta_habitacion >= '$domingo')
  OR fecha_habitacion BETWEEN '$lunes' AND '$domingo'
  OR hasta_habitacion BETWEEN '$lunes' AND '$domingo')
  AND estado_habitacion='reservado'";


$query = $pdo->query($semana);

foreach ($query as $row) {
  $codigo = $row["codigo_reservacion"];
  $header = array('CEDULA', 'CLIENTE', 'E-MAIL', 'DIRECCION');

  $pdf->SetX(5);
  $pdf->SetFont('Arial', '',12);
  $pdf->TablaColores($header);


  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $row["cedula_cliente"], 1, 'C');
  $pdf->Cell(93, 6.5, strtoupper($row['apellido_cliente']).' '. strtoupper($row['nombre_cliente']), 1, 'C');
  $pdf->Cell(70, 6.5, strtolower($row['email_cliente']), 1, 'C');
  $pdf->Cell(93, 6.5, strtolower($row['direccion_cliente']), 1, 'C');

  $pdf->Ln("10");

  $pdf->SetX(35);
  $pdf->SetTextColor(255);
  $pdf->Cell(163, 6.5, "HABITACION", 1, 0, 'C', true);
  $pdf->Cell(30, 6.5, "VALOR", 1, 0, 'C', true);
  $pdf->SetFont('Times');

  $pdf->Ln();

  // Habitacines
  $r_detail = $pdo->query("SELECT * FROM vista_reservacion_habitacion
                            WHERE codigo_detalle='$codigo'");

  foreach ($r_detail as $detail) {
    $pdf->SetX(35);
    $pdf->SetTextColor(0);
    $pdf->Cell(163, 6.5, utf8_decode("Habitacion N°" . $detail["nombre_habitacion"]), 1, 'C');
    $pdf->Cell(30, 6.5, $detail["valor_habitacion"], 1, 'C');
    $pdf->Ln();
  }
  $pdf->Ln(10);  
}




$pdf->Ln();

$pdf->Output();
?>
