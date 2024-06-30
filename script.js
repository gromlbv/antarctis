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


function nextDisable(){
  $('.continue').attr('disabled', 'disabled');
}
function nextEnable(){
  $('.continue').removeAttr('disabled');
}
nextDisable()
const form = document.querySelector("#otp-form");
const inputs = document.querySelectorAll(".otp-input");
const verifyBtn = document.querySelector("#verify-btn");

const isAllInputFilled = () => {
  return Array.from(inputs).every((item) => item.value);
};

const getOtpText = () => {
  let text = "";
  inputs.forEach((input) => {
    text += input.value;
  });
  return text;
};

const verifyOTP = () => {
  if (isAllInputFilled()) {
    setTimeout(5);
    nextEnable()
    const text = getOtpText();
    // здесь проверяется код
    alert(`Код"${text}" подходит! `);
  }
};

const toggleFilledClass = (field) => {
  if (field.value) {
    field.classList.add("filled");
  } else {
    field.classList.remove("filled");
  }
};

form.addEventListener("input", (e) => {
  const target = e.target;
  const value = target.value;
  console.log({ target, value });
  toggleFilledClass(target);
  if (target.nextElementSibling) {
    target.nextElementSibling.focus();
  }
  verifyOTP();
});

inputs.forEach((input, currentIndex) => {
  // fill check
  toggleFilledClass(input);

  // paste event
  input.addEventListener("paste", (e) => {
    e.preventDefault();
    const text = e.clipboardData.getData("text");
    console.log(text);
    inputs.forEach((item, index) => {
      if (index >= currentIndex && text[index - currentIndex]) {
        item.focus();
        item.value = text[index - currentIndex] || "";
        toggleFilledClass(item);
        verifyOTP();
      }
    });
  });

  // backspace event
  input.addEventListener("keydown", (e) => {
    if (e.keyCode === 8) {
      e.preventDefault();
      input.value = "";
      // console.log(input.value);
      toggleFilledClass(input);
      if (input.previousElementSibling) {
        input.previousElementSibling.focus();
      }
    } else {
      if (input.value && input.nextElementSibling) {
        input.nextElementSibling.focus();
      }
    }
  });
});

verifyBtn.addEventListener("click", () => {
  verifyOTP();
});
