// ===== ENVIAR FORMULÁRIO DE CONTATO =====
document.querySelector(".contato-form").addEventListener("submit", function(e){
    e.preventDefault();
    

    const formContato = this;
    const dados = new FormData(formContato);

    fetch("criar_leads.php", {
        method: "POST",
        body: dados
    })
    .then(response => response.text())
    .then(resultado => {
        if(resultado.trim() === "sucesso"){
            alert("Enviado com sucesso!");
            formContato.reset();
        } else {
            console.log("Resposta recebida:", resultado);
            alert("Erro ao enviar formulário.");
        }
    })
    .catch(erro => {
        console.log("Erro na requisição:", erro);
        alert("Erro ao enviar formulário.");
    });
});