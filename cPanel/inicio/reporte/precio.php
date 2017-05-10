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
    $this->Text(110, 54, 'LISTADO HABITACIONES');
    $this->Ln(55);
  }

  function TablaColores($header) {
    $this->SetFillColor(192, 192, 192);
    $this->SetTextColor(255);
    $this->SetLineWidth(.3);
    $this->SetFont('Arial', 'B');

    $w = array(120, 30, 30, 60);

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

$pdf -> SetY(70);

$header = array('HABITACION', 'COSTO', 'RECAUDADO', 'ESTADO');

$pdf->SetX(25);
$pdf->SetFont('Arial', '',12);
$pdf->TablaColores($header);

$query = $pdo->query("SELECT * FROM hotel_habitacion");

foreach ($query as $row) {
  $pdf->SetX(25);
  $id = $row["codigo_habitacion"];
  $total = 0;
  $recar = 0;
  $estado = "recaudando";

  $details = $pdo->query("SELECT * FROM detalle_habitacion
                WHERE codigo_habitacion='$id'");

  $reservaciones = $pdo->query("SELECT * FROM v_detalle_reservadas
                    WHERE codigo_habitacion='$id'");

  foreach ($details as $detail) {
    $total = $total + $detail["detalle_total"];
  }
  foreach ($reservaciones as $reser) {
    $recar = $recar + $reser["valor_habitacion"];
  }

  if($total <= $recar) {
    $estado = "recaudado";
  }

  $pdf->Cell(120, 6.5, utf8_decode("HABIATCION N°" . $row["nombre_habitacion"]), 1, 'C');
  $pdf->Cell(30, 6.5, number_format($total, 2), 1, 'C');
  $pdf->Cell(30, 6.5, number_format($recar, 2), 1, 'C');
  $pdf->Cell(60, 6.5, strtoupper($estado), 1, 'C');
  $pdf->Ln();
}

$pdf->Ln();

$pdf->Output();
?>
