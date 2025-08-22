// JavaScript específico para a página de Culinária Brasileira

document.addEventListener("DOMContentLoaded", () => {
  // Dados das regiões brasileiras
  const regioesData = {
    nordeste: {
      pratos: ["Acarajé", "Baião de Dois", "Carne de Sol", "Vatapá", "Caruru", "Tapioca"],
      ingredientes: ["Dendê", "Coco", "Camarão Seco", "Feijão Fradinho", "Queijo Coalho"],
      tecnicas: ["Fritura no Dendê", "Preparo de Vatapá", "Cozimento no Leite de Coco"],
    },
    sudeste: {
      pratos: ["Feijoada", "Virado à Paulista", "Pão de Açúcar", "Tutu de Feijão", "Frango com Quiabo"],
      ingredientes: ["Feijão Preto", "Linguiça", "Couve", "Farinha de Mandioca", "Quiabo"],
      tecnicas: ["Refogado Mineiro", "Preparo de Feijoada", "Cozimento Lento"],
    },
    sul: {
      pratos: ["Churrasco", "Barreado", "Arroz Carreteiro", "Chimarrão", "Cuca"],
      ingredientes: ["Carne Bovina", "Erva-mate", "Pinhão", "Queijos Artesanais"],
      tecnicas: ["Churrasco Gaúcho", "Preparo do Chimarrão", "Defumação"],
    },
    norte: {
      pratos: ["Tucumã", "Pirarucu", "Açaí", "Tacacá", "Pato no Tucumã"],
      ingredientes: ["Açaí", "Tucumã", "Pirarucu", "Jambu", "Castanha do Pará"],
      tecnicas: ["Preparo do Açaí", "Cozimento com Jambu", "Conservação de Peixes"],
    },
    centroOeste: {
      pratos: ["Pacu Assado", "Farofa de Banana", "Pequi", "Pintado Surubim"],
      ingredientes: ["Pequi", "Pacu", "Pintado", "Mandioca", "Banana"],
      tecnicas: ["Preparo do Pequi", "Pesca e Preparo", "Assados no Forno de Barro"],
    },
  }

  // Receitas brasileiras em destaque
  const receitasBrasileiras = [
    {
      nome: "Feijoada Completa Tradicional",
      regiao: "Sudeste",
      dificuldade: "Intermediário",
      tempo: "3h 30min",
      porcoes: "8 pessoas",
      rating: 4.9,
      ingredientes: ["Feijão preto", "Linguiça calabresa", "Carne seca", "Costela suína", "Bacon"],
      preparo: "Deixe o feijão de molho na véspera. Refogue as carnes e adicione ao feijão cozido...",
      dicas: "O segredo está no refogado inicial e no cozimento lento.",
    },
    {
      nome: "Acarajé Baiano Autêntico",
      regiao: "Nordeste",
      dificuldade: "Avançado",
      tempo: "2h 15min",
      porcoes: "6 pessoas",
      rating: 4.8,
      ingredientes: ["Feijão fradinho", "Dendê", "Cebola", "Sal", "Camarão seco"],
      preparo: "Descasque o feijão fradinho e bata no liquidificador. Frite no dendê bem quente...",
      dicas: "A temperatura do dendê é crucial para o acarajé ficar crocante por fora.",
    },
  ]

  // Animações específicas para elementos brasileiros
  const observerBrasil = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("animate-brasil")
        }
      })
    },
    { threshold: 0.2 },
  )

  // Observar elementos específicos da página
  document.querySelectorAll(".regiao-card, .receita-card, .tecnica-card, .ingrediente-card").forEach((el) => {
    observerBrasil.observe(el)
  })

  // Interação com cards de regiões
  const regiaoCards = document.querySelectorAll(".regiao-card")
  regiaoCards.forEach((card) => {
    card.addEventListener("click", function () {
      const regiao = this.classList[1] // nordeste, sudeste, etc.
      mostrarDetalhesRegiao(regiao)
    })
  })

  // Função para mostrar detalhes da região
  function mostrarDetalhesRegiao(regiao) {
    const dados = regioesData[regiao]
    if (dados) {
      const modal = criarModalRegiao(regiao, dados)
      document.body.appendChild(modal)
      modal.classList.add("active")
    }
  }

  // Criar modal com informações da região
  function criarModalRegiao(regiao, dados) {
    const modal = document.createElement("div")
    modal.className = "modal-overlay"
    modal.innerHTML = `
      <div class="modal modal-regiao">
        <div class="modal-header">
          <h2>Culinária ${regiao.charAt(0).toUpperCase() + regiao.slice(1)}</h2>
          <button class="modal-close">&times;</button>
        </div>
        <div class="modal-content">
          <div class="modal-section">
            <h3>Pratos Típicos</h3>
            <div class="tags-list">
              ${dados.pratos.map((prato) => `<span class="tag">${prato}</span>`).join("")}
            </div>
          </div>
          <div class="modal-section">
            <h3>Ingredientes Principais</h3>
            <div class="tags-list">
              ${dados.ingredientes.map((ing) => `<span class="tag">${ing}</span>`).join("")}
            </div>
          </div>
          <div class="modal-section">
            <h3>Técnicas Especiais</h3>
            <div class="tags-list">
              ${dados.tecnicas.map((tec) => `<span class="tag">${tec}</span>`).join("")}
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-primary">Explorar Receitas</button>
        </div>
      </div>
    `

    // Fechar modal
    modal.querySelector(".modal-close").addEventListener("click", () => {
      modal.classList.remove("active")
      setTimeout(() => modal.remove(), 300)
    })

    modal.addEventListener("click", (e) => {
      if (e.target === modal) {
        modal.classList.remove("active")
        setTimeout(() => modal.remove(), 300)
      }
    })

    return modal
  }

  // Filtro de receitas por região
  const filtroRegiao = document.createElement("div")
  filtroRegiao.className = "filtro-regiao"
  filtroRegiao.innerHTML = `
    <div class="filtro-buttons">
      <button class="filtro-btn active" data-regiao="todas">Todas</button>
      <button class="filtro-btn" data-regiao="nordeste">Nordeste</button>
      <button class="filtro-btn" data-regiao="sudeste">Sudeste</button>
      <button class="filtro-btn" data-regiao="sul">Sul</button>
      <button class="filtro-btn" data-regiao="norte">Norte</button>
      <button class="filtro-btn" data-regiao="centro-oeste">Centro-Oeste</button>
    </div>
  `

  // Inserir filtro antes da grid de receitas
  const receitasSection = document.querySelector(".receitas-brasil .container")
  const receitasGrid = document.querySelector(".receitas-grid")
  if (receitasSection && receitasGrid) {
    receitasSection.insertBefore(filtroRegiao, receitasGrid)
  }

  // Funcionalidade do filtro
  const filtroBtns = document.querySelectorAll(".filtro-btn")
  filtroBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      // Remove active de todos
      filtroBtns.forEach((b) => b.classList.remove("active"))
      // Adiciona active no clicado
      this.classList.add("active")

      const regiaoSelecionada = this.dataset.regiao
      filtrarReceitas(regiaoSelecionada)
    })
  })

  // Função para filtrar receitas
  function filtrarReceitas(regiao) {
    const receitaCards = document.querySelectorAll(".receita-card")

    receitaCards.forEach((card) => {
      if (regiao === "todas") {
        card.style.display = "block"
        card.classList.add("fade-in")
      } else {
        // Aqui você implementaria a lógica baseada em data attributes das receitas
        // Por enquanto, mostra todas
        card.style.display = "block"
        card.classList.add("fade-in")
      }
    })
  }

  // Contador de receitas favoritas
  let receitasFavoritas = JSON.parse(localStorage.getItem("receitasFavoritas")) || []

  // Atualizar bookmarks baseado no localStorage
  function atualizarBookmarks() {
    const bookmarks = document.querySelectorAll(".receita-bookmark")
    bookmarks.forEach((bookmark, index) => {
      const icon = bookmark.querySelector("i")
      if (receitasFavoritas.includes(index)) {
        icon.classList.remove("far")
        icon.classList.add("fas")
      }
    })
  }

  // Função para mostrar notificação
  function showNotification(message, type) {
    const notification = document.createElement("div")
    notification.className = `notification ${type}`
    notification.textContent = message
    document.body.appendChild(notification)
    setTimeout(() => notification.remove(), 3000)
  }

  // Funcionalidade de bookmark para receitas
  const bookmarkBtns = document.querySelectorAll(".receita-bookmark")
  bookmarkBtns.forEach((btn, index) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault()
      e.stopPropagation()

      const icon = this.querySelector("i")
      const receitaNome = this.closest(".receita-card").querySelector("h3").textContent

      if (icon.classList.contains("fas")) {
        // Remover dos favoritos
        icon.classList.remove("fas")
        icon.classList.add("far")
        receitasFavoritas = receitasFavoritas.filter((id) => id !== index)
        showNotification(`${receitaNome} removida dos favoritos`, "info")
      } else {
        // Adicionar aos favoritos
        icon.classList.remove("far")
        icon.classList.add("fas")
        receitasFavoritas.push(index)
        showNotification(`${receitaNome} adicionada aos favoritos!`, "success")
      }

      localStorage.setItem("receitasFavoritas", JSON.stringify(receitasFavoritas))
    })
  })

  // Inicializar bookmarks
  atualizarBookmarks()

  // Efeito parallax no hero
  window.addEventListener("scroll", () => {
    const scrolled = window.pageYOffset
    const hero = document.querySelector(".hero-brasil")
    if (hero) {
      hero.style.transform = `translateY(${scrolled * 0.5}px)`
    }
  })

  // Animação de contadores nas estatísticas
  function animarContadores() {
    const contadores = document.querySelectorAll(".stat-number")
    contadores.forEach((contador) => {
      const target = Number.parseInt(contador.textContent.replace(/\D/g, ""))
      let current = 0
      const increment = target / 50
      const timer = setInterval(() => {
        current += increment
        if (current >= target) {
          contador.textContent = contador.textContent.replace(/\d+/, target)
          clearInterval(timer)
        } else {
          contador.textContent = contador.textContent.replace(/\d+/, Math.floor(current))
        }
      }, 30)
    })
  }

  // Observar quando as estatísticas entram na tela
  const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        animarContadores()
        statsObserver.unobserve(entry.target)
      }
    })
  })

  const heroStats = document.querySelector(".hero-stats")
  if (heroStats) {
    statsObserver.observe(heroStats)
  }

  // Busca por ingredientes brasileiros
  const ingredientesBrasileiros = [
    "açaí",
    "dendê",
    "mandioca",
    "guaraná",
    "cupuaçu",
    "pequi",
    "jambu",
    "tucumã",
    "caju",
    "pitanga",
    "jabuticaba",
    "coco",
    "feijão fradinho",
    "queijo coalho",
    "carne de sol",
    "camarão seco",
    "farinha de mandioca",
  ]

  // Implementar busca inteligente
  function buscarIngrediente(termo) {
    const resultados = ingredientesBrasileiros.filter((ingrediente) =>
      ingrediente.toLowerCase().includes(termo.toLowerCase()),
    )
    return resultados
  }

  // Quiz sobre culinária brasileira
  const quizBrasil = {
    perguntas: [
      {
        pergunta: "Qual é o ingrediente principal do acarajé?",
        opcoes: ["Feijão preto", "Feijão fradinho", "Feijão carioca", "Feijão verde"],
        resposta: 1,
      },
      {
        pergunta: "De qual região é típica a feijoada?",
        opcoes: ["Norte", "Nordeste", "Sudeste", "Sul"],
        resposta: 2,
      },
      {
        pergunta: "O que é dendê?",
        opcoes: ["Uma especiaria", "Um óleo vegetal", "Um tipo de peixe", "Uma fruta"],
        resposta: 1,
      },
    ],
  }

  // Função para mostrar quiz
  function mostrarQuiz() {
    // Implementação do quiz seria aqui
    console.log("Quiz sobre culinária brasileira!")
  }

  // Receitas sazonais brasileiras
  const receitasSazonais = {
    verao: ["Açaí", "Água de coco", "Sorvete de cupuaçu", "Salada de frutas tropicais"],
    outono: ["Pamonha", "Curau", "Bolo de milho", "Canjica"],
    inverno: ["Quentão", "Vinho quente", "Caldo verde", "Sopa de mandioca"],
    primavera: ["Salada de palmito", "Moqueca leve", "Vitamina de açaí", "Tapioca doce"],
  }

  // Detectar estação atual e sugerir receitas
  function obterEstacaoAtual() {
    const mes = new Date().getMonth()
    if (mes >= 11 || mes <= 1) return "verao"
    if (mes >= 2 && mes <= 4) return "outono"
    if (mes >= 5 && mes <= 7) return "inverno"
    return "primavera"
  }

  // Sugestões baseadas na estação
  const estacaoAtual = obterEstacaoAtual()
  const sugestoesSazonais = receitasSazonais[estacaoAtual]

  console.log(`Receitas recomendadas para ${estacaoAtual}:`, sugestoesSazonais)
})

// Adicionar estilos CSS para os novos elementos
const styleBrasil = document.createElement("style")
styleBrasil.textContent = `
  .filtro-regiao {
    margin-bottom: 3rem;
    text-align: center;
  }
  
  .filtro-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
  }
  
  .filtro-btn {
    padding: 0.75rem 1.5rem;
    border: 2px solid var(--brasil-primary);
    background-color: transparent;
    color: var(--brasil-primary);
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .filtro-btn:hover,
  .filtro-btn.active {
    background-color: var(--brasil-primary);
    color: white;
    transform: translateY(-2px);
  }
  
  .modal-regiao {
    max-width: 600px;
    width: 90%;
  }
  
  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--brasil-light);
    margin-bottom: 2rem;
  }
  
  .modal-header h2 {
    color: var(--brasil-primary);
    margin: 0;
  }
  
  .modal-close {
    background: none;
    border: none;
    font-size: 2rem;
    color: var(--brasil-primary);
    cursor: pointer;
    padding: 0;
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    transition: all 0.3s ease;
  }
  
  .modal-close:hover {
    background-color: var(--brasil-light);
    transform: rotate(90deg);
  }
  
  .modal-section {
    margin-bottom: 2rem;
  }
  
  .modal-section h3 {
    color: var(--brasil-brown);
    margin-bottom: 1rem;
    font-size: 1.2rem;
  }
  
  .tags-list {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
  }
  
  .tags-list .tag {
    background: linear-gradient(135deg, var(--brasil-accent), var(--brasil-secondary));
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
  }
  
  .modal-footer {
    text-align: center;
    padding-top: 2rem;
    border-top: 2px solid var(--brasil-light);
  }
  
  .animate-brasil {
    animation: slideUpBrasil 0.6s ease forwards;
  }
  
  @keyframes slideUpBrasil {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
  
  .notification {
    position: fixed;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    padding: 1rem 2rem;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    z-index: 1000;
  }
  
  .notification.success {
    background-color: #4caf50;
    color: white;
  }
  
  .notification.info {
    background-color: #2196f3;
    color: white;
  }
  
  @media (max-width: 768px) {
    .filtro-buttons {
      gap: 0.5rem;
    }
    
    .filtro-btn {
      padding: 0.5rem 1rem;
      font-size: 0.9rem;
    }
    
    .modal-regiao {
      width: 95%;
      margin: 1rem;
    }
  }
`
document.head.appendChild(styleBrasil)
