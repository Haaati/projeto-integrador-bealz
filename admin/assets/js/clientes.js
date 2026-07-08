// ===== SALVAR STATUS (inline na tabela) =====
document.querySelectorAll(".btn-save-status").forEach(botao => {
    botao.addEventListener("click", function () {
        const id = this.dataset.id;
        const status = this.closest("tr").querySelector(".status-select").value;

        fetch("actions/clientes/atualizar_status_cliente.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `id=${id}&status_clientes=${status}`
        })
            .then(response => response.text())
            .then(resultado => {
                if (resultado.trim() === "sucesso") {
                    alert("Status atualizado com sucesso!");
                } else {
                    console.log("Resposta recebida:", resultado);
                    alert("Erro ao atualizar status.");
                }
            });
    });
});


// ===== ABRIR MODAL DE EDIÇÃO =====
let clienteEditandoId = null;

document.querySelectorAll(".btn-edit").forEach(botao => {
    botao.addEventListener("click", function () {
        const id = this.dataset.id;
        clienteEditandoId = id;

        const buscarCliente = fetch(`actions/clientes/detalhes_cliente.php?id=${id}`)
            .then(response => response.json());

        const buscarServicos = fetch("actions/clientes/listar_servicos.php")
            .then(response => response.json());

        Promise.all([buscarCliente, buscarServicos])
            .then(([dadosCliente, servicos]) => {
                if (!dadosCliente.sucesso) {
                    alert("Erro ao carregar dados do cliente.");
                    return;
                }

                const cliente = dadosCliente.cliente;
                const selectServico = document.getElementById("edit-servico");
                selectServico.innerHTML = "";

                servicos.forEach(servico => {
                    const option = document.createElement("option");
                    option.value = servico.id;
                    option.textContent = servico.nome_servicos;
                    if (servico.id == cliente.servico_id) {
                        option.selected = true;
                    }
                    selectServico.appendChild(option);
                });

                document.getElementById("edit-cliente-id").value = cliente.id;
                document.getElementById("edit-nome").value = cliente.nome;
                document.getElementById("edit-email").value = cliente.email ?? "";
                document.getElementById("edit-telefone").value = cliente.telefone ?? "";
                document.getElementById("edit-instagram").value = cliente.instagram ?? "";
                document.getElementById("edit-cpf").value = cliente.cpf ?? "";
                document.getElementById("edit-sobre").value = cliente.sobre ?? "";
                document.getElementById("edit-proposta").value = cliente.proposta_url ?? "";
                document.getElementById("edit-status").value = cliente.status_clientes;

                document.getElementById("modal-editar-cliente").style.display = "flex";
            })
            .catch(erro => {
                console.log("Erro ao carregar edição:", erro);
                alert("Erro ao carregar dados do cliente.");
            });
    });
});


// ===== FECHAR MODAL DE EDIÇÃO =====
document.getElementById("btn-fechar-editar").addEventListener("click", function () {
    document.getElementById("modal-editar-cliente").style.display = "none";
});


// ===== CONFIRMAR EDIÇÃO =====
document.getElementById("btn-confirmar-editar").addEventListener("click", function () {
    const dados = new URLSearchParams();

    dados.append("id", clienteEditandoId);
    dados.append("email", document.getElementById("edit-email").value);
    dados.append("telefone", document.getElementById("edit-telefone").value);
    dados.append("instagram", document.getElementById("edit-instagram").value);
    dados.append("cpf", document.getElementById("edit-cpf").value);
    dados.append("servico_id", document.getElementById("edit-servico").value);
    dados.append("sobre", document.getElementById("edit-sobre").value);
    dados.append("proposta_url", document.getElementById("edit-proposta").value);
    dados.append("status_clientes", document.getElementById("edit-status").value);

    fetch("actions/clientes/atualizar_cliente.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: dados.toString()
    })
        .then(response => response.text())
        .then(resultado => {
            if (resultado.trim() === "sucesso") {
                alert("Cliente atualizado com sucesso!");
                location.reload();
            } else {
                console.log("Resposta recebida:", resultado);
                alert("Erro ao atualizar cliente.");
            }
        });
});