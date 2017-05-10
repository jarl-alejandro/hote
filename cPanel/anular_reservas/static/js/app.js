;(function(){
  'use strict'

  var $anular = $(".anular")

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  function anular (e) {
    var codigo = e.currentTarget.dataset.codigo
    document.getElementById("Alerta-anular").dataset.codigo = codigo
    $(".Alerta").slideDown()
  }

  function anularVenta (e) {
    var codigo = e.currentTarget.dataset.codigo
    $.ajax({
      type:"POST",
      url:"anular_reservas/servicio/anular.php",
      dataType:"JSON",
      data: { codigo }
    })
    .done(function (response) {
      console.log(response)
      if (response == 2) {
        $(".Alerta").slideUp()
        $(".Layout").load('anular_reservas/index.php')
      }
    })
  }

  $anular.on("click", anular)
  $("#Alerta-anular").on("click", anularVenta)

  $(".Alerta-cancelar").on("click", function () {
    $(".Alerta").slideUp()
  })
})()