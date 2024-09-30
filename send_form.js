function chiller_1_submit(){
    let name = "chiller_1"
    let fields = {
        input1: $('input[name*="1-chiller-1"]').val(),
        input2: $('input[name*="2-chiller-1"]').val(),
        input3: $('input[name*="3-chiller-1"]').val(),
        input4: $('input[name*="4-chiller-1"]').val(),
        input5: $('select[name*="5-chiller-1"]').val(),
        input6: $('select[name*="6-chiller-1"]').val(),
    }
    console.log(fields)
    send_form(name, fields);
}
$(".chiller-1-submit").on("click", chiller_1_submit);

async function conditioner_submit() {
    let name = "conditioner"
    let fields = {
        Теплоприток_от_оборудования: $('input[name*="1-conditioner"]').val(),
        Теплоприток_от_отопления: $('input[name*="2-conditioner"]').val(),
        Теплоприток_от_вентиляции: $('input[name*="3-conditioner"]').val(),
        Наличие_увлажнителя: $('select[name*="4-conditioner"]').val(),
        Направление_подачи_воздуха: $('select[name*="5-conditioner"]').val(),
        Тип_модели_кондиционера: $('select[name*="6-conditioner"]').val(),
        Зимний_комплект: $('select[name*="7-conditioner"]').val(),
        Протокол_сетевого_взаимодействия: $('input[name*="8-conditioner"]').val(),
    }

    result = await send_form(name, fields);

    if (result.status == 401) {
        window.location.href = '/sign-up'
        sessionStorage.setItem("--wait-auth-form", JSON.stringify(fields))
        sessionStorage.setItem("--wait-auth-form-name", name)
    }
    if (result.status == 422) alert("Заполните обязательные поля!")
    if (result.status == 200) window.location.href = '/profile'

}
$(".conditioner-submit").on("click", conditioner_submit);

const send_form = async (name, fields) => {
    // :name - economizer, conditioner, absorber, chiller-1, chiller-2
    // :fields - поля в словаре ключ: строка или инт
    
    result = await fetch(`/form/${name}`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(fields)
    })

    return result
}