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
  const fields = document.querySelectorAll("input.otp-input")
  const btn = document.querySelector("input.continue")
  async function verifyFunc (e) {
      code = ""
      fields.forEach(e => {code += e.value})
      result = await fetch(`/sms/verifyCode?code=${code}`)
      if (result.status) {}
      switch (result.status) {
          case 401: window.location.href = "/login" // пользователь не прошел первичную авторизацию
          case 400: window.location.reload(), noLog() // код не подошел
          case 422: window.location.reload() // чтото не то с валидацией полей
          case 200: { // код 200 значит авторизация успешна
            
            if (sessionStorage.getItem("--wait-auth-form-name") != null){
              send_form(sessionStorage.getItem("--wait-auth-form-name"), JSON.parse(sessionStorage.getItem("--wait-auth-form"))).then((r) => {
                  window.location.reload()
              })
              sessionStorage.removeItem("--wait-auth-form")
              sessionStorage.removeItem("--wait-auth-form-name")
            }
            window.location.href = "/profile"
          }
      }
  }
  function noLog(){
    $(".otp-error").css("display", "flex")
    $("$otp-input").value = "5";
  }
  const verifyOTP = () => {
    if (isAllInputFilled()) {
      verifyFunc()
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