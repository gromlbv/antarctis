$(function(){
  $(".chiller-btn").click(function(){
    window.scrollTo(0, 0);
    $(".muted-bg").css("z-index","10");
    $(".fullscreen-absolute").css("display","flex");
    $("body").css("overflow","hidden");
  }) // Закрытие окошка
  $(".muted-bg").click(function(){
    $(".muted-bg").css("z-index","-1");
    $(".fullscreen-absolute").fadeOut("300");
    $("body").css("overflow","auto");
  })
})

// цвет для select option "Выбрать"
console.log($("#capacitor").text())
if ($("#capacitor").text() == "Выбрать"){
  console.log('aaa')
}

$(function(){
  $(".more-param-wr > button").click(function(){
    $(".more-param-wr > button").css("display","none");
    $(".hidden-param").css("display","flex");
  }) // Закрытие окошка
  $(".hidden-heading > img").click(function(){
    $(".more-param-wr > button").css("display","block");
    $(".hidden-param").css("display","none");
  })
})