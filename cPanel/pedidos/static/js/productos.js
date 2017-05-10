;(function() {

  if (localStorage.getItem("productos") == null) {
    DB = []
  } else {
    DB = JSON.parse(localStorage.getItem("productos"))
  }

})()
