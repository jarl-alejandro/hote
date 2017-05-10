;(function(){
  'use strict'

  var $huesped = $(".huesped")
  var $alertaCancelar = $(".Alerta-cancelar")
  var $alertaHuesped = $(".Alerta-huesped")
  var $reporte = $(".reporte-table")
  var $pagar = $(".pagar")

  // Eventos
  function onAlertaHuesped (e) {
    var cedula = e.currentTarget.dataset.cedula
    $alertaHuesped.data('cedula', cedula)

    $(".Alerta").slideDown()
    $(".u-oculto").slideDown()
  }

  function onAlertaCancelar () {
    $(".Alerta").slideUp()
    $(".u-oculto").slideUp()
  }

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./huespedes/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function onAbondonarHabitacion () {
    var cedula = $alertaHuesped.data('cedula')

    $.ajax({
      type:"POST",
      url:"huespedes/servicio/dejar.php",
      data:{ cedula:cedula }
    })
    .done(function (data) {
      if(data == 2) {
        toast("Se ha realizado su operacion con exito")
        $(".table-huesped").load('huespedes/partials/table.php')
        onAlertaCancelar()
      } else if(data == 1) {
        toast("Tuvimos problemas")
        console.log(data)
      }
    })
  }

  function pagar (e) {
    var codigo = e.currentTarget.dataset.codigo

    $(".form").load(`huespedes/partials/form.php?codigo=${codigo}`)

    setTimeout(function() {
      $(".table-huesped").slideUp()
      $(".form").slideDown()
    }, 300)

  }

  function salirModal (e){
    var id = e.currentTarget.dataset.codigo
    document.getElementById("aceptarSalir").dataset.id = id
    $("#ModalSalir").slideDown()
  }

  function cancelarSalida (e) {
    var id = e.currentTarget.dataset.codigo
    $.ajax({
      type: "POST",
      url: "huespedes/servicio/cancelarSalida.php",
      data: { id }
    })
    .done(function (snap) {
      console.log(snap)
      if(snap == 2) {
        toast("Se ha cancelado la salida")
        $(".table-huesped").load('huespedes/partials/table.php')
      }
    })
  }

  $alertaCancelar.on("click", onAlertaCancelar)
  $alertaHuesped.on("click", onAbondonarHabitacion)
  $reporte.on("click", reporte)
  $huesped.on("click", onAlertaHuesped)
  $pagar.on("click", pagar)
  $(".salirHabitacion").on("click", salirModal)
  $(".cancelarSalida").on("click", cancelarSalida)

})()
