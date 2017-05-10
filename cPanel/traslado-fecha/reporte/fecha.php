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
    $this->Text(110, 54, 'LISTADO DE HABITACIONES TRASLADO');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 80, 80, 50); 

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

$pdf->SetY(65);
$header = array('#', 'HABITACION NUEVA', 'HABITACION VIEJA', 'FECHA');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$desde = $_GET["desde"];
$hasta = $_GET["hasta"];

// $query = $pdo->query("SELECT * FROM vh_restaurante");
$query = $pdo->query("SELECT * FROM vista_traslado WHERE tras_fecha 
                                        BETWEEN '$desde' AND '$hasta'");

$index = 0;

foreach ($query as $row) {
  $index++;
  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $index, 1, 'C');
  $pdf->Cell(80, 6.5, utf8_decode("N°: " . $row["nombre_habitacion"]), 1, 'C');
  $pdf->Cell(80, 6.5, utf8_decode("N°: " . $row["tras_hvie"]), 1, 'C');
  $pdf->Cell(50, 6.5, $row["tras_fecha"], 1, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
