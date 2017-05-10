<?php
session_start();

require('fpdf.php');
include '../../../bd/db.php';

date_default_timezone_set('America/Guayaquil');

class PDF extends FPDF {

  function Header() {

    $this->Image('../../static/img/logo.png', 15, 5, 270, 34);
    $this->SetFont('Arial', 'B', 19);
    $this->SetTextColor(0, 0, 0);
    $this->Ln(1);
    $this->Line(2, 42, 295, 42);
    $this->Text(110, 54, 'AVISO DE DESALOJO');
    $this->Ln(25);

  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(30, 93, 70, 93); 

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
// $header = array('CEDULA', 'EMPLEADO', 'E-MAIL', 'DIRECCION');

$pdf->SetFont('Arial', '',12);
$pdf->SetX(5);
$pdf->SetFont('Arial', '',10);

// $pdf->TablaColores($header);

$id = $_GET["id"];
$query = $pdo->query("SELECT * FROM v_desalojo WHERE des_id='$id'");
$row = $query->fetch();

$cliente = $row["cliente"];
$detalle = strtolower($row["des_det"]);

$message = "Sr(a). $cliente $detalle";

$pdf->Cell(0, 6.5, $message, 0, 0, 'C');

$pdf->Ln();

$pdf->Output();
?>
