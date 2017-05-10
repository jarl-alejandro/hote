;(function(){
  'use strict'

  var $eliminar = $(".eliminar")
  var $editar = $(".editar")
  var $alertaCancelar = $(".Alerta-cancelar")
  var $alertaEliminar = $(".Alerta-eliminar")
  var $reporte = $(".reporte-table")

  // Utilidades
  function render_form (data) {
    $("#moneda_id").val(data.codigo_moneda)
    $("#moneda").val(data.desc_moneda)
    $("#categoria").val(data.categoria_moneda)
  $('select').material_select("update");
    $(".validate").addClass("valid")
    $(".field-label").addClass("active")
  }

  // Eventos
  function onEliminar (e) {
    var codigo = e.currentTarget.dataset.codigo
    $alertaEliminar.data('codigo', codigo)

    $(".Alerta").slideDown()
    $(".u-oculto").slideDown()
  }

  function onAlertaCancelar () {
    $(".Alerta").slideUp()
    $(".u-oculto").slideUp()
  }

  function onEditar (e) {
    var codigo = e.currentTarget.dataset.codigo
    $(".table").slideUp()
    $(".form").slideDown()
    $.ajax({
      type:"GET",
      data:{ codigo:codigo },
      dataType:"JSON",
      url:"monedas/servicio/monedas.php"
    })
    .done(function (data) {
      render_form(data)
    })
  }

  function onAlertaEliminar (e) {
    // var cedula = e.currentTarget.dataset.cedula
    var codigo = $alertaEliminar.data('codigo')
    $.ajax({
      type:"POST",
      url:"monedas/servicio/eliminar.php",
      data:{ codigo:codigo }
    })
    .done(function (data) {
      console.log(data)
      if(data == 2) {
        toast("Se ha eliminado con exito")
        onAlertaCancelar()
        $(".table").load('monedas/partials/table.php')
      }
    })
  }

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./monedas/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }


  $eliminar.on("click", onEliminar)
  $editar.on("click", onEditar)
  $alertaCancelar.on("click", onAlertaCancelar)
  $alertaEliminar.on("click", onAlertaEliminar)
  $reporte.on("click", reporte)
})()