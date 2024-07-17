

const main = async () => {
    let client = await fetch("/client")
    if (client.status == 401) window.location.href = "/login"
    client = await client.json()

    form_to_send_fields = localStorage.getItem("form_to_send.fields")
    form_to_send_name = localStorage.getItem("form_to_send.name")

    if (form_to_send_name != null) {
        result = await fetch(`/form/${form_to_send_name}`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: form_to_send_fields
        })

        localStorage.removeItem("form_to_send.name")
        localStorage.removeItem("form_to_send.fields")

        let client = await fetch("/client")
        client = await client.json()
    }
  
    document.querySelector(".client-name").innerText = client.name
    document.querySelector(".client-corp").innerText = client.company_name
  
    const raports = document.querySelector(".pdf-card-wr")
  
    Object.values(client.raports).forEach(raport => {
      raports.innerHTML += `
                  <div class="pdf-card">
                      <div class="heading">
                          <h3>${raport.name}</h3>
                          <div class="date">${new Date(raport.date).toLocaleDateString("de-DE")}</div></div>
                      <a class="pdf-btn" href="/${raport.unique_name}.pdf"><img src="source/pdf.svg" draggable="false"> Открыть PDF</a></div>
                  </div>`
    });
  }
  
  main()