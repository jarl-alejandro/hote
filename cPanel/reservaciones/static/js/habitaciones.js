;(function () {
  'use strict'

  var $reservarHabitacion = $(".reservarHabitacion")
  var $maxima_personas = $("#maxi_habitacion")

  $reservarHabitacion.on("click", reservarHabitacion)

  function reservarHabitacion(e) {
    var aceptar = document.querySelector(".aceptar-form")

    var codigo = e.currentTarget.dataset.codigo
    var categoria = e.currentTarget.dataset.categoria
    var habitacion = e.currentTarget.dataset.habitacion
    var valor = e.currentTarget.dataset.valor
    var cant = e.currentTarget.dataset.cant

    aceptar.dataset.codigo = codigo
    aceptar.dataset.categoria = categoria
    aceptar.dataset.habitacion = habitacion
    aceptar.dataset.valor = valor
    $maxima_personas.html(cant)

    $(".HabitacionForm").slideDown()
    $(".u-oculto").slideDown()
  }

  $("#closeHabitacion").click(function () {
    $(".u-oculto").slideToggle()
    $(".habitacion-modal").html("")
  })

})()