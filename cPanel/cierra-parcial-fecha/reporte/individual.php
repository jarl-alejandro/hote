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
    $this->Text(110, 54, 'REPORTE DE COMPRA');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 157, 30, 30, 50);

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
$id = $_GET["codigo"];
$pdf->SetFont('Arial', '',12);

$query = $pdo->query("SELECT * FROM tmp_compra WHERE comp_id='$id'");
$compra = $query->fetch();

$pdf->Cell(190, 6.5, 'Compra segun factura #'.$compra["comp_factura"], 0, 'C');
$pdf->Cell(50, 6.5, "Fecha: " . $compra["comp_fecha"], 0, 'C');
$pdf->Ln(20);

$pdf->setX(30);
$header = array('CANT', 'PRODUCTO', 'V. UNIT', 'V. TOTAL');
$pdf->TablaColores($header);
$codigo = $compra["comp_cod"]; 
$total = 0;
$r_detail = $pdo->query("SELECT * FROM view_compra_det WHERE cdtmp_cod='$codigo'");

foreach ($r_detail as $detail) {
  $suma = $detail["cdtmp_cant"] * $detail["cdtmp_valor"];

  $pdf->setX(30);  
  $pdf->Cell(30, 6.5, $detail["cdtmp_cant"], 1, 'C');
  $pdf->Cell(157, 6.5, utf8_decode($detail["nombre_producto"]), 1, 'C');
  $pdf->Cell(30, 6.5, $detail["cdtmp_valor"], 1, 'C');
  $pdf->Cell(30, 6.5, $suma, 1, 'C');
  $pdf->Ln();
  $total = $total + $suma;
}
$pdf->setX(217);
$pdf->Cell(30, 6.5, "TOTAL  ", 1, 'C');
$pdf->Cell(30, 6.5, number_format($total, 2), 1, 'C');

$pdf->Output();
