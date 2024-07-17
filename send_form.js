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