<?php
session_start();

require('fpdf.php');
// require('image_alpha.php');
include '../../../bd/db.php';

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {

    $this->Image('../../static/img/logo.png', 15, 5, 270, 34);
    $this->SetFont('Arial', 'B', 15);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(100, 54, 'LISTADO DE HABITACIONES REPARADAS');
    $this->Ln(50);

  }

  function TablaColores($header) {

    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 100, 100, 50);

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

// $pdf = new PDF_ImageAlpha("L");
$pdf = new PDF("L");
$pdf->AddPage();

$pdf -> SetY(65);
$header = array('CODIGO', 'NOMBRE', 'FECHA', 'HABITACION');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM v_reparadas");

while ($row = $query->fetch()) {

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 17, $row["codigo_habitacion"], 1, 0, 'C');
  $pdf->Cell(100, 17, utf8_decode("Habitacion N°". $row['nombre_habitacion']), 1, 0, 'C');
  $pdf->Cell(100, 17, "Reparado el ". $row['tmp_fech'], 1, 0, 'C');
  $pdf->Cell(50, 17, $pdf->Image("../../../media/habitaciones/".$row["imagen_habitacion"], $pdf->GetX(), $pdf->GetY(), 50, 17), 1,0,'R');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
