<?php
  include '../../../bd/db.php';
  date_default_timezone_set('America/Guayaquil');

  $codigo1 = $_GET["codigo"];

  $reserQuery = $pdo->query("SELECT * FROM hotel_reservaciones WHERE
            codigo_reservacion='$codigo1'");

  $rowReservacion = $reserQuery->fetch();
  $typeIsDep;

  if($rowReservacion["es_reservacion"] == "departamento"){
    $typeIsDep = "departamento";
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
    $typeIsDep = "dejar";
    $dayHosped = (strtotime($rowReservacion["fecha_habitacion"]) -
      strtotime($rowReservacion["hasta_habitacion"]))/86400;

    $dayHosped = abs($dayHosped);
    $dayHosped = floor($dayHosped);
    $hasta_habitacion = $rowReservacion["hasta_habitacion"];
  }

  $queryPram = $pdo->query("SELECT * FROM hotel_parametro WHERE id_parametro='1'");
  $params = $queryPram->fetch();

  $query = $pdo->query("SELECT * FROM vh_factura_g WHERE
                  codigo_reservacion='$codigo1'");
  $factura = $query->fetch();
  $codigo = $factura["codigo_facturam"];

  $total = 0.00;
?>

<section class="col s9">
  <header class="FacturaHeader white z-depth-1 row" style="padding-top:1em;">
    
    <div class="col s8 u-flex-centerV">
      <div class="input-field col s12 m7 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input disabled id="cliente" type="text" class="validate u-no_margin__bottom"
          value="<?= $factura["cliente"] ?>" />
        <label for="cliente" class="active">Cliente</label>
      </div>
      
      <div class="input-field col s12 m5 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input disabled id="cedula" type="text" class="validate u-no_margin__bottom"
          value="<?= $factura["cliente_facturam"] ?>" />
        <label for="cedula" class="active">Cedula</label>
      </div>
    </div>

    <div class="input-field col s12 m4 u-no_margin__top">
      <input disabled id="fecha" type="text" class="validate u-no_margin__bottom"
        value="<?= $rowReservacion["fecha_habitacion"] ?>">
      <label for="fecha" class="active">Fecha que ingreso</label>
    </div>
    <div class="input-field col s12 m8">
      <input id="detalle" class="validate" type="text" disabled value="<?= $factura["detealle_facturam"] ?>" />
      <label for="detalle" class="active">Detalle</label>
    </div>
    <div class="input-field col s12 m4 u-no_margin__top">
      <input disabled id="fecha" type="text" class="validate u-no_margin__bottom"
        value="<?= $hasta_habitacion ?>">
      <label for="fecha" class="active">Fecha de salida</label>
    </div>

    <div class="col s8">
      <div class="input-field col s12 m10 u-no_margin__top" style="margin-left:0;padding-left:0">
        <input disabled id="direccion" type="text" class="validate u-no_margin__bottom"
          value="<?= $factura["direccion_cliente"] ?>" />
        <label for="direccion" class="active">Direccion</label>
      </div>
    </div>

    <div class="input-field col s12 m4 u-no_margin__top">
      <input disabled id="fecha" type="text" class="validate u-no_margin__bottom"
        value="<?= $dayHosped ?>">
      <?php if($rowReservacion["es_reservacion"] == "departamento"){ ?>
        <label for="fecha" class="active">Mes hospedaje</label>
      <?php } else { ?>
        <label for="fecha" class="active">Dias hospedaje</label>
      <?php } ?>
    </div>

    <div class="col s8">
      <div class="input-field col s12 m10 u-no_margin__top">
        <select id="desc-select">
          <option value="0">Nigun descuento</option>
          <option value="<?= $params['desc_familiar'] ?>">Descuento familiar</option>
          <option value="<?= $params['desc_hotel'] ?>">Descuento individual</option>
        </select>
        <!--<label for="desc-select" class="active">Descuento</label>-->
      </div>
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
          $detalles = $pdo->query("SELECT * FROM v_detalle_factura WHERE codigo_facturam='$codigo'");
          foreach ($detalles as $detalle) {
            $total += number_format($detalle["total_facturad"] * $dayHosped, 2);
          ?>
          <tr>
            <td style="10%"><?= $detalle["cant_facturad"] ?></td>
            <td style="70%">Habitacion Nº <?= $detalle["nombre_habitacion"] ?></td>
            <td style="10%;"><?= $detalle["unit_facturad"] ?></td>
            <td style="10%;"><?= number_format($detalle["total_facturad"] * $dayHosped, 2)?></td>
          </tr>
        <?php }
          $ventas = $pdo->query("SELECT * FROM vista_ventaf WHERE codigo_facturam='$codigo'");
          foreach ($ventas as $venta) {
            $total += $venta["total_venta"];
          ?>
            <tr>
              <td style="10%">1</td>
              <td style="70%" class="u-pointer see-ventas" data-id='<?= $venta["codigo_venta"] ?>'>
                <?= $venta["detalle_venta"] ?>
              </td>
              <td style="10%;"><?= $venta["total_venta"] ?></td>
              <td style="10%;"><?= $venta["total_venta"] ?></td>
            </tr>
        <?php } ?>
      </tbody>
      <tbody>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">Sub total</td>
          <td style="10%;font-weight:bold" class="total_factura" id="subtotal">
            <?= number_format($total,2) ?>
          </td>
        </tr>
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">IVA <span id="iva-params"><?=$params["iva_hotel"]?></span>%</td>
          <td style="10%;font-weight:bold" class="total_factura" id="iva-fact">
            <?= $factura["iva_facturam"] ?>
          </td>
        </tr>

        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">DESC <span id="porcent-desc"><?=$factura["desc_tipo"]?></span>%</td>
          <td style="10%;font-weight:bold" class="total_factura" id="descuento-fact">
            <?= $factura["desc_facturam"] ?>
          </td>
        </tr>

        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">Abono $</td>
          <td style="10%;font-weight:bold" class="abonoFact">
            <?php if($factura["abono_facturam"] != ""){
              echo $factura["abono_facturam"];
            } else{
              echo "0.00";
            } ?>
          </td>
        </tr>
        
        <tr>
          <td style="10%"></td>
          <td style="70%"></td>
          <td style="10%;font-weight:bold">Total $</td>
          <td style="10%;font-weight:bold" class="total_factura" id="total-fact">
            <?php 
              $pagar = ($total - $factura["abono_facturam"]) - $factura["desc_facturam"];
              echo number_format($pagar, 2);
            ?>
          </td>
        </tr>
      </tbody>
    </table>
    <input type="hidden" id="total-input" value="<?= number_format($total, 2) ?>">    
    <input type="hidden" id="id-factura" value="<?= $factura["codigo_facturam"] ?>">
    <input type="hidden" id="abono_factura" value="<?= $factura["abono_facturam"] ?>">
    <div class="flex space" style="padding:1em 0;">
      <button class="btn red darken-4 waves-effect waves-light cancelar-factura">Cancelar
        <i class="material-icons right">clear</i>
      </button>
      <button class="btn color-toolbar waves-effect waves-light aceptar-factura"
        data-cedula="<?= $factura["cliente_facturam"] ?>"
        data-reservacion="<?= $factura["codigo_reservacion"] ?>"
        data-codigo="<?= $codigo ?>"
        data-type="<?= $typeIsDep ?>">Aceptar
        <i class="material-icons right">send</i>
      </button>
      <button class="btn btn-primary waves-effect waves-light reporte-fact"
        data-codigo="<?= $factura["codigo_reservacion"] ?>">Imprimir
        <i class="material-icons right">picture_as_pdf</i>
      </button>
    </div>
  </article>
</section>
<section class="row ventas u-none"></section>
<script>

  $.getScript("huespedes/static/js/factura.js")
</script>
