<?php
  include '../../../bd/db.php';
  $codigo = $_GET["venta"];

$row = $pdo->query("SELECT * FROM vista_ventaf WHERE codigo_venta='$codigo'");
$venta = $row->fetch();
?>
<section class="col s9 ventas-row">
  <header class="FacturaHeader white z-depth-1 row" style="padding-top:1em;">
    <div class="col s8 u-flex-centerV">
      <div class="input-field col s12 m10 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input disabled id="habitacion" type="text" class="validate u-no_margin__bottom" 
          value="Habitacion Nº <?= $venta["nombre_habitacion"] ?>" />
        <label for="habitacion" class="active">Habitacion</label>
      </div>
    </div>
    <div class="input-field col s12 m4 u-no_margin__top">
      <input disabled id="fecha" type="text" class="validate u-no_margin__bottom" 
        value="<?= $venta["fecha_venta"] ?>">
      <label for="fecha" class="active">Fecha</label>
    </div>
    <div class="input-field col s12 m8">
      <input id="detalle" class="validate" type="text" disabled value="<?= $venta["detalle_venta"] ?>" />
      <label for="detalle" class="active">Detalle</label>
    </div>
  </header>
  <article class="FacturaBody white z-depth-1">
    <table class="table striped centered bordered">
      <thead class="color-acent white-text">
        <tr>
          <th style="width:10%">Cant</th>
          <th style="width:70%">Detalle</th>
          <th style="width:10%">V. Unit</th>
          <th style="width:10%">V. Total</th>
        </tr>
      </thead>
      <tbody id="facturat_tbody">
        <?php
          $details_ventas = $pdo->query("SELECT * FROM vista_ventas WHERE codigo_ventad='$codigo'");
          foreach ($details_ventas as $detail) { ?>
          <tr>
            <td style="10%"><?= $detail["cant_ventad"] ?></td>
            <td style="70%"><?= $detail["nombre_producto"] ?></td>
            <td style="10%;"><?= $detail["unit_vantad"] ?></td>
            <td style="10%;"><?= $detail["total_ventad"] ?></td>
          </tr>
        <?php } ?>
      </tbody>
      <tbody>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">Total $</td>
          <td style="10%;font-weight:bold" class="total_factura"><?= $venta["total_venta"] ?></td>
        </tr>
      </tbody>
    </table>
    <div class="flex space" style="padding:1em 0;">
      <button class="btn color-toolbar waves-effect waves-light aceptar-ventas">Aceptar
        <i class="material-icons right">send</i>
      </button>
      <button class="btn color-toolbar waves-effect waves-light reporte-ventas" 
        data-codigo="<?= $venta["codigo_venta"] ?>">Reporte
        <i class="material-icons right">picture_as_pdf</i>
      </button>
    </div>
  </article>
</section>
<script>
  $.getScript("huespedes/static/js/ventas.js")
</script>