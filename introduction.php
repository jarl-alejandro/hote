<?php
session_start();
if(isset($_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"])){
  $tipo = $_SESSION["db78ff0a8439032f661fe9f0a13e09c2c5a7c435"];

  if ($tipo == "socio"){
    // header("Location: index.php");

  } else if ($tipo == "empleado"){
    header("Location: cPanel");
  }
}
 include 'header.php';?>
<style>
  .container {
    width: 80% !important;
  }
  .rigth-menu {
    /*margin-right: 16em !important;*/
  }
  .menu-login{
    display: none;
  }
</style>
<div class="container">
 <div class="row" style="display:flex;justify-content: space-around;flex-wrap: wrap;">
  <div class="col-sm-6 paper z-depth-1" style="margin-top: 2em;">
    <h4 class="center-align text-cinta">Visión</h4>
    <p>
      Convertirnos en una empresa con sólido prestigio hotelero a nivel local, nacional e internacional, fomentando el desarrollo turístico del recinto las  Golondrinas; ofreciendo servicios personalizados que permitan el bienestar de nuestros clientes. Siempre comprometidos a través de la mejora continua dentro de un marco de cultura y hospitalidad Golondrineses
    </p>
  </div>
  <div class="col-sm-5 paper z-depth-1" style="margin-top: 2em;">
    <h4 class="center-align text-cinta">Misión</h4>
    <p>
      Ofrecer servicios hoteleros de excelencia, creando clientes leales y satisfechos que regresen al hotel por su calidad y servicio, ya que estos constituyen la clave del éxito. Preocupándonos por la valorización de nuestros empleados y beneficio de la sociedad
    </p>
  </div>
  <div class="col-sm-6 paper col-sm-offset-3 z-depth-1" style="margin-top: 2em;margin-left: 16em;">
    <h4 class="center-align text-cinta">Objetivo institucional</h4>
    <p>
      Satisfacer  las  necesidades  de  la  comunidad  con  transparencia,  equidad  y Participación ciudadana, comprometiéndonos con el desarrollo del Recinto las Golondrinas y de su futuro; siendo ejemplo de excelencia en la Gestión hotelera manteniendo la ideología de respeto a la naturaleza y la construcción del  buen vivir  de su comunidad.
    </p>
  </div>
</div>

  <div class="spacer">
   <div class="embed-responsive embed-responsive-16by9"><iframe  class="embed-responsive-item" src="//player.vimeo.com/video/55057393?title=0" width="100%" height="400" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe></div>
  </div>





</div>
<?php include 'footer.php';?>
