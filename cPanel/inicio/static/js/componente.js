;(function (){
	'use strict'
  // $(".Notificaciones").load('partials/acabados.php')

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerHTML = label.innerHTML + " *"
	}

  $('input, textarea').characterCounter();

  $('select').material_select()

  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15,
    min:$("#fecha_actual").val()
  })

	$("#dias--quedar").keyup(function () {
		setTimeout(function () {
			var daysStay = parseInt($("#dias--quedar").val())
			var fecha = new Date($("#fecha").val())
      
			fecha.setDate(fecha.getDate() + daysStay)

			var newDate = `${fecha.getFullYear()}-${fecha.getMonth()+1}-${fecha.getDate()}`
			$("#dayHosped").html(newDate)
		}.bind(this), 300)
	})

  $('.tooltipped').tooltip({delay: 50});
	$('.modal-trigger').leanModal();

  var $habitacionesDisponibles = $(".habitaciones-disponibles")
  var $habitacionesOcupadas = $(".habitaciones-ocupadas")
  var $new_cliente = $(".new_cliente")
	var $showPanel = $("#ShowPanel")
  var $numeroHabitacion = $(".numeroHabitacion")
  var $ImageAvatar = $("#avatar_input")
  var $passwordInput = $("#password-input")
  var $password = $("#password")

  function habitacionesDisponibles (e) {
    $(".habitacionesContainer").slideUp()

    $(".habitacionesContainer").load("inicio/partials/disponibles.php")
    setTimeout(function (){
      $(".habitacionesContainer").slideDown()
    }, 200)
  }

  function habitacionesOcupadas (e) {
    $(".habitacionesContainer").slideUp()

    $(".habitacionesContainer").load("inicio/partials/ocupados.php")
    setTimeout(function (){
      $(".habitacionesContainer").slideDown()
    }, 200)
  }

  function new_cliente ()  {
    $(".formCliente").slideDown()
    $(".inicio-alquiler").slideUp()
  }

	function showPanel () {
		$(".u-oculto").slideToggle()
    $(".Reservas-formularios").slideToggle()
	}

  function numeroHabitacion (e) {
    var id = e.currentTarget.dataset.id
    $(".u-oculto").slideToggle()
    $(".habitacion-modal").load(`inicio/partials/habitaciones.php?id=${id}`)
  }

  function ImageAvatar () {
    if(validarImage()) {
      var avatar = document.querySelector("#avatar_input")
      var formData = new FormData()
      formData.append("avatar", avatar.files[0])

      $.ajax({
        type:"POST",
        url:"inicio/servicio/guardar_avatar.php",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function (data) {
        console.log(data)
        $(".Layout").slideUp()
        $(".Layout").load('inicio')
        toast("Ha cambiado con exito su avatar.")

        setTimeout(function () {
         $(".Layout").slideDown()
        }, 2000)

      })
    }
  }

  function passwordInput () {
    if(validarPassword()) {
      $.ajax({
        type:"POST",
        url:"inicio/servicio/guardar_password.php",
        data: { password:$password.val() }
      })
      .done(function (data) {
        console.log(data)
        $password.val("")
        $(".PasswordSection").slideUp()
        toast("Ha cambiado con exito su contraseña.")
        $("#pass-label").removeClass("active")
        $("#password").removeClass("valid")
      })
    }
  }

  function validarPassword () {
    var flag = false

    if( $password.val() === "" || /^\s*$/.test($password.val())) {
      toast("Por favor ingrese su nueva contraseña")
      $password.focus()
    }
    else flag = true

    return flag
  }

  function validarImage () {
    var flag = false
    var avatar = document.querySelector("#avatar_input")
    if($ImageAvatar.val() === "") {
      toast("Por favor ingrese una imagen")
    }
    else flag = true
    return flag
  }

  $habitacionesDisponibles.on("click", habitacionesDisponibles)
  $habitacionesOcupadas.on("click", habitacionesOcupadas)
  $new_cliente.on("click", new_cliente)
	$showPanel.on("click", showPanel)
  $numeroHabitacion.on("click", numeroHabitacion)
  $ImageAvatar.on("change", ImageAvatar)
  $passwordInput.on("click", passwordInput)

	$("#new-client").click(function (){
		$('#newClient').openModal();
	})

	$("#shoMapa").click(function () {
		$('#mapaHabitaciones').openModal();
	})

	$("#cerrarMapa").click(function () {
		$('#mapaHabitaciones').closeModal();
	})

	$(".disponible-map").click(function () {
		$(".MapaDisponible").slideDown()
		$(".MantenimientoMap").slideUp()
    $(".MapOcupados").slideUp()
		$(".MapaResevada").slideUp()
    $(".LimpiezaMap").slideUp()
	})

	$(".ocupados-map").click(function () {
		$(".MapaDisponible").slideUp()
		$(".MantenimientoMap").slideUp()
		$(".MapOcupados").slideDown()
    $(".MapaResevada").slideUp()
    $(".LimpiezaMap").slideUp()
	})

  $(".reservadas-map").click(function () {
    $(".MapaDisponible").slideUp()
    $(".MantenimientoMap").slideUp()
    $(".MapOcupados").slideUp()
    $(".MapaResevada").slideDown()
    $(".LimpiezaMap").slideUp()
  })

  $(".mantenimiento-map").click(function () {
    $(".MapaResevada").slideUp()
    $(".MapaDisponible").slideUp()
    $(".MantenimientoMap").slideDown()
    $(".MapOcupados").slideUp()
     $(".LimpiezaMap").slideUp()
  })

  $(".limpieza-map").click(function () {
    $(".MapaResevada").slideUp()
    $(".MapaDisponible").slideUp()
    $(".MantenimientoMap").slideUp()
    $(".LimpiezaMap").slideDown()
    $(".MapOcupados").slideUp()
  })

	$(".todos-map").click(function () {
		$(".MapaDisponible").slideDown()
		$(".MantenimientoMap").slideDown()
		$(".MapOcupados").slideDown()
    $(".MapaResevada").slideDown()
     $(".LimpiezaMap").slideDown()
	})

  $("#porSalir").click(function () {
    window.open (`./inicio/reporte/porSalir.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  $("#reservacionesSemanales").click(function () {
    window.open (`./inicio/reporte/reservacionesSemanales.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  })

  $("#showPassword").on("click", function () {
    $(".PasswordSection").slideToggle()
  })

  $("#password-close").on("click" , function () {
    $(".PasswordSection").slideUp()
  })

  $(".numberHabi").on("click" , function (e) {
    var type = e.currentTarget.dataset.type
   	toast(`La habitacion no esta disponible por ${type}`)
  })

  $(".retornar").on("click", function () {
    $(".u-oculto").slideToggle()
    $(".Reservas-formularios").slideToggle()
  })


})()
