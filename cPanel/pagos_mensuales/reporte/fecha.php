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
    $this->Text(140, 54, 'PAGOS MENSUALES');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 100, 50, 30, 50);

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

$header = array(utf8_decode('Nº'), 'CLIENTE', 'FECHA', 'PRECIO', 'DEPOSITO');

$pdf->SetX(15);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$fecha = date("Y/m/d");
$desde = $_GET["desde"];
$hasta = $_GET["hasta"]; 

$query = $pdo->query("SELECT * FROM v_pagos_mensuales WHERE mensual_fecha 
                        BETWEEN '$desde' AND '$hasta'");
$id = 0;

foreach ($query as $row) {
  $id++;
  $pdf->SetX(15);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $id, 1, 0, 'C');
  $pdf->Cell(100, 6.5, $row['cliente'], 1, 0, 'C');
  $pdf->Cell(50, 6.5, $row['mensual_fecha'], 1, 0, 'C');
  // $pdf->Cell(30, 6.5, $row['mensual_precio'], 1, 0, 'C');

  $total = $row['mensual_precio'];

  $queryPram = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro='1'");
  $params = $queryPram->fetch();

  $iva = $params['iva_hotel'];
  $desc = $row['desc_tipo'];

  $iv = $iva / 100;
  $iva_pagar = $iv * $total;

  $desc_pagar = $row["desc_facturam"];
  $pagar = $total + $iva_pagar - $desc_pagar - $row["abono_facturam"];

  $pdf->Cell(30, 6.5, number_format($pagar, 2), 1, 0, 'C');

  $pdf->Cell(50, 6.5, $row['mensual_deposito'], 1, 0, 'C');

  $pdf->Ln();
}
$pdf->Ln();

$pdf->Output();
?>
