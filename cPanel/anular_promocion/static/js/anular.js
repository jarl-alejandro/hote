;(function () {

  'use strict'

  var $anular_promocion = $(".anular_promocion")

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  function anular_promocion (e) {
    var id = e.currentTarget.dataset.codigo
    var valor = e.currentTarget.dataset.valor
    $.ajax({
      type:"POST",
      url:"anular_promocion/servicio/anular.php",
      data:{ id:id, valor:valor }
    })
    .done(function (data) {
      if(data == 2) {
        $(".Layout").load('anular_promocion')
        toast("Se ha realizadocon exito")
      } 
      else console.log(data)
    })
  }

  $anular_promocion.on("click", anular_promocion)

})()