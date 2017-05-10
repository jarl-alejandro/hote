<div class='slider-inner'>
<?php
$habitaciones = $pdo->query("SELECT * FROM vista_habitacion WHERE
                                  estado_promocion='promocion'");
if($habitaciones->rowCount() == 0) {?>
<style>
.slider-left{
  width: 0;
}
.banner {
  width: 100%;
}
</style>
<?php } else {
echo '<div class="btn--promociones z-depth-1">Promociones</div>';
foreach($habitaciones as $row) {?>
  <section class="slider-habi reservarHabitacion z-depth-1"
    data-codigo="<?= $row["codigo_habitacion"] ?>" data-categoria="<?= $row["nombre_categoria"] ?>"
    data-habitacion="<?= $row["nombre_habitacion"] ?>" id="boton<?= $row["codigo_habitacion"] ?>"
    data-valor="<?= $row["valor_habitacion"] ?>" data-cant="<?= $row["cant_habitacion"] ?>">
    <img src="media/habitaciones/<?= $row["imagen_habitacion"] ?>" />
  </section>
<?php }
} ?>
</div>
