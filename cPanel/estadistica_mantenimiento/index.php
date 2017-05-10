<?php
include '../../bd/db.php';
?>
<div id="container" style="margin:1em 0"></div>

<script type="text/javascript">
$(function () {
  Highcharts.chart('container', {
       chart: {
           type: 'column'
       },
       title: {
           text: 'Habitación En Mantenimiento'
       },
       subtitle: {
           text: ''
       },
       xAxis: {
           type: 'category'
       },
       yAxis: {
           title: {
               text: 'Habitación en mantenimiento'
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
           name: 'Habitación',
           colorByPoint: true,
           data: [
            <?php
              $tmp = $pdo->query("SELECT * FROM vista_mant");
              while($row = $tmp->fetch()){
            ?>
            {
              name: 'N° <?= $row["nombre_habitacion"] ?>',
              y: <?= $row["total"] ?>,
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
