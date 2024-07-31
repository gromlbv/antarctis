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
  $(".flex-r > img").click(function(){
    $(".muted-bg").css("z-index","-1");
    $(".fullscreen-absolute").fadeOut("300");
    $("body").css("overflow","auto");
  })
})

// цвет для select option "Выбрать"
// console.log($("#capacitor").text())
// if ($("#capacitor").text() == "Выбрать"){
//   console.log('aaa')
// }

$(function(){
  $(".more-param-wr > button").click(function(){
    $(".more-param-wr > button").css("display","none");
    $(".hidden-param").css("display","flex");
    $(".more-param-wr")
      .animate({borderRadius: 33}, 100, "linear");
    
  }) // Закрытие окошка
  $(".hidden-heading > img").click(function(){
    $(".more-param-wr > button").css("display","block");
    $(".hidden-param").css("display","none");
    $(".more-param-wr")
      .animate({borderRadius: 18}, 50, "linear");
  })
})
$( ".header-wr > .hover" ).hover(
  function() {
      $(".header-wr > .hover > div").css("display","flex");
      $(".header-wr > .hover").css("padding","0 18px");
      if ($( document ).width() < 820){
        $(".header-login").css("display","none");
        $(".header-wr > .hover").css("width","100%");
      } 
      else{
        $(".header-wr > .hover").css("width","initial");
      }
  }, function() {
    if ($( document ).width() < 820){
      $(".header-login").css("display","flex");
    } 
    $(".header-wr > .hover > div").css("display","none");
    $(".header-wr > .hover").css("padding","0px");
    $(".header-wr > .hover").css("width","45px");
  }
);

$(".header-login").click(function(){
  window.location.href = "login.html"
})

let debug_3d_select = 0;

$(".ar-debug-btn").click(function(){
  if(debug_3d_select == 0){
    $(".hidden-3d").css("display","flex");
    $(".visible-debug").css("display","none");
    debug_3d_select = 1;
  }
  else if(debug_3d_select == 1){
    $(".hidden-3d").css("display","none");
    $(".visible-debug").css("display","flex");
    debug_3d_select = 0;
  }
})
