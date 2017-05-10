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
    $this->Text(110, 54, 'LISTADO DE PEDIDOS DE BAJO STOCK');
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

$pdf = new PDF("L");
$pdf->AddPage();

$pdf -> SetY(65);
$header = array('CODIGO', 'PRODUCTO', 'CANTIDAD', 'VALOR');

$pdf -> SetX(5);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$codigo = $_GET["codigo"];
$query = $pdo->query("SELECT * FROM hotel_producto WHERE codigo_producto='$codigo'");

$row = $query->fetch();
$pdf -> SetX(5);
$pdf->SetFont('Arial', '',10);

$pdf->Cell(50, 6.5, $row["codigo_producto"], 1, 'C');
$pdf->Cell(177, 6.5, $row["nombre_producto"], 1, 'C');
$pdf->Cell(30, 6.5, $row["cantidad_producto"], 1, 'C');
$pdf->Cell(30, 6.5, $row["valor_producto"], 1, 'C');

$pdf->Ln();

$pdf->Output();
?>
