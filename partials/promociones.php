<section class="PromocionesHome white z-depth-1 col s12 m11">
  <h4 class="acent-text no-margin center-align" style="margin-bottom:1em;">Promociónes</h4>
  <?php 
  $habitacion = $pdo->query("SELECT * FROM vista_habitacion WHERE estado_promocion='promocion'");
  foreach ($habitacion as $row) : 
    include 'habitacion.php'; ?>
  <?php endforeach ?>
  <div class="flex space" style="margin-bottom: 1em;">
    <button class="btn red darken 4 waves-effect waves-light cerrar-promociones">Cerrar</button>
  </div>
</section>