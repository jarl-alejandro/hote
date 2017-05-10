;(function () {
  'use strict'

  var  $slide = $(".slider-habi")

  var count = $slide.length
  var index = 0
  var height = (100*count) - 100*(count-1)

  var $slideInner = $(".slider-inner")

  // $slideInner.css("height", (100*count) - 100*(count-1)+"%")
  // alert((100*count) - 100*(count-1))
  // $slide.css("height", 100+"%")

  setInterval(function () {
    if(index < count-1){
      index++
      move()
    }
    else {
      index = 0
      move()
    }
  }, 3000)

  function move () {
    if (index === 0)
      $slide.css("top", 0)
    else if(index > 0 && index < count){
      $slide.css("top", "-"+ (100/count) * index+"%")
    }
  }

})()
