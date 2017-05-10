<div id="container_egreso" style="margin:1em 0"></div>

<script type="text/javascript">
$(function () {
    $('#container_egreso').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45,
                beta: 0
            }
        },
        title: {
            text: 'Estadisticas de Egresos'
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
            name: 'Egresos',
            data: [
               <?php
                 $egresos = $pdo->query("SELECT * FROM hotel_egreso");
                   foreach ($egresos as $e) { ?>
                   ['<?= $e["referencia_egreso"] ?>', <?= $e["valor_egreso"] ?>],

               <?php } ?>
            ]
        }]
    });
});
</script>
