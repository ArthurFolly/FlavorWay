// Dados específicos do Sudeste
const estadosSudeste = [
    {
        nome: "Minas Gerais",
        capital: "Belo Horizonte",
        especialidades: ["Feijão Tropeiro", "Pão de Queijo", "Doce de Leite", "Frango com Quiabo"],
        receitas: "18+",
        ingrediente_destaque: "Queijo Minas",
        descricao: "Tradição mineira autêntica"
    },
    {
        nome: "São Paulo",
        capital: "São Paulo",
        especialidades: ["Virado à Paulista", "Coxinha", "Pastel", "Pizza Paulistana"],
        receitas: "12+",
        ingrediente_destaque: "Linguiça",
        descricao: "Fusão de culturas imigrantes"
    },
    {
        nome: "Rio de Janeiro",
        capital: "Rio de Janeiro",
        especialidades: ["Feijoada", "Brigadeiro", "Biscoito Globo", "Caipirinha"],
        receitas: "8+",
        ingrediente_destaque: "Cachaça",
        descricao: "Berço da feijoada brasileira"
    },
    {
        nome: "Espírito Santo",
        capital: "Vitória",
        especialidades: ["Moqueca Capixaba", "Torta Capixaba", "Casquinha de Siri"],
        receitas: "4+",
        ingrediente_destaque: "Urucum",
        descricao: "Sabores do mar capixaba"
    }
];

const ingredientesSudeste = [
    {
        nome: "Queijo Minas",
        subtitulo: "Tradição mineira",
        descricao: "Queijo fresco e cremoso, produzido artesanalmente em Minas Gerais. Base do famoso pão de queijo.",
        usos: ["Pão de Queijo", "Doces", "Pratos Salgados"],
        origem: "Mineira",
        estados: ["Minas Gerais"]
    },
    {
        nome: "Doce de Leite",
        subtitulo: "Doçura mineira",
        descricao: "Doce cremoso feito com leite e açúcar, cozido lentamente até atingir consistência perfeita.",
        usos: ["Sobremesas", "Recheios", "Acompanhamentos"],
        origem: "Mineira",
        estados: ["Minas Gerais", "São Paulo"]
    },
    {
        nome: "Cachaça",
        subtitulo: "Aguardente brasileira",
        descricao: "Destilado de cana-de-açúcar, ingrediente principal da caipirinha e diversos pratos flambados.",
        usos: ["Caipirinha", "Pratos Flambados", "Marinadas"],
        origem: "Colonial",
        estados: ["Todos os estados"]
    },
    {
        nome: "Linguiça Calabresa",
        subtitulo: "Embutido tradicional",
        descricao: "Linguiça defumada trazida pelos imigrantes italianos, essencial na culinária paulista.",
        usos: ["Feijoada", "Pizzas", "Massas", "Sanduíches"],
        origem: "Italiana",
        estados: ["São Paulo", "Minas Gerais"]
    },
    {
        nome: "Urucum",
        subtitulo: "Colorau capixaba",
        descricao: "Semente que dá cor avermelhada aos pratos, especialmente usada na moqueca capixaba.",
        usos: ["Moqueca", "Temperos", "Coloração"],
        origem: "Indígena",
        estados: ["Espírito Santo"]
    },
    {
        nome: "Feijão Preto",
        subtitulo: "Base da feijoada",
        descricao: "Variedade de feijão essencial para a feijoada carioca, prato símbolo do Rio de Janeiro.",
        usos: ["Feijoada", "Tutu", "Sopas"],
        origem: "Colonial",
        estados: ["Rio de Janeiro", "Minas Gerais"]
    }
];

const tecnicasSudeste = [
    {
        nome: "Preparo da Feijoada",
        descricao: "Técnica tradicional carioca para cozinhar feijão preto com carnes defumadas e temperos especiais.",
        nivel: "Intermediário",
        duracao: "4h",
        icon: "🍲",
        origem: "Carioca"
    },
    {
        nome: "Massa do Pão de Queijo",
        descricao: "Técnica mineira para preparar a massa perfeita com polvilho, queijo e ovos.",
        nivel: "Básico",
        duracao: "30 min",
        icon: "🧀",
        origem: "Mineira"
    },
    {
        nome: "Doce de Leite Caseiro",
        descricao: "Método tradicional mineiro para fazer doce de leite cremoso e sem grumos.",
        nivel: "Intermediário",
        duracao: "2h",
        icon: "🥛",
        origem: "Mineira"
    },
    {
        nome: "Moqueca Capixaba",
        descricao: "Técnica capixaba para cozinhar peixe com urucum, sem dendê, em panela de barro.",
        nivel: "Básico",
        duracao: "40 min",
        icon: "🐟",
        origem: "Capixaba"
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

// Carregar receitas do Sudeste
async function loadReceitas() {
    try {
        const response = await fetch('../api/receitas-regiao.php?regiao=sudeste');
        receitas = await response.json();
        renderReceitas();
    } catch (error) {
        console.error('Erro ao carregar receitas:', error);
        // Fallback com dados estáticos
        receitas = [
            {
                id: 1,
                nome: "Feijoada Completa",
                descricao: "O prato mais tradicional do Brasil, com feijão preto, carnes defumadas e acompanhamentos clássicos.",
                tempo: "3h 30min",
                pessoas: "8 pessoas",
                rating: 4.9,
                dificuldade: "Intermediário",
                tags: ["Rio de Janeiro", "Tradicional", "Feijão"],
                estado: "rio-de-janeiro",
                destaque: true
            },
            {
                id: 4,
                nome: "Brigadeiro Gourmet",
                descricao: "O doce mais amado do Brasil em versão sofisticada, com chocolate belga e coberturas especiais.",
                tempo: "30 min",
                pessoas: "20 unidades",
                rating: 4.9,
                dificuldade: "Básico",
                tags: ["Rio de Janeiro", "Doce", "Chocolate"],
                estado: "rio-de-janeiro"
            },
            {
                id: 5,
                nome: "Coxinha de Frango",
                descricao: "Salgadinho brasileiro clássico com massa de batata, recheio de frango desfiado e temperos.",
                tempo: "1h 45min",
                pessoas: "30 unidades",
                rating: 4.8,
                dificuldade: "Intermediário",
                tags: ["São Paulo", "Salgado", "Frango"],
                estado: "sao-paulo"
            },
            {
                id: 11,
                nome: "Pão de Queijo",
                descricao: "Quitanda mineira feita com polvilho, queijo minas e ovos. Perfeito para o café da manhã.",
                tempo: "45 min",
                pessoas: "20 unidades",
                rating: 4.8,
                dificuldade: "Básico",
                tags: ["Minas Gerais", "Queijo", "Café da Manhã"],
                estado: "minas-gerais"
            },
            {
                id: 12,
                nome: "Feijão Tropeiro",
                descricao: "Prato mineiro com feijão, farinha de mandioca, bacon, linguiça e couve refogada.",
                tempo: "1h 30min",
                pessoas: "6 pessoas",
                rating: 4.7,
                dificuldade: "Intermediário",
                tags: ["Minas Gerais", "Feijão", "Tradicional"],
                estado: "minas-gerais"
            },
            {
                id: 13,
                nome: "Moqueca Capixaba",
                descricao: "Moqueca do Espírito Santo feita com urucum, sem dendê, cozida em panela de barro.",
                tempo: "40 min",
                pessoas: "4 pessoas",
                rating: 4.6,
                dificuldade: "Básico",
                tags: ["Espírito Santo", "Peixe", "Urucum"],
                estado: "espirito-santo"
            }
        ];
        renderReceitas();
    }
}

// Renderizar estados
function renderEstados() {
    const container = document.getElementById('estadosGrid');
    container.innerHTML = estadosSudeste.map(estado => `
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
                <button class="estado-button" onclick="filterByEstado('${estado.nome.toLowerCase().replace(' ', '-')}')">
                    Ver Receitas
                </button>
            </div>
        </div>
    `).join('');
}

// Renderizar ingredientes
function renderIngredientes() {
    const container = document.getElementById('ingredientesGrid');
    container.innerHTML = ingredientesSudeste.map(ingrediente => `
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
    container.innerHTML = tecnicasSudeste.map(tecnica => `
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
                <div style="margin-top: 12px; font-size: 0.875rem; color: #dc2626; font-weight: 600;">
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
                    ${receita.badge ? `<span class="badge" style="background: linear-gradient(90deg, #dc2626, #7c2d12); margin-top: 8px;">${receita.badge}</span>` : ''}
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

// Funções auxiliares (reutilizando do nordeste.js)
function scrollToSection(sectionId) {
    document.getElementById(sectionId).scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

function filterByEstado(estado) {
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

// Abrir modal da receita
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
        
        // Preencher modal
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
        
        document.getElementById('receitaModal').classList.add('active');
        
    } catch (error) {
        console.error('Erro ao carregar detalhes da receita:', error);
    }
}