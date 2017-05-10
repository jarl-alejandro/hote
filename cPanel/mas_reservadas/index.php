<?php
include '../../bd/db.php';

$habQuery = $pdo->query("SELECT codigo_habitacion, COUNT(*) as count
          FROM detalle_reservaciones GROUP BY codigo_habitacion
          ORDER BY count DESC");
?>
<div id="container" style="margin:1em 0"></div>

<script type="text/javascript">
$(function () {
  Highcharts.chart('container', {
       chart: {
           type: 'column'
       },
       title: {
           text: 'Habitación Mas Reservadas'
       },
       subtitle: {
           text: ''
       },
       xAxis: {
           type: 'category'
       },
       yAxis: {
           title: {
               text: 'Habitación Mas Reservadas'
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
                   format: '{point.y:.1f}%'
               }
           }
       },

       tooltip: {
           headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
           pointFormat: '<span style="color:{point.color}">{point.name}</span><br/>'
       },

       series: [{
           name: 'Habitacion',
           colorByPoint: true,
           data: [
            <?php
              while($row = $habQuery->fetch()){
            ?>
            {
              name: 'N° <?= $row["codigo_habitacion"] ?>',
              y: <?= $row["count"] ?>,
              drilldown: null
            },
            <?php } ?>
          ]
       }],
       drilldown: {
           series: []
       }
   });
});
</script>
