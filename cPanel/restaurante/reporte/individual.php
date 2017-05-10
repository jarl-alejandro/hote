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
$row = $pdo->query("SELECT * FROM vh_restaurante WHERE codigo_restaurante='$codigo'");
$venta = $row->fetch();

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',10);

$pdf->Cell(100, 6.5, utf8_decode("CEDULA: " . $venta["cliente_restaurante"]), 0, 'C');
$pdf->Cell(100, 6.5, utf8_decode("CLIENTE: " . $venta["cliente"]), 0, 'C');
$pdf->Ln();

$pdf->Cell(100, 6.5, utf8_decode("DIRECCION: " . $venta["direccion_cliente"]), 0, 'C');
$pdf->Cell(50, 6.5, "FECHA: " . $venta["fecha_restaurante"], 0, 'C');
$pdf->Ln();

$pdf -> SetX(10);

$pdf->Ln(10);
$header = array('CANT', 'DESCRIPCION', 'V. UNIT', 'V. TOTAL');
$pdf->TablaColores($header);

$r_detail = $pdo->query("SELECT * FROM vista_detalle_restaurante WHERE codigo_restaurante='$codigo'");

foreach ($r_detail as $detail) {
  $pdf->Cell(20, 6.5, $detail["cant_restaurante"], 1, 'C');
  $pdf->Cell(157, 6.5, utf8_decode($detail["nombre_producto"]), 1, 'C');
  $pdf->Cell(30, 6.5, $detail["unit_restaurante"], 1, 'C');
  $pdf->Cell(30, 6.5, $detail["total_restaurante"], 1, 'C');
$pdf->Ln();    
}

$queryPram = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro='1'");
$params = $queryPram->fetch();

$iva = $params["iva_hotel"];
$desc = $venta["porcen"];

$pdf->SetX(187);
$pdf->Cell(30, 6.5, "SUB TOTAL  $", 1, 0, 'R');
$pdf->Cell(30, 6.5, $venta["subtotal"], 1, 'C');
$pdf->Ln();    

$pdf->SetX(187);
$pdf->Cell(30, 6.5, "IVA $iva%", 1, 0, 'R');
$pdf->Cell(30, 6.5, $venta["iva"], 1, 'C');
$pdf->Ln();    

$pdf->SetX(187);
$pdf->Cell(30, 6.5, "DESC  $desc%", 1, 0, 'R');
$pdf->Cell(30, 6.5, $venta["descu"], 1, 'C');
$pdf->Ln();    

$pdf->SetX(187);
$pdf->Cell(30, 6.5, "TOTAL  $", 1, 0, 'R');
$pdf->Cell(30, 6.5, $venta["total_restaurante"], 1, 'C');


$pdf->Output();
?>
