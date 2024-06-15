$(function(){
  $(".chiller-btn").click(function(){
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

$("input[type=text]").change(function() {
  var filled = true;
  $("input[type=text]").each(function(index) {
  if($( this ).val() == ""){
    filled = false;
  });
  
  if(filled === false){
    $("input[type=submit]").css("background-color","red")
  }
});