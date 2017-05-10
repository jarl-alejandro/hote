;(function(){
  'use strict'

  var $alertaCancelar = $(".Alerta-cancelar")
  var $reporte = $(".reporte-table")
  var $ingresar = $(".ingresar")
  var $AlertaIngresar = $(".Alerta-ingresar")


  function onAlertaCancelar () {
    $(".Alerta-ingreso").slideUp()
    $(".u-oculto").slideUp()
  }
  function reporte(e) {
    var cedula = e.currentTarget.dataset.cedula
    window.open (`./pendientes/reporte/individual.php?cedula=${cedula}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function ingresar (e) {
    var cedula = e.currentTarget.dataset.cedula
    $AlertaIngresar.data('cedula', cedula)
    $(".Alerta-ingreso").slideDown()
    $(".u-oculto").slideDown()
  }

  function AlertaIngresar (e) {
    var cedula = $AlertaIngresar.data('cedula')

    $.ajax({
      type:"POST",
      url:"pendientes/servicio/ingresar.php",
      data:{ codigo: cedula }
    })
    .done(function (data) {
      if(data == 2) {
        toast("El cliente ha ingresado.")
        $(".table").load('pendientes/partials/table.php')
        onAlertaCancelar()
      } else if(data == 1) {
        console.log(data)
      }
    })
  }

  $alertaCancelar.on("click", onAlertaCancelar)
  $reporte.on("click", reporte)
  $ingresar.on("click", ingresar)
  $AlertaIngresar.on("click", AlertaIngresar)

})()