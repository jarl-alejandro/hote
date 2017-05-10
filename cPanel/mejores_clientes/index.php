<?php 
include '../../bd/db.php';
?>
<div id="container" style="margin:1em 0"></div>
<a class="waves-effect waves-light btn" id="modalBtn"><i class="material-icons left">email</i>Clientes</a>
<div id="modalClient" class="modal">
	<div class="modal-content">
		<h4>Enviar e-mail para avisar de promociones</h4>
		<div class="input-field col s12">
			<textarea id="mensaje" class="materialize-textarea"></textarea>
			<label for="mensaje">Escribe el mensaje que deseas enviar los mejores clientes</label>
		</div>
	</div>
	<div class="modal-footer">
	<a href="#!" class="modal-action modal-close waves-effect waves-green btn red darken-2" id="close">Cerrar</a>
	<a href="#!" class="modal-action modal-close waves-effect waves-green btn color-toolbar margin-right" id="enviar">Enviar</a>
	</div>
</div>

<script type="text/javascript" src="mejores_clientes/app.js"></script>
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
				text: 'MEJORES CLIENTES'
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
				name: 'Cliente',
				data: [
				<?php
					// $factura = $pdo->query("SELECT * FROM vista_factura ");
				$mejores = $pdo->query("SELECT * FROM v_mejores_clientes");

				while ($row = $mejores->fetch()) { ?>
					['<?= $row["cliente"] ?>', <?= $row["total"] ?>],
					<?php } ?>
					]
				}]
			});
	});
</script>