<?php 
  date_default_timezone_set('America/Guayaquil');
  include '../../bd/db.php';
  include 'service/fecha.php';

  $fecha = new Fecha();
  $fecha_actual = date("Y/m/d");
  $kardex = $pdo->query("SELECT * FROM vista_kardex");

  $fecha_actual_vliad = date("Y-m-d");
?>
<input type="hidden" id="fecha_actual_vliad" value="<?= $fecha_actual_vliad ?>" />
<div id="container"></div>
<a class="btn-floating btn-large waves-effect waves-light red porfecha">
  <i class="material-icons">access_alarms</i>
</a>
<section class="RotacionFecha white z-depth-1">
  <h5 class="acent-text center-align no-margin" style="margin-bottom:.5em;">Rotacion Por Fecha</h5>
  <div class="row">
    <div class="input-field col s6">
      <input type="date" class="datepicker" id="hasta" min="<?= $fecha_actual ?>">
      <label for="hasta">Hasta</label>
    </div>
    <div class="input-field col s6">
      <input type="date" class="datepicker" id="desde" min="<?= $fecha_actual ?>">
      <label for="desde">Desde</label>
    </div>
  </div>
  <div class="flex space" style="margin-bottom:.5em;">
    <button class="btn waves-effect waves-light rotacion-cerrar red darken-3">Cerrar</button>
    <button class="btn waves-effect waves-light rotacion-aceptar color-toolbar">Aceptar</button>
  </div>
</section>

<script>
  $.getScript("rotacion/static/js/app.js")
</script>
<script>

$(function () {
    $('#container').highcharts({
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 10,
                beta: 25,
                depth: 70
            }
        },
        title: {
            text: 'Rotacion de Inventario.'
        },
        subtitle: {
            text: '<?php echo $fecha->getFecha($fecha_actual); ?>.'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Productos'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.name} : {point.y}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:14px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b><br/>'
        },

        series: [{
            name: 'Producto:',
            colorByPoint: true,
            data: [
            <?php foreach ($kardex as $row):
              $codigo = $row["codigo_kardex"];

              $detalle_incial = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$codigo' 
                ORDER BY id_detalle ASC LIMIT 1");
              $incial = $detalle_incial->fetch();

              $detalle_fin = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$codigo' 
                ORDER BY id_detalle DESC LIMIT 1");
              $fin = $detalle_fin->fetch();

              $entry = 0;
              $output = 0;

              $detalles = $pdo->query("SELECT * FROM detalle_kardex WHERE codigo_kardex='$codigo'");

              foreach ($detalles as $detalle) {
                $entry += $detalle["ent_cant"];
                $output += $detalle["sal_cant"];
              }

              $cant_inicial = $incial["exist_cant"];
              $cant_fin = $fin["exist_cant"];

            ?>
              {
                name: '<?= $row["nombre_producto"] ?>',
                y: <?= $fin["exist_cant"] ?>,
                drilldown: '<?= $row["nombre_producto"] ?>'
              },
            <?php endforeach ?>
            ]
        }]
    });
});
</script>