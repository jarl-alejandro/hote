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
    $this->Ln(40);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(25, 90, 18, 18, 18, 18, 18, 18, 18, 18, 18);

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

// $pdf -> SetY(15);

$codigo = $_GET["codigo"];
$query = $pdo->query("SELECT * FROM vista_kardex WHERE codigo_kardex='$codigo'");

$row = $query->fetch();
$pdf -> SetX(5);
$pdf->SetFont('Arial', 'B',15);

$pdf->Cell(0, 6.5, utf8_decode("KARDEX Nº: ". $row["codigo_kardex"]), 0, false, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B',13);
$pdf->Cell(93, 6.5, "PRODUCTO: ".$row['nombre_producto'], 0, false, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '',12);
$pdf->Cell(70, 6.5, "MAXIMO: ".$row['maximo_producto'], 0, false, 'C');
$pdf->Cell(93, 6.5, "CANTIDAD: ".$row['cantidad_producto'], 0, false, 'C');
$pdf->Cell(70, 6.5, "MINIMO: ".$row['minimo_producto'], 0, false, 'C');

$pdf->Ln(15);
$pdf->SetX(125);
$pdf->Cell(54, 5, "ENTRADA", 1, 0, 'C');
$pdf->Cell(54, 5, "SALIDA", 1, 0, 'C');
$pdf->Cell(54, 5, "EXISTENCIA", 1, 0, 'C');

$pdf->Ln();

$headerDetalle = array(utf8_decode('Nº'), 'DETALLE', 'CAN', 'VAL', 'SUB', 'CAN', 'VAL', 'SUB', 'CAN', 'VAL', 'SUB');
$pdf->TablaColores($headerDetalle);
$pdf->SetFillColor(192, 192, 192);

$detalles = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$codigo'");

$count = 0;

foreach ($detalles as $detalle){
  $count++;
  $pdf->Cell(25, 8, $count, 1, 0, 'C');
  $pdf->Cell(90, 8, $detalle["desc_kardex"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["ent_cant"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["ent_val"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["ent_sub"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["sal_cant"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["sal_val"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["sal_sub"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["exist_cant"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["exist_val"], 1, 0, 'C');
  $pdf->Cell(18, 8, $detalle["exist_sub"], 1, 0, 'C');

  $pdf->Ln();
}

$pdf->Output();
?>
