;(function () {
  'use strict'

  $('.datepicker').pickadate({
     selectMonths: true, // Creates a dropdown to control month
     selectYears: 15 // Creates a dropdown of 15 years to control year
      max: $("#fecha_actual_vliad").val()
   });

  var $rotacionCerrar = $(".rotacion-cerrar")
  var $rotacionAceptar = $(".rotacion-aceptar")
  var $porFecha = $(".porfecha")

  // Inputs

  var $hasta = $("#hasta")
  var $desde = $("#desde")

  function rotacionCerrar () {
    $(".RotacionFecha").slideUp()
  }
  function rotacionAceptar () {
    $(".RotacionFecha").slideUp()
  }
  function porFecha () {
    $(".RotacionFecha").slideDown()
  }

  $rotacionCerrar.on("click", rotacionCerrar)
  $rotacionAceptar.on("click", rotacionAceptar)
  $porFecha.on("click", porFecha)

})()