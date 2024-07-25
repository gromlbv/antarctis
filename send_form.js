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
    console.log()
    send_form(name, fields);
}
$(".chiller-1").on("click", chiller_1);
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