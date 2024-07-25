function chiller_1(){
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
$(".chiller-1-submit").on("click", chiller_1);

function chiller_1(){
    let name = "chiller_1"
    let fields = {
        input1: $('input[name*="1-conditioner"]').val(),
        input2: $('input[name*="2-conditioner"]').val(),
        input3: $('input[name*="3-conditioner"]').val(),
        input4: $('select[name*="4-conditioner"]').val(),
        input5: $('select[name*="5-conditioner"]').val(),
        input6: $('select[name*="6-conditioner"]').val(),
        input7: $('select[name*="7-conditioner"]').val(),
        input8: $('input[name*="8-conditioner"]').val(),
    }
    console.log(fields)
    send_form(name, fields);
}
$(".conditioner-submit").on("click", chiller_1);


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