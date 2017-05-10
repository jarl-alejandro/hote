;(function(){
  'use strict'

  var $eliminar = $(".eliminar")
  var $editar = $(".editar")
  var $alertaCancelar = $(".Alerta-cancelar")
  var $alertaEliminar = $(".Alerta-eliminar")
  var $reporte = $(".reporte-table")

  $(".hab-over").on("mouseover", function (e) {
    var type = e.currentTarget.dataset.type
    $("#think").html(type)
  })
  $(".hab-over").on("mouseleave", function (e) {
    $("#think").html("Habitación")
  })

  // Utilidades
  function render_form (data) {
    var ImagenHabitacion = document.querySelector(".Imagen-habitacion")
    $("#habitacion_id").val(data.codigo_habitacion)
    $("#nombre").val(data.nombre_habitacion)
    $("#valor").val(data.valor_habitacion)
    $("#cantidad").val(data.cant_habitacion)
    $("#categoria").val(data.categoria_habitacion)
    $("#detalle").val(data.detalle_habitacion)
    $(".file-path").val(data.imagen_habitacion)
    $("#piso").val(data.piso_habitacion)
    ImagenHabitacion.src = `../media/habitaciones/${data.imagen_habitacion}`
    // $("#imagen").val(data.imagen_habitacion)

    $('select').material_select("update")
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
    // $("#mublesBoton").addClass("u-none")
    
    $(".table").slideUp()
    $(".form").slideDown()
    $.ajax({
      type:"GET",
      data:{ codigo:codigo },
      dataType:"JSON",
      url:"habitacion/servicio/habitacion.php"
    })
    .done(function (data) {
      render_form(data)
      var is = parseInt(data.es_habitacion)
      var depa = document.getElementById("departamento")
      is === 1 ? depa.checked = true : depa.checked = false
    })
  }

  function onAlertaEliminar (e) {
    // var cedula = e.currentTarget.dataset.cedula
    var codigo = $alertaEliminar.data('codigo')
    $.ajax({
      type:"POST",
      url:"habitacion/servicio/eliminar.php",
      data:{ codigo:codigo }
    })
    .done(function (data) {
      if(data == 2) {
        toast("Se ha eliminado con exito")
        onAlertaCancelar()
        $(".table").load('habitacion/partials/table.php')
      }
    })
  }

  function reporte(e) {
    var codigo = e.currentTarget.dataset.codigo
    window.open (`./habitacion/reporte/individual.php?codigo=${codigo}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function build (e) {
    var codigo = e.currentTarget.dataset.codigo
    var build = e.currentTarget.dataset.build

    if(build == 5)
      quitarBuild(codigo)
    else {
      document.getElementById("BuildButton").dataset.codigo = codigo
      $("#BuildModal").slideDown()
    }
  }

  function quitarBuild (codigo) {
    $.ajax({
      type:"POST",
      url:"habitacion/servicio/build.php",
      data: { codigo, value:"" }
    })
    .done(function (res) {
      console.log(res);
      if(res == 2) {
        toast("Su operacion se ha realizado con exito")
        $(".table").load('habitacion/partials/table.php')
      }
    })
  }

  function limpieza (e){
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"habitacion/servicio/limpieza.php",
      data: { codigo:codigo }
    })
    .done(function (res) {
      if(res == 2) {
        toast("Su operacion se ha realizado con exito")
        $(".table").load('habitacion/partials/table.php')
      }
    })
  }

  $eliminar.on("click", onEliminar)
  $editar.on("click", onEditar)
  $alertaCancelar.on("click", onAlertaCancelar)
  $alertaEliminar.on("click", onAlertaEliminar)
  $reporte.on("click", reporte)
  $(".build").on("click", build)
  $(".limpieza").on("click", limpieza)

})()
