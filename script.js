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


const main = async () => {
  let client = await fetch("/client")
  client = await client.json()

  document.querySelector(".client-name").innerText = client.name
  document.querySelector(".client-corp").innerText = client.name

  const raports = document.querySelector(".pdf-card-wr")

  Object.values(client.raports).forEach(raport => {
    raports.innerHTML += `
                <div class="pdf-card">
                    <div class="heading">
                        <h3>${raport.name}</h3>
                        <div class="date">${new Date(raport.date).toLocaleDateString("de-DE")}</div></div>
                    <button class="pdf-btn"><img src="source/pdf.svg" draggable="false">Открыть PDF</button>
                </div>`
  });
}

main()