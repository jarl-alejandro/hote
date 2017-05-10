;(function () {
  'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('select').material_select()
  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    min:$("#fecha_actual").val()
  })

  $("#dias--quedar").keyup(GroupApp.handlerDaysStay)
  $(".numeroHabitacion").on("click", GroupApp.reserveRoom)
  $(".cancelar-btn").on("click", GroupApp.cancelReserve)
  $(".reservacion-btn").on("click", GroupApp.aceptReserve)

  $(".numberHabi").on("click" , function (e) {
    var type = e.currentTarget.dataset.type
   	toast(`La habitacion no esta disponible por ${type}`)
  })

})()
