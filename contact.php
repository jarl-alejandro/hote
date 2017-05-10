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
 <style media="screen">
 .menu-login{
   display: none;
 }
 </style>
<div class="container">

  <h1 class="title">Contactanos</h1>


  <!-- form -->
  <div class="contact">



   <div class="row">

    <div class="col-sm-12">
      <div class="map">
       <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31918.03727861707!2d-79.48659927031233!3d0.3236657348863888!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8fd535d7e9b0e16d%3A0xad773fd7dc976a2c!2sQuinind%C3%A9%2C+Ecuador!5e0!3m2!1ses!2snp!4v1493576721019" width="900" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
      </div>

 <!--col-sm-offset-3-->
    <div class="col-sm-6">
       <div class="spacer">
         <h4 class="" style="font-weight: bold;">Escribenos:</h4>
         <form role="form">

           <div class="form-group">
             <input type="email" class="form-control" id="email" placeholder="email">
           </div>
           <div class="form-group">
             <textarea id="mensaje" class="form-control"  placeholder="Mensaje" rows="4"></textarea>
           </div>

           <button id="submit-email" class="btn btn-default">Enviar</button>
         </form>
       </div>
    </div>
    <div class="col-sm-6">
        <div class="spacer">
         <h4 class="center-align" style="font-weight: bold;">Contactanos</h4>
          <div class="direccion">
            <h5 class="center-align" style="font-weight: bold;">Direccion:</h5>
            <p class="center-align">Recinto las Golondrinas calle principal Alias Guerrero e Ibarra  Av.La T tras el comisariato las Golondrinas</p>
          </div>
          <div class="telefono">
            <h5 class="center-align"><strong>Telefonos:</strong> (06)2670-133</h5>
            <h5 class="center-align"><strong>Celular:</strong> 0981639486</h5>
          </div>
          <div class="email">
            <h5 class="center-align">
              <strong>E-mail:</strong> hotelmadisonreservas@hotmail.com
            </h5>
            <h5 class="center-align"></h5>
          </div>
          <h5 class="city">LAS GOLONDRINAS-ECUADOR</h5>
        </div>
    </div>





   </div>
 </div>
</div>
<!-- form -->

</div>
<?php include 'footer.php';?>
