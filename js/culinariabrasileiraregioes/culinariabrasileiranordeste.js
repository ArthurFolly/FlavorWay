// Dados específicos do Nordeste
const estadosNordeste = [
    {
        nome: "Bahia",
        capital: "Salvador",
        especialidades: ["Acarajé", "Moqueca", "Vatapá", "Caruru"],
        receitas: "15+",
        ingrediente_destaque: "Dendê",
        descricao: "Berço da culinária afro-brasileira"
    },
    {
        nome: "Pernambuco",
        capital: "Recife",
        especialidades: ["Caldinho de Feijão", "Bolo de Rolo", "Cartola"],
        receitas: "8+",
        ingrediente_destaque: "Queijo Coalho",
        descricao: "Tradição doce e salgada"
    },
    {
        nome: "Ceará",
        capital: "Fortaleza",
        especialidades: ["Baião de Dois", "Carne de Sol", "Tapioca"],
        receitas: "6+",
        ingrediente_destaque: "Carne de Sol",
        descricao: "Sabores do sertão e do mar"
    },
    {
        nome: "Maranhão",
        capital: "São Luís",
        especialidades: ["Arroz de Cuxá", "Torta de Camarão", "Juçara"],
        receitas: "4+",
        ingrediente_destaque: "Vinagreira",
        descricao: "Influência francesa e africana"
    },
    {
        nome: "Paraíba",
        capital: "João Pessoa",
        especialidades: ["Rubacão", "Cuscuz", "Buchada de Bode"],
        receitas: "3+",
        ingrediente_destaque: "Macaxeira",
        descricao: "Tradições sertanejas"
    },
    {
        nome: "Sergipe",
        capital: "Aracaju",
        especialidades: ["Caranguejada", "Casquinha de Siri", "Queijadinha"],
        receitas: "3+",
        ingrediente_destaque: "Caranguejo",
        descricao: "Frutos do mar e doces"
    }
];

const ingredientesNordeste = [
    {
        nome: "Dendê",
        subtitulo: "Óleo sagrado da Bahia",
        descricao: "Extraído da palma africana, é o ingrediente mais característico da culinária baiana. Rico em vitamina A e betacaroteno.",
        usos: ["Acarajé", "Moqueca", "Vatapá", "Caruru"],
        origem: "Africana",
        estados: ["Bahia", "Sergipe"]
    },
    {
        nome: "Carne de Sol",
        subtitulo: "Proteína do sertão",
        descricao: "Carne bovina salgada e seca ao sol, técnica de conservação tradicional do sertão nordestino.",
        usos: ["Baião de Dois", "Paçoca de Carne", "Escondidinho"],
        origem: "Sertaneja",
        estados: ["Ceará", "Rio Grande do Norte", "Paraíba"]
    },
    {
        nome: "Queijo Coalho",
        subtitulo: "Queijo do nordeste",
        descricao: "Queijo fresco e salgado, tradicionalmente assado na brasa. Acompanhamento perfeito para a rapadura.",
        usos: ["Grelhado", "Espetinho", "Sanduíches"],
        origem: "Sertaneja",
        estados: ["Pernambuco", "Ceará", "Paraíba"]
    },
    {
        nome: "Vinagreira",
        subtitulo: "Folha maranhense",
        descricao: "Planta de folhas verdes com sabor levemente ácido, base do famoso arroz de cuxá maranhense.",
        usos: ["Arroz de Cuxá", "Refogados", "Saladas"],
        origem: "Africana",
        estados: ["Maranhão"]
    },
    {
        nome: "Macaxeira",
        subtitulo: "Mandioca nordestina",
        descricao: "Variedade doce da mandioca, consumida cozida como acompanhamento ou em pratos principais.",
        usos: ["Cozida", "Escondidinho", "Bolos"],
        origem: "Indígena",
        estados: ["Todos os estados"]
    },
    {
        nome: "Camarão Seco",
        subtitulo: "Sabor concentrado do mar",
        descricao: "Camarões desidratados que intensificam o sabor dos pratos, especialmente na culinária baiana.",
        usos: ["Vatapá", "Caruru", "Acarajé", "Bobó"],
        origem: "Litorânea",
        estados: ["Bahia", "Sergipe", "Alagoas"]
    }
];

const tecnicasNordeste = [
    {
        nome: "Fritura no Dendê",
        descricao: "Técnica tradicional baiana para frituras, mantendo a temperatura ideal do dendê para não queimar.",
        nivel: "Intermediário",
        duracao: "15 min",
        icon: "🔥",
        origem: "Africana"
    },
    {
        nome: "Salga da Carne de Sol",
        descricao: "Processo de conservação da carne através da salga e secagem ao sol, técnica milenar do sertão.",
        nivel: "Avançado",
        duracao: "3 dias",
        icon: "☀️",
        origem: "Sertaneja"
    },
    {
        nome: "Preparo do Vatapá",
        descricao: "Técnica para fazer o cremoso vatapá baiano, equilibrando leite de coco, dendê e temperos.",
        nivel: "Intermediário",
        duracao: "45 min",
        icon: "🥥",
        origem: "Africana"
    },
    {
        nome: "Cozimento no Barro",
        descricao: "Uso de panelas de barro que conferem sabor especial aos pratos, especialmente moquecas.",
        nivel: "Básico",
        duracao: "30 min",
        icon: "🏺",
        origem: "Indígena"
    }
];

// Estado da aplicação
let bookmarkedRecipes = [];
let activeFilter = 'todos';
let receitas = [];

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    loadReceitas();
    renderEstados();
    renderIngredientes();
    renderTecnicas();
    setupEventListeners();
    loadBookmarks();
});

// Carregar receitas do Nordeste
async function loadReceitas() {
    try {
        const response = await fetch('../api/receitas-regiao.php?regiao=nordeste');
        receitas = await response.json();
        renderReceitas();
    } catch (error) {
        console.error('Erro ao carregar receitas:', error);
        // Fallback com dados estáticos
        receitas = [
            {
                id: 2,
                nome: "Acarajé Baiano",
                descricao: "Bolinho de feijão fradinho frito no dendê, recheado com vatapá, caruru e camarão seco.",
                tempo: "2h 15min",
                pessoas: "6 pessoas",
                rating: 4.8,
                dificuldade: "Avançado",
                tags: ["Bahia", "Dendê", "Tradicional"],
                estado: "bahia",
                destaque: true
            },
            {
                id: 3,
                nome: "Moqueca de Peixe",
                descricao: "Peixe cozido no leite de coco com dendê, pimentões e coentro. Sabor do mar brasileiro.",
                tempo: "45 min",
                pessoas: "4 pessoas",
                rating: 4.7,
                dificuldade: "Básico",
                tags: ["Bahia", "Peixe", "Coco"],
                estado: "bahia"
            },
            {
                id: 7,
                nome: "Baião de Dois",
                descricao: "Arroz com feijão de corda, carne de sol, queijo coalho e temperos do sertão.",
                tempo: "1h 30min",
                pessoas: "6 pessoas",
                rating: 4.6,
                dificuldade: "Intermediário",
                tags: ["Ceará", "Carne de Sol", "Sertão"],
                estado: "ceara"
            },
            {
                id: 8,
                nome: "Caldinho de Feijão",
                descricao: "Caldo cremoso de feijão com camarão, bacon e temperos pernambucanos.",
                tempo: "1h 15min",
                pessoas: "8 pessoas",
                rating: 4.5,
                dificuldade: "Básico",
                tags: ["Pernambuco", "Feijão", "Camarão"],
                estado: "pernambuco"
            },
            {
                id: 9,
                nome: "Arroz de Cuxá",
                descricao: "Prato típico maranhense com arroz, vinagreira, camarão seco e gergelim.",
                tempo: "50 min",
                pessoas: "4 pessoas",
                rating: 4.4,
                dificuldade: "Intermediário",
                tags: ["Maranhão", "Vinagreira", "Camarão"],
                estado: "maranhao"
            },
            {
                id: 10,
                nome: "Tapioca Recheada",
                descricao: "Massa de tapioca com recheios doces ou salgados, lanche típico do nordeste.",
                tempo: "20 min",
                pessoas: "2 pessoas",
                rating: 4.3,
                dificuldade: "Básico",
                tags: ["Ceará", "Tapioca", "Lanche"],
                estado: "ceara"
            }
        ];
        renderReceitas();
    }
}

// Renderizar estados
function renderEstados() {
    const container = document.getElementById('estadosGrid');
    container.innerHTML = estadosNordeste.map(estado => `
        <div class="estado-card">
            <div class="estado-header">
                <div class="estado-content">
                    <h3>${estado.nome}</h3>
                    <p>${estado.capital}</p>
                </div>
            </div>
            <div class="estado-body">
                <h4>${estado.descricao}</h4>
                <div class="estado-especialidades">
                    ${estado.especialidades.map(esp => `<span class="especialidade-tag">${esp}</span>`).join('')}
                </div>
                <div class="estado-stats">
                    <span>${estado.receitas} receitas</span>
                    <span>${estado.ingrediente_destaque}</span>
                </div>
                <button class="estado-button" onclick="filterByEstado('${estado.nome.toLowerCase()}')">
                    Ver Receitas
                </button>
            </div>
        </div>
    `).join('');
}

// Renderizar ingredientes
function renderIngredientes() {
    const container = document.getElementById('ingredientesGrid');
    container.innerHTML = ingredientesNordeste.map(ingrediente => `
        <div class="ingrediente-card">
            <div class="ingrediente-header">
                <div class="ingrediente-content">
                    <h3>${ingrediente.nome}</h3>
                    <p>${ingrediente.subtitulo}</p>
                </div>
            </div>
            <div class="ingrediente-body">
                <h4>Origem ${ingrediente.origem}</h4>
                <p>${ingrediente.descricao}</p>
                <div class="ingrediente-usos">
                    ${ingrediente.usos.map(uso => `<span class="uso-tag">${uso}</span>`).join('')}
                </div>
                <div style="margin-top: 12px; font-size: 0.875rem; color: #6b7280;">
                    <strong>Estados:</strong> ${ingrediente.estados.join(', ')}
                </div>
            </div>
        </div>
    `).join('');
}

// Renderizar técnicas
function renderTecnicas() {
    const container = document.getElementById('tecnicasGrid');
    container.innerHTML = tecnicasNordeste.map(tecnica => `
        <div class="tecnica-card">
            <div class="tecnica-header">
                <div class="tecnica-badges">
                    <span class="badge ${tecnica.nivel === 'Básico' ? 'bg-green-600' : tecnica.nivel === 'Intermediário' ? 'bg-yellow-600' : 'bg-red-600'}">${tecnica.nivel}</span>
                    <span class="badge" style="background: rgba(0,0,0,0.6); margin-left: 8px;">${tecnica.duracao}</span>
                </div>
                <div class="tecnica-overlay">
                    <button class="play-btn">
                        <i class="fas fa-play"></i>
                        Aprender
                    </button>
                </div>
                <div class="tecnica-icon">${tecnica.icon}</div>
            </div>
            <div class="tecnica-body">
                <div class="tecnica-title">
                    <div class="tecnica-emoji">${tecnica.icon}</div>
                    <h3>${tecnica.nome}</h3>
                </div>
                <p>${tecnica.descricao}</p>
                <div style="margin-top: 12px; font-size: 0.875rem; color: #ea580c; font-weight: 600;">
                    Origem: ${tecnica.origem}
                </div>
                <button class="card-button">Aprender Técnica</button>
            </div>
        </div>
    `).join('');
}

// Renderizar receitas
function renderReceitas() {
    const container = document.getElementById('receitasGrid');
    const filteredReceitas = activeFilter === 'todos' 
        ? receitas 
        : receitas.filter(receita => receita.estado === activeFilter);
    
    container.innerHTML = filteredReceitas.map(receita => `
        <div class="receita-card ${receita.destaque ? 'destaque' : ''}">
            <div class="receita-header">
                <div class="receita-badges">
                    <span class="badge ${getDifficultyClass(receita.dificuldade)}">${receita.dificuldade}</span>
                    ${receita.badge ? `<span class="badge" style="background: linear-gradient(90deg, #ea580c, #eab308); margin-top: 8px;">${receita.badge}</span>` : ''}
                </div>
                <button class="receita-bookmark ${bookmarkedRecipes.includes(receita.id) ? 'bookmarked' : ''}" 
                        onclick="toggleBookmark(${receita.id})">
                    <i class="fas fa-bookmark"></i>
                </button>
                <div class="receita-icon">🍽️</div>
            </div>
            <div class="receita-body">
                <h3>${receita.nome}</h3>
                <p>${receita.descricao}</p>
                
                <div class="receita-meta">
                    <span><i class="fas fa-clock"></i> ${receita.tempo}</span>
                    <span><i class="fas fa-users"></i> ${receita.pessoas}</span>
                    <span><i class="fas fa-star" style="color: #fbbf24;"></i> ${receita.rating}</span>
                </div>
                
                <div class="receita-tags">
                    ${receita.tags.map(tag => `<span class="tag">${tag}</span>`).join('')}
                </div>
                
                <button class="card-button" onclick="openRecipeModal(${receita.id})">
                    Ver Receita Completa
                </button>
            </div>
        </div>
    `).join('');
}

// Configurar event listeners
function setupEventListeners() {
    // Filtros de receitas
    document.querySelectorAll('.filtro-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filtro-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeFilter = this.dataset.filtro;
            renderReceitas();
        });
    });

    // Modal
    const modal = document.getElementById('receitaModal');
    const closeBtn = document.getElementById('modalClose');
    
    closeBtn.addEventListener('click', () => {
        modal.classList.remove('active');
    });
    
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.remove('active');
        }
    });

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Funções auxiliares
function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

function filterByEstado(estado) {
    // Atualizar filtro ativo
    document.querySelectorAll('.filtro-btn').forEach(btn => {
        btn.classList.remove('active');
        if (btn.dataset.filtro === estado) {
            btn.classList.add('active');
        }
    });
    
    activeFilter = estado;
    renderReceitas();
    scrollToSection('receitas');
}

function toggleBookmark(recipeId) {
    if (bookmarkedRecipes.includes(recipeId)) {
        bookmarkedRecipes = bookmarkedRecipes.filter(id => id !== recipeId);
    } else {
        bookmarkedRecipes.push(recipeId);
    }
    renderReceitas();
    localStorage.setItem('bookmarkedRecipes', JSON.stringify(bookmarkedRecipes));
}

function loadBookmarks() {
    const saved = localStorage.getItem('bookmarkedRecipes');
    if (saved) {
        bookmarkedRecipes = JSON.parse(saved);
    }
}

function getDifficultyClass(dificuldade) {
    switch(dificuldade) {
        case 'Básico': return 'bg-green-600';
        case 'Intermediário': return 'bg-yellow-600';
        case 'Avançado': return 'bg-red-600';
        default: return 'bg-gray-600';
    }
}

// Abrir modal da receita (reutiliza a função da página principal)
async function openRecipeModal(recipeId) {
    try {
        const response = await fetch(`../api/receita-detalhes.php?id=${recipeId}`);
        const recipeDetails = await response.json();
        
        if (recipeDetails.error) {
            console.error('Receita não encontrada');
            return;
        }
        
        const receita = receitas.find(r => r.id === recipeId);
        if (!receita) return;
        
        // Preencher modal (mesmo código da página principal)
        document.getElementById('modalTitulo').textContent = receita.nome;
        document.getElementById('modalMeta').innerHTML = `
            <span><i class="fas fa-clock"></i> ${receita.tempo}</span>
            <span><i class="fas fa-users"></i> ${receita.pessoas}</span>
            <span class="badge ${getDifficultyClass(receita.dificuldade)}">${receita.dificuldade}</span>
        `;
        document.getElementById('modalDescricao').textContent = receita.descricao;
        document.getElementById('modalTags').innerHTML = receita.tags.map(tag => 
            `<span class="tag">${tag}</span>`
        ).join('');
        
        // Resto da implementação do modal...
        document.getElementById('receitaModal').classList.add('active');
        
    } catch (error) {
        console.error('Erro ao carregar detalhes da receita:', error);
    }
}