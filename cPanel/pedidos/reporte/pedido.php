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
    $this->Text(110, 54, 'LISTADO DE PEDIDOS');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(50, 177, 30, 30); 

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

$codigo = $_GET["codigo"];

$pdf = new PDF("L");
$pdf->AddPage();
$pdf -> SetY(65);

$pedido_query = $pdo->query("SELECT * FROM hotel_pedidos WHERE codigo_pedido='$codigo'");
$pedido = $pedido_query->fetch();

$pdf->Ln();

$pdf->SetFont('Arial', 'B',12);
$pdf->Cell(25, 6.5, "CODIGO: ", 0, false, 'L');
$pdf->SetFont('Arial', '',12);
$pdf->Cell(0, 6.5, $codigo, 0, false, 'L');
$pdf->Ln();

$pdf->SetFont('Arial', 'B',12);
$pdf->Cell(25, 6.5, "DETALLE: ", 0, false, 'L');
$pdf->SetFont('Arial', '',12);
$pdf->Cell(0, 6.5, utf8_decode($pedido["detalle_pedido"]), 0, false, 'L');
$pdf->Ln();

$pdf->SetFont('Arial', 'B',12);
$pdf->Cell(25, 6.5, "FECHA: ", 0, false, 'L');
$pdf->SetFont('Arial', '',12);
$pdf->Cell(0, 6.5, utf8_decode($pedido["fecha_pedido"]), 0, false, 'L');
$pdf->Ln(10);

$header = array('CODIGO', 'PRODUCTO', 'CANTIDAD', 'VALOR');
$pdf -> SetX(5);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM vista_pedidos_detalle WHERE codigo_pedido='$codigo'");
$total = 0;

foreach ($query as $row) {

  $pdf -> SetX(5);
  $pdf->SetFont('Arial', '',10);
  $total += $row["precio_pedido"];
  $pdf->Cell(50, 6.5, $row["codigo_pedido"], 1, 'C');
  $pdf->Cell(177, 6.5, $row["nombre_producto"], 1, 'C');
  $pdf->Cell(30, 6.5, $row["cant_pedido"], 1, 'C');
  $pdf->Cell(30, 6.5, $row["precio_pedido"], 1, 'C');

  $pdf->Ln();
}

$pdf -> SetX(232);
$pdf->Cell(30, 6.5, "TOTAL", 1, 'C');
$pdf->Cell(30, 6.5, number_format($total, 2), 1, 'C');
$pdf->Ln();

$pdf->Output();
?>
