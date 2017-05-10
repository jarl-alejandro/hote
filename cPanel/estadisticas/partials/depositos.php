<div id="deposito" style="margin:1em 0"></div>

<script type="text/javascript">
$(function () {
    $('#deposito').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Depositos'
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
            name: 'Depositos',
            data: [
                <?php 
                  $factura = $pdo->query("SELECT * FROM hotel_facturam WHERE factura_deposito != ''");
                  $restaurante = $pdo->query("SELECT * FROM hotel_restaurante WHERE deposito_restaurante != ''");
                  foreach ($restaurante as $res) { ?>
                    ['Venta al cliente con # de cedula <?= $res["cliente_restaurante"] ?>', <?= $res["total_restaurante"] ?>],

                  <?php } foreach ($factura as $f) { ?>
                    ['<?= $f["detealle_facturam"] ?>', <?= $f["total_facturam"] ?>],
                <?php } ?>
            ]
        }]
    });
});
</script>