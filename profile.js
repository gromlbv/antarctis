

const main = async () => {
    let client = await fetch("/client")
    client = await client.json()
  
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