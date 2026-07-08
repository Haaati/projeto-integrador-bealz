// ===== SALVAR STATUS =====

document.querySelectorAll(".btn-save").forEach(botao=>{

    botao.addEventListener("click",function(){

        const id=this.dataset.id;

        const status=this.closest("tr").querySelector(".status-select").value;


        fetch("actions/leads/atualizar_status_lead.php",{

            method:"POST",

            headers:{
                "Content-Type":"application/x-www-form-urlencoded"
            },

            body:`id=${id}&status_lead=${status}`

        })

        .then(response=>response.text())

        .then(resultado=>{

            if(resultado.trim()==="sucesso"){

                alert("Status atualizado com sucesso!");

            }else{

                console.log("Resposta recebida:",resultado);

                alert("Erro ao atualizar status.");

            }

        });

    });

});



// ===== ABRIR MODAL DE DETALHES =====

let leadAtualId=null;


document.querySelectorAll(".btn-details").forEach(botao=>{

    botao.addEventListener("click",function(){

        const id=this.dataset.id;

        leadAtualId=id;


        fetch(`actions/leads/detalhes_lead.php?id=${id}`)

        .then(response=>response.json())

        .then(dados=>{


            if(dados.sucesso){

                const lead=dados.lead;


                document.getElementById("modal-nome").textContent=lead.nome;

                document.getElementById("modal-email").textContent=lead.email;

                document.getElementById("modal-telefone").textContent=lead.telefone;

                document.getElementById("modal-servico").textContent=lead.servico_nome;

                document.getElementById("modal-mensagem").textContent=lead.mensagem;

                document.getElementById("modal-status").textContent=lead.status_nome;

                document.getElementById("modal-data").textContent=lead.data_clientes;

                document.getElementById("modal-observacao").value=lead.observacao ?? "";


                document.getElementById("modal-detalhes").style.display="flex";


            }else{

                alert("Erro ao carregar detalhes do lead.");

            }


        })


        .catch(erro=>{

            console.log("Erro na requisição:",erro);

            alert("Erro ao carregar detalhes do lead.");

        });


    });

});



// ===== FECHAR MODAL =====

document.getElementById("btn-fechar-modal")
.addEventListener("click",function(){

    document.getElementById("modal-detalhes").style.display="none";

});



// ===== SALVAR OBSERVAÇÃO =====

document.getElementById("btn-salvar-observacao")
.addEventListener("click",function(){


    const observacao=document.getElementById("modal-observacao").value;


    fetch("actions/leads/salvar_observacao.php",{

        method:"POST",

        headers:{
            "Content-Type":"application/x-www-form-urlencoded"
        },

        body:`id=${leadAtualId}&observacao=${encodeURIComponent(observacao)}`

    })


    .then(response=>response.text())


    .then(resultado=>{


        if(resultado.trim()==="sucesso"){

            alert("Observação salva com sucesso!");

        }else{

            alert("Erro ao salvar observação.");

        }


    });


});



// ===== ABRIR MODAL DE CONVERSÃO =====

let leadConverterId=null;


document.querySelectorAll(".btn-convert").forEach(botao=>{


    botao.addEventListener("click",function(){


        const id=this.dataset.id;


        leadConverterId=id;



        const buscarLead=fetch(`actions/leads/detalhes_lead.php?id=${id}`)

        .then(response=>response.json());



        const buscarServicos=fetch("actions/leads/listar_servicos.php")

        .then(response=>response.json());



        Promise.all([buscarLead,buscarServicos])

        .then(([dadosLead,servicos])=>{


            if(!dadosLead.sucesso){

                alert("Erro ao carregar dados do lead.");

                return;

            }


            const lead=dadosLead.lead;


            const selectServico=document.getElementById("conv-servico");


            selectServico.innerHTML="";


            servicos.forEach(servico=>{


                const option=document.createElement("option");


                option.value=servico.id;

                option.textContent=servico.nome_servicos;


                if(servico.id==lead.servico_id){

                    option.selected=true;

                }


                selectServico.appendChild(option);


            });


            document.getElementById("conv-lead-id").value=id;

            document.getElementById("conv-nome").value=lead.nome;

            document.getElementById("conv-email").value=lead.email;

            document.getElementById("conv-telefone").value=lead.telefone;

            document.getElementById("conv-instagram").value="";

            document.getElementById("conv-cpf").value="";

            document.getElementById("conv-sobre").value="";

            document.getElementById("conv-proposta").value="";


            document.getElementById("modal-converter").style.display="flex";


        })


        .catch(erro=>{

            console.log("Erro ao preparar conversão:",erro);

            alert("Erro ao carregar formulário de conversão.");

        });


    });


});