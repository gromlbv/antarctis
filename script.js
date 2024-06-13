$(function(){
  $("button").click(function(){
    $(".fullscreen-absolute").fadeIn("300");
  }) // Закрытие окошка
  $(".fullscreen-absolute").click(function(){
    $(".fullscreen-absolute").fadeOut("300");
  })

})
