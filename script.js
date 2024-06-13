$(function(){
  $("button").click(function(){
    $(".muted-bg").css("z-index","10");
    $(".fullscreen-absolute").css("display","flex");
    $("body").css("overflow","hidden");
  }) // Закрытие окошка
  $(".muted-bg").click(function(){
    $(".muted-bg").css("z-index","-1");
    $(".fullscreen-absolute").fadeOut("300");
    $("body").css("overflow","hidden");
  })
})
