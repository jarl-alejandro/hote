<?php
session_start();
date_default_timezone_set('America/Guayaquil');

require('fpdf.php');
include '../../../bd/db.php';


class PDF extends FPDF {

  function Header() {
    $fecha_actual = date("Y/m/d");
    $user = $_SESSION["249ba36000029bbe97499c03db5a9001f6b734ec"];

    $this->Image('../../static/img/logo.png', 15, 5, 270, 34);
    $this->SetFont('Arial', 'B', 15);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(110, 54, 'CIERRE DE CAJA');
    $this->SetFont('Arial', '', 11);
    $this->Text(115, 60, "FECHA : ". $fecha_actual);
    $this->Text(200, 70, "EMPLEADO: ". $user);
    $this->SetFont('Arial', 'B', 15);
    $this->Ln(35);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(10, 30, 216, 30); 

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

$pdf -> SetY(75);
$header = array(utf8_decode('N°'), 'CODIGO', 'REFERENCIA', 'VALOR');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$fecha_actual = date("Y/m/d");

$factura = $pdo->query("SELECT * FROM hotel_facturam WHERE factura_estado='pagado' AND  
                            fecha_facturam='$fecha_actual'");

$restaurante = $pdo->query("SELECT * FROM hotel_restaurante WHERE 
                              fecha_restaurante='$fecha_actual'");

$egresos = $pdo->query("SELECT * FROM hotel_egreso WHERE fecha_egreso='$fecha_actual'");

$mensuales = $pdo->query("SELECT * FROM v_pagos_mensuales WHERE mensual_fecha='$fecha_actual'");

$count = 0;
$total = 0;

foreach ($factura as $row) {
  $count++; 
  $total += $row["total_facturam"];

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(10, 6.5, $count, 1, false, 'C');
  $pdf->Cell(30, 6.5, $row["codigo_facturam"], 1, 'C');
  $pdf->Cell(216, 6.5, $row['detealle_facturam'], 1, 'C');
  $pdf->Cell(30, 6.5, $row['total_facturam'], 1, false, 'C');

  $pdf->Ln();
}

foreach ($mensuales as $row) {
  $count++; 
  $total += $row["mensual_precio"];

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(10, 6.5, $count, 1, false, 'C');
  $pdf->Cell(30, 6.5, $row["mensual_reservacion"], 1, 'C');
  $pdf->Cell(216, 6.5, "Pago mensual por ". $row["cliente"], 1, 'C');
  $pdf->Cell(30, 6.5, $row['mensual_precio'], 1, false, 'C');

  $pdf->Ln();
}

foreach ($restaurante as $row) {
  $count++; 
  $total += $row["total_restaurante"];

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(10, 6.5, $count, 1, false, 'C');
  $pdf->Cell(30, 6.5, $row["codigo_restaurante"], 1, 'C');
  $pdf->Cell(216, 6.5, $row['detalle_restaurante'], 1, 'C');
  $pdf->Cell(30, 6.5, $row['total_restaurante'], 1, false, 'C');

  $pdf->Ln();
}

foreach ($egresos as $row) {
  $count++; 
  $total -= $row["valor_egreso"];

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(10, 6.5, $count, 1, false, 'C');
  $pdf->Cell(30, 6.5, $row["codigo_egreso"], 1, 'C');
  $pdf->Cell(216, 6.5, $row['referencia_egreso'], 1, 'C');
  $pdf->Cell(30, 6.5, $row['valor_egreso'], 1, false, 'C');

  $pdf->Ln();
}

$pdf -> SetX(5);
$pdf->Cell(10, 6.5, "", 1, 'C');
$pdf->Cell(30, 6.5, "", 1, 'C');
$pdf->Cell(216, 6.5, "TOTAL", 1, 'C');
$pdf->Cell(30, 6.5, number_format($total, 2), 1, false, 'C');
$pdf->Ln();

$pdf->Output();
?>
