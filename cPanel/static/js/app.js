;(function (){
	'use strict'

	// $("form")[0].reset()


  $('.tooltipped').tooltip({delay: 50, html:true})

	window.onload = function () {
    var cargoEmploy = $("#cargoEmploy").val()

    if(cargoEmploy == "vendedor") {
      $(".title-layout").html("Punto de Venta")
      $(".Layout").load('restaurante')
    }
    if (cargoEmploy == "contador") {
      $(".title-layout").html("Inventario")
      $(".Layout").load('inventario')
    }
    if (cargoEmploy == "administrador" || cargoEmploy == "recepcionista") {
      $(".title-layout").html("Alquiler de habitaciones")
			$(".Layout").load('inicio')
      $("#parametroContainer").load('parametros.php')
    }

    // $(".Layout").load('estadisticas')
	}

	var $buttonToolbar = $(".Header-button--toolbar")
	var $toolbar = $(".Toolbar")
	var $u_ocultar = $(".u-ocultar")
  var $page_item = $(".Toolbar-menu--item a")
	var $btn_atajos = $(".btn-atajos")
  var $buscador = $(".Header-buscador label")
  var $close_buscador = $(".close_buscador")
  var $printReport = $(".print-r")

  $buttonToolbar.on("click", onToolbar)
  $u_ocultar.on("click", onToolbar)
  $page_item.on("click", onChangePage)
  $btn_atajos.on("click", onAtajos)
  $buscador.on("click", onBuscar)
  $close_buscador.on("click", onCloseBuscador)
  $printReport.on("click", printReport)
	$btn_atajos.mouseover(overToolHelper)
	$btn_atajos.mouseleave(leaveToolHelper)

	$(".printL").mouseover(overToolHelper)
	$(".printL").mouseleave(leaveToolHelper)

	$("#parametros").mouseover(overToolHelper)	
	$("#parametros").mouseleave(leaveToolHelper)	
	$("#parametros").on("click", handleParametros)

	function handleParametros (e) {
		e.preventDefault()
		$("#modal-parametros").slideDown()
	}

	function overToolHelper (e) {
		var message = e.currentTarget.dataset.message
		var el = $(this)

		if(el.parent().children()[1] == undefined) {
			var toolhelper = `<span class="toolhelper z-depth-1">${message}</span>`
			el.parent().append(toolhelper)
			$(el.parent().children()[1]).slideDown()

		} else $(el.parent().children()[1]).slideDown()

	}

	function leaveToolHelper() {
		$(".toolhelper").slideUp()
	}

  $(".printL").on("click", function () {
    $(".ReportList").slideDown()
  })

  $(".print-cerrar").on("click", function () {
    $(".ReportList").slideUp()
  })

	$(".rep--hab").on("click", function (e) {
		var reporte = e.currentTarget.dataset.r
		window.open (`./habitacion/reporte/${reporte}.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
	})

	$(".print-init").on("click", function (e) {
		var reporte = e.currentTarget.dataset.r
		window.open (`./inicio/reporte/${reporte}.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
	})

  function printReport (e) {
    var reporte = e.currentTarget.dataset.r
    window.open (`./${reporte}/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

  function onBuscar () {
    $(".Header-buscador").addClass("Header-buscador--activo")
  }

  function onCloseBuscador () {
    $("#buscador").val("")
    $(".Header-buscador").removeClass("Header-buscador--activo")
  }

	function onChangePage(ev) {
		var page = ev.currentTarget.dataset.url
		var title = ev.currentTarget.dataset.title

    if(page === "submenu"){
      showSubmenu(this)
    } else {
      $(".Layout").load(page, function(){
        onToolbar()
				$(".title-layout").html(title)
      })
    }
  }

  function onAtajos(ev) {
		var page = ev.currentTarget.dataset.url
    var title = ev.currentTarget.dataset.title
    $(".Layout").slideUp()

    setTimeout(function () {
      $(".Layout").load(page)
			$(".title-layout").html(title)
    }, 200)

    setTimeout(function () {
      $(".Layout").slideDown()
    }, 500)
  }

  function onToolbar () {
    $buttonToolbar.toggleClass("Header-transform")
    $toolbar.toggleClass("Toolbar-active")
    $u_ocultar.slideToggle()
    $(".Toolbar-submenu").slideUp()
    $(".Toolbar-logo").removeClass("Toolbar-menu--top")
    $(".Toolbar-menu").removeClass("Toolbar-menu--top")
    $(".Toolbar-menu--item").removeClass("Toolbar-menu--active")
  }

  function showSubmenu(self) {
    // $(".Toolbar-submenu").slideUp()
    var item = self.parentElement
    $(item.children[1]).slideToggle()
    $(item).toggleClass("Toolbar-menu--active")
    var countSub = $(item.children[1])
    var len = countSub[0].childElementCount

    if(len >= 4) {
      $(".Toolbar-logo").toggleClass("Toolbar-menu--top")
      $(".Toolbar-menu").toggleClass("Toolbar-menu--top")
    }
  }

	$("#cerrarProfile").on("click", function () {
		$(".ProfileCard").slideUp()
	})

	$("#profile").on("click", function () {
		$(".ProfileCard").slideDown()
	})

	$("#changePassword").on("click", function () {
		if (validarChangePassword()) {
			$.ajax({
				type:"POST",
				url:"inicio/servicio/guardar_password.php",
				data: { password:$password.val() }
			})
			.done(function (response) {
				$password.val("")
				toast("Se ha actualizado con exito su contraseña")
				$("#pass-labelProf").removeClass("active")
			})
		}
	})

	$("#avatarInputProf").on("change", function (e) {
		if(validarChangeImage) {
			var avatar = document.querySelector("#avatarInputProf")
			var formData = new FormData()
			formData.append("avatar", avatar.files[0])
			toast("Se esta subiendo su foto.....")

			$.ajax({
				type:"POST",
				url:"inicio/servicio/guardar_avatar.php",
				data: formData,
				cache: false,
				contentType: false,
				processData: false
			})
			.done(function (response) {
				console.log(response)
				loadImageAvatar(e.target.files[0])
        toast("Se cambiado con exito su foto de perfil")
			})
		}
	})

	function loadImageAvatar (targetFile) {
		var imageAvatar = $(".imageAvatar")

		var reader = new FileReader()
		reader.onload = (function (theFile) {
			return function (e) {
				imageAvatar.attr("src", e.target.result)
			}
		})(targetFile)
		reader.readAsDataURL(targetFile)
	}

	function validarChangeImage () {
		var flag = false
		var avatar = document.querySelector("#avatar_input")
		if($ImageAvatar.val() === "") {
			toast("Por favor ingrese una imagen")
		}
		else flag = true
		return flag
	}

	var $password = $("#passwordProfile")

	function validarChangePassword() {
		var flag = false

		if( $password.val() === "" || /^\s*$/.test($password.val())) {
			toast("Por favor ingrese su nueva contraseña")
			$password.focus()
		}
		else flag = true

		return flag
	}

})()

