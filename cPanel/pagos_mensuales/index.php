<?php
  date_default_timezone_set('America/Guayaquil');
  $hoy = date("Y/m/d");
?>
<section>
	<input type="hidden" value="<?= $hoy ?>" id="hoy">
	<article class="table"></article>
	<section class="RotacionFecha white z-depth-1" id="PagosByDate">
		<h5 class="acent-text center-align no-margin" style="margin-bottom:.5em;">
      Pagos mensuales por fecha
    </h5>
		<div class="row">
			<div class="input-field col s6">
				<input type="date" class="datepicker" id="desde" min="<?= $hoy ?>">
				<label for="desde" class="desde_label">Inicio de pagos</label>
			</div>
			<div class="input-field col s6">
				<input type="date" class="datepicker" id="hasta" min="<?= $hoy ?>">
				<label for="hasta" class="hasta_label">Fin de pagos</label>
			</div>
		</div>
		<div class="flex space" style="margin-bottom:.5em;">
			<button class="btn waves-effect waves-light red darken-2" id="Cerrar">Cerrar</button>
			<button class="btn waves-effect waves-light color-toolbar" id="Aceptar">Aceptar</button>
		</div>
	</section>
</section>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
	<a class="btn-floating btn-large red">
		<i class="large material-icons">attach_file</i>
	</a>
	<ul>
		<li>
			<a class="btn-floating yellow darken-1 tooltipped" data-position="left"
				data-delay="50" data-tooltip="Reporte General" id="reporteGeneral">
				<i class="material-icons">picture_as_pdf</i>
			</a>
		</li>
		<li>
			<a class="btn-floating red darken-1 tooltipped" data-position="left"
				data-delay="50" data-tooltip="Pagos por fecha" id="reportByDate">
				<i class="material-icons">access_alarms</i>
			</a>
		</li>
		<li>
			<a class="btn-floating indigo darken-1 tooltipped" data-position="left"
				data-delay="50" data-tooltip="Reporte de pagos por fecha" id="byReport">
				<i class="material-icons">alarm_on</i>
			</a>
		</li>
	</ul>
</div>
<script>
	$.getScript("pagos_mensuales/static/js/componente.js")
</script>
