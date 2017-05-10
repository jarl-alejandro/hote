<div id="container" style="margin:1em 0"></div>

<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Estadisticas de ingresos'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Ingresos',
            data: [
                <?php
                  $factura = $pdo->query("SELECT * FROM hotel_facturam WHERE factura_estado='pagado'");
                  $restaurante = $pdo->query("SELECT * FROM hotel_restaurante GROUP BY cliente_restaurante");
                  $mensuales = $pdo->query("SELECT * FROM v_pagos_mensuales");

                  foreach ($restaurante as $res) { ?>
                    ['Venta al cliente con # de cedula <?= $res["cliente_restaurante"] ?>', <?= $res["total_restaurante"] ?>],

                  <?php } foreach ($factura as $f) { ?>
                    ['<?= $f["detealle_facturam"] ?>', <?= $f["total_facturam"] ?>],
                <?php } foreach ($mensuales as $m) { ?>
                    ['<?= "Pago mensual por ". $m["cliente"] ?>', <?= $m["mensual_precio"] ?>],                
                <?php } ?>
            ]
        }]
    });
});
</script>