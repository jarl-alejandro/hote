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

$code = $_GET["codigo"];

$reserQuery = $pdo->query("SELECT * FROM hotel_reservaciones WHERE
          codigo_reservacion='$code'");

$rowReservacion = $reserQuery->fetch();

if($rowReservacion["es_reservacion"] == "departamento"){
  $hasta_habitacion = date("Y-m-d");

  $fechainicial = new DateTime($rowReservacion["fecha_habitacion"]);
  $fechafinal = new DateTime($hasta_habitacion);
  $diferencia = $fechainicial->diff($fechafinal);
  $dayHosped = ( $diferencia->y * 12 ) + $diferencia->m;

  if($dayHosped == 0){
    $dayHosped = 1;
  }
}
else{
  $hasta_habitacion = $rowReservacion["hasta_habitacion"];
  $dayHosped = (strtotime($rowReservacion["fecha_habitacion"]) -
    strtotime($rowReservacion["hasta_habitacion"]))/86400;
  $dayHosped = abs($dayHosped);
  $dayHosped = floor($dayHosped);
}


$row = $pdo->query("SELECT * FROM vh_factura_g WHERE codigo_reservacion='$code'");
$venta = $row->fetch();
  $codigo = $venta["codigo_facturam"];

$pdf -> SetX(10);
$pdf->SetFont('Arial', '',10);

$pdf->Cell(200, 6.5, utf8_decode("Cliente: " . $venta["cliente"]), 0, 'C');
$pdf->Cell(200, 6.5, utf8_decode("Cedula: " . $venta["cliente_facturam"]), 0, 'C');

$pdf->Ln();
$pdf->Cell(200, 6.5, utf8_decode("Detalle: " . $venta['detealle_facturam']), 0, 'C');
$pdf->Cell(50, 6.5, "Fecha: " . $rowReservacion["fecha_habitacion"], 0, 'C');


$pdf->Ln();
$pdf->Cell(200, 6.5, utf8_decode("Direccion: " . $venta["direccion_cliente"]), 0, 'C');
$pdf->Cell(200, 6.5, "Salida: " . $hasta_habitacion, 0,  'C');

$pdf->Ln();

if($rowReservacion["es_reservacion"] == "departamento"){
  $pdf->Cell(232, 6.5, "Mes Hospedado: " . $dayHosped, 0, 0, 'R');
} else {
  $pdf->Cell(232, 6.5, "Dias Hospedado: " . $dayHosped, 0, 0, 'R');
}

$pdf->Ln(10);
$header = array('CANT', 'DESCRIPCION', 'V. UNIT', 'V. TOTAL');
$pdf->TablaColores($header);
// $pdf->Ln();

$total = 0;

$r_detail = $pdo->query("SELECT * FROM v_detalle_factura
                          WHERE codigo_facturam='$codigo'");

foreach ($r_detail as $detail) {
  $total += $detail["total_facturad"] * $dayHosped;
  $pdf->Cell(20, 6.5, $detail["cant_facturad"], 1, 'C');
  $pdf->Cell(157, 6.5, utf8_decode("Habitacion N°" . $detail["nombre_habitacion"]), 1, 'C');
  $pdf->Cell(30, 6.5, $detail["unit_facturad"], 1, 'C');
  $pdf->Cell(30, 6.5, number_format($detail["total_facturad"]*$dayHosped, 2), 1, 'C');
  $pdf->Ln();

  $facturas = $pdo->query("SELECT * FROM vista_ventaf WHERE codigo_facturam='$codigo'");

  foreach ($facturas as $factura) {
    $total += $factura["total_venta"];
    $pdf->Cell(20, 6.5, "1", 1, 'C');
    $pdf->Cell(157, 6.5, utf8_decode($factura["detalle_venta"]), 1, 'C');
    $pdf->Cell(30, 6.5, $factura["total_venta"], 1, 'C');
    $pdf->Cell(30, 6.5, $factura["total_venta"], 1, 'C');
    $pdf->Ln();

  }
}

$queryPram = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro='1'");
$params = $queryPram->fetch();

$iva = $params['iva_hotel'];
$desc = $venta['desc_tipo'];

$iv = $iva / 100;
$iva_pagar = $iv * $total;

$desc_pagar = $venta["desc_facturam"];
$pagar = $total + $iva_pagar - $desc_pagar - $venta["abono_facturam"];

$pdf->setX(187);
$pdf->Cell(30, 6.5, "Sub Total   ", 1, 0, 'R');
$pdf->Cell(30, 6.5, number_format($total, 2), 1, 'C');

$pdf->Ln();
$pdf->setX(187);
$pdf->Cell(30, 6.5, "IVA $iva%  ", 1, 0, 'R');
$pdf->Cell(30, 6.5, number_format($iva_pagar, 2), 1, 'C');

$pdf->Ln();
$pdf->setX(187);
$pdf->Cell(30, 6.5, "DESC $desc%  ", 1, 0, 'R');
$pdf->Cell(30, 6.5, $desc_pagar, 1, 'C');

$pdf->Ln();
$pdf->setX(187);
$pdf->Cell(30, 6.5, "ABONO   ", 1, 0, 'R');
$pdf->Cell(30, 6.5, $venta["abono_facturam"], 1, 'C');

$pdf->Ln();
$pdf->setX(187);
$pdf->Cell(30, 6.5, "TOTAL   ", 1, 0, 'R');
$pdf->Cell(30, 6.5, number_format($pagar, 2), 1, 'C');


$pdf->Output();
?>
