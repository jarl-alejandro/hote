;(function(){
  'use strict'

  var $anular = $(".anular")

  function anular (e) {
    var codigo = e.currentTarget.dataset.codigo
    document.getElementById("Alerta-anular").dataset.codigo = codigo
    $(".Alerta").slideDown()
  }

  function anularVenta (e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"anular_compra/servicio/anular.php",
      dataType:"JSON",
      data: { codigo }
    })
    .done(function (response) {
      console.log(response)
      if (response[0].status === 200) {
        $(".Alerta").slideUp()
        $(".facturas-table").load('anular_compra/partials/table.php')
      }
    })
  }

  $anular.on("click", anular)
  $("#Alerta-anular").on("click", anularVenta)

  $(".Alerta-cancelar").on("click", function () {
    $(".Alerta").slideUp()
  })
})()