$(".show-1").on("click",function() {
    $(".etalon-1").css("display","flex")
    $(".etalon-10").css("display","none")
    $(".show-1 > img").attr("src","../source/check-true.svg");
    $(".show-10 > img").attr("src","../source/check-false.svg");
});
$(".show-10").on("click",function() {
    $(".etalon-1").css("display","none")
    $(".etalon-10").css("display","flex")
    $(".show-1 > img").attr("src","../source/check-false.svg");
    $(".show-10 > img").attr("src","../source/check-true.svg");
});