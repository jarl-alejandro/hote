;(function(){
  'use strict'

  var $eliminar = $(".eliminar")
  var $editar = $(".editar")
  var $alertaCancelar = $(".Alerta-cancelar")
  var $alertaEliminar = $(".Alerta-eliminar")
  var $reporte = $(".reporte-table")

  // Utilidades
  function render_form (data) {
    $("#cedula_id").val(data.cedula_empleado)
    $("#cedula").val(data.cedula_empleado)
    $("#nombre").val(data.nombre_empleado)
    $("#apellido").val(data.apellido_empleado)
    $("#email").val(data.email_empleado)
    $("#telefono").val(data.telefono_empleado)
    $("#celular").val(data.celular_empleado)
    $("#direccion").val(data.direccion_empleado)
    $("#cargo").val(data.cargo_empleado)
    $('select').material_select('update')
    $(".validate").addClass("valid")
    $(".field-label").addClass("active")
  }

  // Eventos
  function onEliminar (e) {
    var cedula = e.currentTarget.dataset.cedula
    $alertaEliminar.data('cedula', cedula)

    $(".Alerta").slideDown()
    $(".u-oculto").slideDown()
  }

  function onAlertaCancelar () {
    $(".Alerta").slideUp()
    $(".u-oculto").slideUp()
  }

  function onEditar (e) {
    var cedula = e.currentTarget.dataset.cedula
    $(".table").slideUp()
    $(".form").slideDown()
    $.ajax({
      type:"GET",
      data:{ cedula:cedula },
      dataType:"JSON",
      url:"empleados/servicio/empleado.php"
    })
    .done(function (data) {
      render_form(data)
    })
  }

  function onAlertaEliminar (e) {
    // var cedula = e.currentTarget.dataset.cedula
    var cedula = $alertaEliminar.data('cedula')
    $.ajax({
      type:"POST",
      url:"empleados/servicio/eliminar.php",
      data:{ cedula:cedula }
    })
    .done(function (data) {
      console.log(data)
      if(data == 2) {
        toast("Se ha eliminado con exito")
        onAlertaCancelar()
        $(".table").load('empleados/partials/table.php')
      }
    })
  }

  function reporte(e) {
    var cedula = e.currentTarget.dataset.cedula
    window.open (`./empleados/reporte/individual.php?cedula=${cedula}`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }


  $eliminar.on("click", onEliminar)
  $editar.on("click", onEditar)
  $alertaCancelar.on("click", onAlertaCancelar)
  $alertaEliminar.on("click", onAlertaEliminar)
  $reporte.on("click", reporte)
})()