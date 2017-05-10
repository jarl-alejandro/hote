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
    $this->Text(110, 54, 'FACTURA');
    $this->Ln(25);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(20, 157, 30, 30);

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

$pdf->SetFont('Arial', '',12);

$codigo = $_GET["codigo"];
$row = $pdo->query("SELECT * FROM vista_ventaf WHERE codigo_venta='$codigo'");
$venta = $row->fetch();

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',10);

$pdf->Cell(190, 6.5, utf8_decode("Habitacion N°: " . $venta["nombre_habitacion"]), 0, 'C');
$pdf->Cell(50, 6.5, "Fecha: " . $venta["fecha_venta"], 0, 'C');
$pdf->Ln();

$pdf->Cell(260, 6.5, utf8_decode("Cliente: " . $venta['cliente']), 0, 'C');
$pdf->Ln();

$pdf -> SetX(10);
$pdf->Cell(260, 6.5, utf8_decode("Detalle: " . $venta['detalle_venta']), 0, 'C');

$pdf->Ln(10);
$header = array('CANT', 'DESCRIPCION', 'V. UNIT', 'V. TOTAL');
$pdf->TablaColores($header);

$pdf->SetX(10);

$r_detail = $pdo->query("SELECT * FROM vista_ventas WHERE codigo_ventad='$codigo'");

foreach ($r_detail as $detail) {
  $pdf->Cell(20, 6.5, $detail["cant_ventad"], 1, 'C');
  $pdf->Cell(157, 6.5, utf8_decode($detail["nombre_producto"]), 1, 'C');
  $pdf->Cell(30, 6.5, $detail["unit_vantad"], 1, 'C');
  $pdf->Cell(30, 6.5, $detail["total_ventad"], 1, 'C');
  $pdf->Ln();
}
$pdf->Cell(207, 6.5, "TOTAL   ", 1, 0, 'R');
$pdf->Cell(30, 6.5, $venta["total_venta"], 1, 'C');


$pdf->Output();
?>
