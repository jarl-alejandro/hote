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
    $this->Text(110, 54, 'LISTADO DE COMPRAS POR FECHA');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 190, 50, 30, 50);

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

$header = array(utf8_decode('Nº'), 'CLIENTE', 'FECHA');

$pdf->SetX(10);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$fecha = date("Y/m/d");
$desde = $_GET["desde"];
$hasta = $_GET["hasta"]; 

$query = $pdo->query("SELECT * FROM tmp_compra WHERE comp_fecha 
                        BETWEEN '$desde' AND '$hasta'");

$id = 0;

foreach ($query as $row) {
  $id++;
  $pdf->SetX(10);
  $pdf->SetFont('Arial', '',10);

  $pdf->Cell(30, 6.5, $id, 1, 0, 'C');
  $pdf->Cell(190, 6.5, 'Compra segun factura #'.$row["comp_factura"], 1, 0, 'C');
  $pdf->Cell(50, 6.5, $row['comp_fecha'], 1, 0, 'C');

  $pdf->Ln();
}

$pdf->Ln();

$pdf->Output();
?>
