var MUEBLESAPP = {}

MUEBLESAPP.db = []

;(function (){
	'use strict'

	var labelAll = Array.prototype.slice.call(document.querySelectorAll("label"))

	for(var i in labelAll){
		var label = labelAll[i]
		label.innerText = label.innerText + " *"
	}

  $('select').material_select();
  $('input, textarea').characterCounter();
  $('.tooltipped').tooltip({delay: 50});
  $(".table").load('habitacion/partials/table.php', function () {
    $(".editar").on("click", editar)
  })

  function editar (){
    setTimeout(function (){
      getEnseres()
    }, 300)
  }

  var $nuevo = $("#nuevo")
  var $cancelar = $(".cancelar")
  var $guardar = $(".guardar")
  var $reporteGeneral = $("#reporteGeneral")

  // Inputs
  var $nombre = $("#nombre")
  var $imagen = $("#imagen")
  var $valor = $("#valor")
  var $categoria = $("#categoria")
  var $detalle = $("#detalle")
  var $imagen = $("#imagen")
  var $cant = $("#cantidad")
  var $piso = $("#piso")

  // Utilidades
  function u_formulario () {
    limpiar()
    $(".table").load('habitacion/partials/table.php', function () {
      $(".editar").on("click", editar)
    })
    $(".table").slideDown()
    $(".form").slideUp()

  }

  function limpiar () {
    var ImagenHabitacion = document.querySelector(".Imagen-habitacion")
    $("#habitacion_id").val("")
		$("#tableEnseres").html("")
		$("#mublesBoton").removeClass("u-none")
		MUEBLESAPP.db = []
		$("#MueblesYEnseresContainer").slideUp()
    $cant.val("")
    $nombre.val("")
    $imagen.val("")
    $valor.val("")
    $piso.val("")
    $categoria.val("")
    $detalle.val("")
    $(".file-path").val("")
    ImagenHabitacion.src = ""
    $('select').material_select("update");
    $(".valid").removeClass("valid")
    $("label.active").removeClass("active")
    document.getElementById("departamento").checked = false
  }

  function getData () {
    var formData = new FormData()
    var file_image = document.getElementById("imagen")
    var departamento = document.getElementById("departamento")
    var is = departamento.checked === true ? 1 : 0

    formData.append("id", $("#habitacion_id").val())
    formData.append("departamento", is)
    formData.append("nombre", $nombre.val())
    formData.append("imagen", file_image.files[0])
    formData.append("valor", $valor.val())
    formData.append("categoria", $categoria.val())
    formData.append("detalle", $detalle.val())
    formData.append("cant", $cant.val())
    formData.append("piso", $piso.val())
		formData.append("nombre_imagen", $(".file-path").val())
    formData.append("enseres", JSON.stringify(MUEBLESAPP.db))

    return formData
  }

  // Validaciones

  function validarFormulario() {
    var flag = false

    if ($nombre.val() === "" || /^\s*$/.test($nombre.val())) {
      $nombre.focus()
      toast("Porfavor ingrese el nombre de la habitacion")
    }
    else if($valor.val() === "") {
      $valor.focus()
      toast("Porfavor ingrese el precio de la habitación")
    }
    else if($cant.val() === ""){
      $cant.focus()
      toast("Porfavor ingrese cuantas habitación hay")
    }
    else if($piso.val() === ""){
      $piso.focus()
      toast("Porfavor ingrese el piso")
    }
    else if ($categoria.val() === null) {
      $categoria.focus()
      toast("Porfavor ingrese la categoria de la habitación")

    } else if ($detalle.val() === "" || /^\s*$/.test($detalle.val())) {
      $detalle.focus()
      toast("Porfavor ingrese el detalle de la habitacion")

    } else if($(".file-path").val() ===  ""){
      toast("Porfavor suba una imagen")

    }
		else if(MUEBLESAPP.db.length === 0){
			toast("Porfavor ingrese los muebles y enseres")
		}
		else flag = true
    return flag
  }

  // Eventos

  function onCancelar (e) {
    e.preventDefault()
    limpiar()

    $(".table").slideDown()
    $(".form").slideUp()
  }
  function onGuardar (e) {
    e.preventDefault()

    if (validarFormulario()) {
      $.ajax({
        type:"POST",
        url:"habitacion/servicio/guardar.php",
        data: getData(),
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function (data) {
        console.log(data)
        if(data == 2) {
          toast("Se ha registrado con exito.")
          u_formulario()

        }
        else if (data == 44) {
          toast("Ya no puede registrar mas habitaciones para la categoria indicada")
          $categoria.focus()
        }
        else if(data == 5) {
          toast("El nombre de la habitacion ya existe porfavor escoga otro nombre")
          $nombre.focus()
        }
        else if (data == 20) {
          $(".card-image").html("")
          toast("Se ha actualizado con exito.")
          u_formulario()

        } else if(data == 1) {
          toast("Porfavor actualizado los parametros")
        }

      })
    }
  }

  function onNuevo () {
    $(".table").slideUp()
    $(".form").slideDown()
  }

  function imageChange (e) {
    var upload = document.querySelector('#imagen')
    var ImagenHabitacion = document.querySelector(".Imagen-habitacion")

    if(upload.files[0].type != "image/png") {
      toast("Solo aceptamos imagenes png")
      $imagen.val("")
    } else {

      var file = e.target.files[0]
      var reader = new FileReader()
      reader.onload = (function (theFile) {
        return function (e) {
          ImagenHabitacion.src = e.target.result
        }
      })(file)
      reader.readAsDataURL(file)
    }

  }

  function reporteGeneral() {
    window.open (`./habitacion/reporte/lista.php`, "_blank","toolbar=yes, scrollbars=yes, resizable=yes, top=50, left=60, width=1200, height=600")
  }

	function buildPost (e) {
    var codigo = e.currentTarget.dataset.codigo
    var value = $("#buildText").val()

    $.ajax({
      type:"POST",
      url:"habitacion/servicio/build.php",
      data: { codigo, value }
    })
    .done(function (res) {
      if(res == 2) {
				document.getElementById("BuildButton").dataset.codigo = ""
				$("#BuildModal").slideUp()
				 $("#buildText").val("")
        toast("Su operacion se ha realizado con exito")
        $(".table").load('habitacion/partials/table.php')
      }
    })
  }

	function handleMubles (e) {
		e.preventDefault()
		$("#MueblesYEnseresContainer").slideDown()

		if($("#habitacion_id").val() != "" && MUEBLESAPP.db.length === 0) {
			getEnseres();
		}
	}

	function getEnseres () {
    var id = $("#habitacion_id").val()
		$.ajax({
			type: "POST",
			url:"habitacion/servicio/detalles.php",
			data: { id },
			dataType: "JSON"
		})
		.done(function (snap) {
			snap[0].detalle.map(function (e, i) {
				var object = { id: e.id, desc: e.desc, price: e.price, cant: e.cant,
					total: e.total }
				MUEBLESAPP.db.push(object)
			})
			building()
		})
	}

	function handleMublesADD (e) {
		var id = e.currentTarget.dataset.id
		var desc = e.currentTarget.dataset.desc
		var price = e.currentTarget.dataset.price

		var $input = $(`#input${id}`)
		var cant = parseInt($input.val())
		var total = cant * parseInt(price)
		total = total.toFixed(2)

		if ($input.val() === "") {
			toast("Porfavor ingrese la cantidad")
			$input.focus()
		}
		else {
			if(validNoRepeatEnser(id, cant)) {
				var object = { id, desc, price, cant, total }
				MUEBLESAPP.db.push(object)
				building()
				closeFormEnseres()
			}
		}
	}

	function validNoRepeatEnser (id, cant) {
		var flag = false

		if (MUEBLESAPP.db.length === 0) {
			return true
		}
		for (var i in MUEBLESAPP.db) {
			var item = MUEBLESAPP.db[i]

			if(item.id === id) {
				item.cant = parseInt(item.cant) + parseInt(cant)
				item.total = parseInt(item.cant) * parseFloat(item.price)
				toast("Se ha actualizado con exito")
				building()
				closeFormEnseres()
				return false
			}
			else flag = true
		}
		return flag
	}

	function building () {
		$("#tableEnseres").html("")
		var total = 0

		MUEBLESAPP.db.map(function (e, i) {
			var tag = `<tr>
				<td>${e.cant}</td>
				<td>${e.desc}</td>
				<td>${e.total}</td>
				<td>
					<button class="btn waves-effect waves-light red darken-4 delete-detail"
						data-index="${i}">
			      <i class="material-icons">delete</i>
			    </button>
				</td>
			</tr>`
			$("#tableEnseres").append(tag)
			total += parseFloat(e.total)
		})

		// $("#valor").val(total)
		// $(".price-label").addClass("active")

		$(".delete-detail").on("click", deleteDetalle)
	}

	function deleteDetalle (e) {
		var index = e.currentTarget.dataset.index

		MUEBLESAPP.db.splice(index, 1)
		building()
	}

	function closeFormEnseres () {
		$(".enseres__input").val("")
		$(".enseres__label").removeClass("active")
		$(".mublesForm").slideUp()
	}

	function showListEnseres () {
		$(".mublesForm").slideDown()
	}

	function handleAcept () {
		$("#MueblesYEnseresContainer").slideUp()
	}

	$("#aceptMueblesEnseres").on("click", handleAcept)

	$("#showListEnsere").on("click", showListEnseres)
	$("#closeEnseres").on("click", closeFormEnseres)
	$(".btnMublesADD").on("click", handleMublesADD)
	$("#BuildButton").on("click", buildPost)
  $imagen.on("change", imageChange)
  $nuevo.on("click", onNuevo)
  $cancelar.on("click", onCancelar)
  $guardar.on("click", onGuardar)
  $reporteGeneral.on("click", reporteGeneral)
	$("#mublesBoton").on("click", handleMubles)

	$("#CancelBuild").on("click", function () {
		$("#BuildModal").slideUp()
		$("#buildText").val("")
	})


})()
