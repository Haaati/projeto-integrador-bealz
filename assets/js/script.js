const projetos = {
    "cafe-bloom": {
        titulo: "Café Bloom",
        categoria: "Brand Kit Completo",
        imagem: "assets/img/projetos/cafe-bloom.jpg",
        descricao: "Projeto desenvolvido para criar uma identidade visual acolhedora e sofisticada.",
        servicos: [
            "Branding",
            "Identidade Visual",
            "Logotipo",
            "Manual da Marca"
        ]
    },

    "arkh": {
        titulo: "Arkh Studio",
        categoria: "Branding",
        imagem: "assets/img/projetos/arkh.jpg",
        descricao: "Desenvolvimento de uma identidade visual moderna para um estúdio criativo, com foco em transmitir inovação, minimalismo e personalidade através de um sistema visual consistente.",
        servicos: [
            "Branding",
            "Logotipo",
            "Paleta de Cores",
            "Tipografia",
            "Manual da Marca"
        ]
    },

    "lumina": {
        titulo: "Lumina Spa",
        categoria: "Design de Logotipo",
        imagem: "assets/img/projetos/lumina.jpg",
        descricao: "Criação de um logotipo elegante e contemporâneo para uma clínica de estética, buscando transmitir leveza, bem-estar e sofisticação.",
        servicos: [
            "Pesquisa",
            "Conceito",
            "Design de Logotipo",
            "Versões da Marca"
        ]
    }
};

// Procura no HTML o elemento que possui id="modal" e guarda ele na variável "modal".
const modal = document.getElementById("modal");

// Procura a imagem do modal.
const modalImage = document.getElementById("modal-image");

// Procura o título do modal.
const modalTitle = document.getElementById("modal-title");

// Procura a categoria do projeto.
const modalCategory = document.getElementById("modal-category");

// Procura a descrição do projeto.
const modalDescription = document.getElementById("modal-description");

// Procura a área onde serão adicionados os serviços.
const modalServices = document.getElementById("modal-services");


// Seleciona TODOS os elementos que possuem a classe "projeto-card" e percorre um por um.
document.querySelectorAll(".projeto-card").forEach(card => {

    // Adiciona um evento de clique em cada card.
    card.addEventListener("click", () => {

        /* Lê o atributo data-projeto do card clicado.
        Exemplo:
        <article data-projeto="cafe-bloom"> */
        const id = card.dataset.projeto;

        // Procura no objeto "projetos" qual projeto possui esse id.
        const projeto = projetos[id];

        // Caso não exista nenhum projeto com esse id, encerra a função para evitar erros.
        if (!projeto) return;

        // Troca a imagem do modal pela imagem do projeto.
        modalImage.src = projeto.imagem;

        // Define o título do modal.
        modalTitle.textContent = projeto.titulo;

        // Define a categoria.
        modalCategory.textContent = projeto.categoria;

        // Define a descrição.
        modalDescription.textContent = projeto.descricao;

        // Limpa os serviços antigos. Isso evita que, ao abrir outro projeto, os serviços do anterior continuem aparecendo.
        modalServices.innerHTML = "";

        // Percorre todos os serviços do projeto.
        projeto.servicos.forEach(servico => {

            // Adiciona um novo chip para cada serviço.
            modalServices.innerHTML += `
                <span class="service-chip">
                    ${servico}
                </span>
            `;

        });

        // Adiciona a classe "active" ao modal. No CSS, essa classe faz o modal aparecer.
        modal.classList.add("active");

    });

});


// Procura o botão de fechar (X)
document.querySelector(".modal-close").addEventListener("click", () => {

    // Remove a classe active. O modal volta a ficar escondido.
    modal.classList.remove("active");

});


// Detecta qualquer clique dentro do modal.
modal.addEventListener("click", (e) => {

    // Se o usuário clicou exatamente no fundo escuro (e não na caixa do modal), fecha o modal.
    if (e.target === modal) {
        modal.classList.remove("active");
    }
});

// Fecha o modal ao clicar em "Solicitar orçamento"
document.querySelector(".modal-cta a").addEventListener("click", () => {

    modal.classList.remove("active");

});