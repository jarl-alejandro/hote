<?php
  date_default_timezone_set('America/Guayaquil');
  $hoy = date("Y/m/d");
	$fecha_actual = date("Y-m-d");
?>
<input type="hidden" id="fecha_desde">
<input type="hidden" id="fecha_actual" value="<?= $fecha_actual ?>" />
<section>
	<input type="hidden" value="<?= $hoy ?>" id="hoy">
	<article class="table"></article>
  <div class="flex space col s9 offset-m2" style="margin-top:1em">
    <button class="btn waves-effect waves-light cierre-parcial">Cierre Parcial</button>
  </div>
	<section class="RotacionFecha white z-depth-1" id="PagosByDate">
		<h5 class="acent-text center-align no-margin" style="margin-bottom:.5em;">
      compras por fecha
    </h5>
		<div class="row">
			<div class="input-field col s12 m6 push-m3 ">
				<input type="date" class="datepicker" id="desde">
				<label for="desde" class="desde_label">Ingrese la fecha que desea el cierre diario</label>
			</div>
			<!--<div class="input-field col s6">
				<input type="date" class="datepicker" id="hasta" min="<?= $hoy ?>">
				<label for="hasta" class="hasta_label">Fin de compras</label>
			</div>
		</div>-->
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
		<!--<li>
			<a class="btn-floating yellow darken-1 tooltipped" data-position="left"
				data-delay="50" data-tooltip="Reporte General" id="reporteGeneral">
				<i class="material-icons">picture_as_pdf</i>
			</a>
		</li>-->
		<li>
			<a class="btn-floating red darken-1 tooltipped" data-position="left"
				data-delay="50" data-tooltip="cierre diario por fecha" id="reportByDate">
				<i class="material-icons">access_alarms</i>
			</a>
		</li>
		<!--<li>
			<a class="btn-floating indigo darken-1 tooltipped" data-position="left"
				data-delay="50" data-tooltip="Reporte de compras por fecha" id="byReport">
				<i class="material-icons">alarm_on</i>
			</a>
		</li>-->
	</ul>
</div>
<script>
	$.getScript("cierra-parcial-fecha/static/js/componente.js")
</script>
