// Dados das regiões
const regioes = [
    {
        id: "nordeste",
        nome: "Nordeste",
        descricao: "Sabores intensos e temperos marcantes",
        especialidades: ["Acarajé", "Baião de Dois", "Carne de Sol"],
        receitas: "35+",
        tecnicas: "8",
        detalhes: "Rica em frutos do mar, mandioca, coco e dendê. Influência africana e indígena forte."
    },
    {
        id: "sudeste",
        nome: "Sudeste",
        descricao: "Tradições mineiras, paulistas, cariocas e capixabas",
        especialidades: ["Feijoada", "Pão de Açúcar", "Virado à Paulista"],
        receitas: "40+",
        tecnicas: "10",
        detalhes: "Fusão de tradições portuguesas, africanas e italianas. Pratos fartos e saborosos."
    },
    {
        id: "sul",
        nome: "Sul",
        descricao: "Churrasco e tradições gaúchas",
        especialidades: ["Churrasco", "Chimarrão", "Barreado"],
        receitas: "30+",
        tecnicas: "6",
        detalhes: "Influência europeia forte, especialmente alemã e italiana. Carnes e vinhos."
    },
    {
        id: "norte",
        nome: "Norte",
        descricao: "Sabores amazônicos únicos",
        especialidades: ["Tucumã", "Pirarucu", "Açaí"],
        receitas: "25+",
        tecnicas: "5",
        detalhes: "Ingredientes exóticos da Amazônia. Peixes, frutas tropicais e raízes."
    },
    {
        id: "centro-oeste",
        nome: "Centro-Oeste",
        descricao: "Pantanal e cerrado",
        especialidades: ["Pacu Assado", "Pequi", "Farofa de Banana"],
        receitas: "20+",
        tecnicas: "4",
        detalhes: "Peixes de água doce, frutas do cerrado e influência pantaneira."
    }
];

// Dados das técnicas
const tecnicas = [
    {
        nome: "Refogado Brasileiro",
        descricao: "A base de muitos pratos brasileiros: como fazer o refogado perfeito com cebola, alho e temperos.",
        nivel: "Básico",
        duracao: "8 min",
        icon: "🔥"
    },
    {
        nome: "Fritura no Dendê",
        descricao: "Técnica tradicional baiana para frituras com dendê, mantendo temperatura e sabor ideais.",
        nivel: "Intermediário",
        duracao: "12 min",
        icon: "🌿"
    },
    {
        nome: "Farofa Perfeita",
        descricao: "Segredos para fazer farofa crocante e saborosa, acompanhamento essencial da mesa brasileira.",
        nivel: "Básico",
        duracao: "10 min",
        icon: "🌾"
    }
];

// Dados dos ingredientes
const ingredientes = [
    {
        nome: "Dendê",
        subtitulo: "Óleo sagrado da culinária baiana",
        descricao: "Extraído da palma africana, é essencial na culinária nordestina. Rico em vitamina A e sabor único.",
        usos: ["Acarajé", "Moqueca", "Vatapá"],
        classe: "dende"
    },
    {
        nome: "Açaí",
        subtitulo: "Superfruta amazônica",
        descricao: "Fruto da palmeira amazônica, rico em antioxidantes e energia. Base da alimentação ribeirinha.",
        usos: ["Açaí na Tigela", "Vitaminas", "Sorvetes"],
        classe: "acai"
    },
    {
        nome: "Mandioca",
        subtitulo: "Raiz brasileira versátil",
        descricao: "Raiz nativa do Brasil, base da alimentação indígena. Fonte de carboidratos e fibras.",
        usos: ["Farofa", "Tapioca", "Bolos"],
        classe: "mandioca"
    },
    {
        nome: "Guaraná",
        subtitulo: "Energia da Amazônia",
        descricao: "Fruto amazônico com propriedades energéticas naturais. Usado pelos índios há séculos.",
        usos: ["Bebidas", "Doces", "Suplementos"],
        classe: "guarana"
    }
];

// Estado da aplicação
let bookmarkedRecipes = [];
let activeFilter = 'todas';
let receitas = [];

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    loadReceitas();
    renderRegioes();
    renderTecnicas();
    renderIngredientes();
    setupEventListeners();
});

// Carregar receitas do backend
async function loadReceitas() {
    try {
        const response = await fetch('api/receitas.php');
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
                tags: ["Tradicional", "Feijão", "Carnes"],
                regiao: "sudeste",
                destaque: true,
                badge: "Prato Nacional"
            },
            {
                id: 2,
                nome: "Acarajé Baiano",
                descricao: "Bolinho de feijão fradinho frito no dendê, recheado com vatapá, caruru e camarão seco.",
                tempo: "2h 15min",
                pessoas: "6 pessoas",
                rating: 4.8,
                dificuldade: "Avançado",
                tags: ["Nordeste", "Dendê"],
                regiao: "nordeste"
            },
            {
                id: 3,
                nome: "Moqueca de Peixe",
                descricao: "Peixe cozido no leite de coco com dendê, pimentões e coentro. Sabor do mar brasileiro.",
                tempo: "45 min",
                pessoas: "4 pessoas",
                rating: 4.7,
                dificuldade: "Básico",
                tags: ["Peixe", "Coco"],
                regiao: "nordeste"
            },
            {
                id: 4,
                nome: "Brigadeiro Gourmet",
                descricao: "O doce mais amado do Brasil em versão sofisticada, com chocolate belga e coberturas especiais.",
                tempo: "30 min",
                pessoas: "20 unidades",
                rating: 4.9,
                dificuldade: "Básico",
                tags: ["Doce", "Chocolate"],
                regiao: "sudeste"
            },
            {
                id: 5,
                nome: "Coxinha de Frango",
                descricao: "Salgadinho brasileiro clássico com massa de batata, recheio de frango desfiado e temperos.",
                tempo: "1h 45min",
                pessoas: "30 unidades",
                rating: 4.8,
                dificuldade: "Intermediário",
                tags: ["Salgado", "Frango"],
                regiao: "sudeste"
            },
            {
                id: 6,
                nome: "Açaí Bowl Amazônico",
                descricao: "Açaí puro da Amazônia servido com granola, frutas tropicais e mel de abelhas nativas.",
                tempo: "15 min",
                pessoas: "2 pessoas",
                rating: 4.6,
                dificuldade: "Básico",
                tags: ["Saudável", "Açaí"],
                regiao: "norte"
            }
        ];
        renderReceitas();
    }
}

// Renderizar regiões
function renderRegioes() {
    const container = document.getElementById('regioesGrid');
    container.innerHTML = regioes.map(regiao => `
        <div class="regiao-card">
            <div class="regiao-header ${regiao.id}">
                <div class="regiao-content">
                    <h3>${regiao.nome}</h3>
                    <p>${regiao.descricao}</p>
                    <div class="especialidades">
                        ${regiao.especialidades.map(esp => `<span class="badge">${esp}</span>`).join('')}
                    </div>
                </div>
            </div>
            <div class="card-body">
                <h4>Culinária ${regiao.nome}</h4>
                <p>${regiao.detalhes}</p>
                <div class="card-stats">
                    <span>${regiao.receitas} receitas</span>
                    <span>${regiao.tecnicas} técnicas</span>
                </div>
                <button class="card-button">Explorar Região</button>
            </div>
        </div>
    `).join('');
}

// Renderizar receitas
function renderReceitas() {
    const container = document.getElementById('receitasGrid');
    const filteredReceitas = activeFilter === 'todas' 
        ? receitas 
        : receitas.filter(receita => receita.regiao === activeFilter);
    
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

// Renderizar técnicas
function renderTecnicas() {
    const container = document.getElementById('tecnicasGrid');
    container.innerHTML = tecnicas.map(tecnica => `
        <div class="tecnica-card">
            <div class="tecnica-header">
                <div class="tecnica-badges">
                    <span class="badge ${tecnica.nivel === 'Básico' ? 'bg-green-600' : 'bg-yellow-600'}">${tecnica.nivel}</span>
                    <span class="badge" style="background: rgba(0,0,0,0.6); margin-left: 8px;">${tecnica.duracao}</span>
                </div>
                <div class="tecnica-overlay">
                    <button class="play-btn">
                        <i class="fas fa-play"></i>
                        Assistir
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
                <button class="card-button">Aprender Técnica</button>
            </div>
        </div>
    `).join('');
}

// Renderizar ingredientes
function renderIngredientes() {
    const container = document.getElementById('ingredientesGrid');
    container.innerHTML = ingredientes.map(ingrediente => `
        <div class="ingrediente-card">
            <div class="ingrediente-header ${ingrediente.classe}">
                <div class="ingrediente-content">
                    <h3>${ingrediente.nome}</h3>
                    <p>${ingrediente.subtitulo}</p>
                </div>
            </div>
            <div class="ingrediente-body">
                <h4>${ingrediente.nome}</h4>
                <p>${ingrediente.descricao}</p>
                <div class="ingrediente-usos">
                    ${ingrediente.usos.map(uso => `<span class="uso-tag">${uso}</span>`).join('')}
                </div>
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

    // Smooth scroll para links de navegação
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

// Toggle bookmark
function toggleBookmark(recipeId) {
    if (bookmarkedRecipes.includes(recipeId)) {
        bookmarkedRecipes = bookmarkedRecipes.filter(id => id !== recipeId);
    } else {
        bookmarkedRecipes.push(recipeId);
    }
    renderReceitas();
    
    // Salvar no localStorage
    localStorage.setItem('bookmarkedRecipes', JSON.stringify(bookmarkedRecipes));
}

// Carregar bookmarks do localStorage
function loadBookmarks() {
    const saved = localStorage.getItem('bookmarkedRecipes');
    if (saved) {
        bookmarkedRecipes = JSON.parse(saved);
    }
}

// Obter classe de dificuldade
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
        const response = await fetch(`api/receita-detalhes.php?id=${recipeId}`);
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
        
        // Informações da receita
        document.getElementById('recipeInfo').innerHTML = `
            <div class="recipe-info-item">
                <span class="recipe-info-label">Preparo:</span>
                <span class="recipe-info-value">${recipeDetails.tempo_preparo || '30 min'}</span>
            </div>
            <div class="recipe-info-item">
                <span class="recipe-info-label">Cozimento:</span>
                <span class="recipe-info-value">${recipeDetails.tempo_cozimento || receita.tempo}</span>
            </div>
            <div class="recipe-info-item">
                <span class="recipe-info-label">Rendimento:</span>
                <span class="recipe-info-value">${recipeDetails.rendimento || receita.pessoas}</span>
            </div>
            <div class="recipe-info-item">
                <span class="recipe-info-label">Avaliação:</span>
                <span class="recipe-info-value"><i class="fas fa-star" style="color: #fbbf24;"></i> ${receita.rating}</span>
            </div>
        `;
        
        // Ingredientes
        if (recipeDetails.ingredientes) {
            const ingredientsByCategory = recipeDetails.ingredientes.reduce((acc, ing) => {
                if (!acc[ing.categoria]) acc[ing.categoria] = [];
                acc[ing.categoria].push(ing);
                return acc;
            }, {});
            
            const categoryNames = {
                'base': '🥘 Base',
                'carne': '🥩 Carnes',
                'vegetal': '🥬 Vegetais',
                'tempero': '🧄 Temperos',
                'fritura': '🫒 Fritura',
                'recheio': '🥄 Recheio'
            };
            
            document.getElementById('ingredientsList').innerHTML = Object.keys(ingredientsByCategory).map(categoria => `
                <div class="ingredients-category">
                    <h4>${categoryNames[categoria] || categoria}</h4>
                    <ul class="ingredients-list">
                        ${ingredientsByCategory[categoria].map(ing => `
                            <li class="ingredient-item">
                                <span class="ingredient-name">${ing.item}</span>
                                <span class="ingredient-quantity">${ing.quantidade}</span>
                            </li>
                        `).join('')}
                    </ul>
                </div>
            `).join('');
        }
        
        // Informações nutricionais
        if (recipeDetails.nutricao) {
            document.getElementById('nutritionInfo').innerHTML = `
                <h4><i class="fas fa-chart-bar"></i> Informações Nutricionais</h4>
                <div class="nutrition-grid">
                    <div class="nutrition-item">
                        <span class="nutrition-label">Calorias:</span>
                        <span class="nutrition-value">${recipeDetails.nutricao.calorias}</span>
                    </div>
                    <div class="nutrition-item">
                        <span class="nutrition-label">Proteínas:</span>
                        <span class="nutrition-value">${recipeDetails.nutricao.proteinas}</span>
                    </div>
                    <div class="nutrition-item">
                        <span class="nutrition-label">Carboidratos:</span>
                        <span class="nutrition-value">${recipeDetails.nutricao.carboidratos}</span>
                    </div>
                    <div class="nutrition-item">
                        <span class="nutrition-label">Gorduras:</span>
                        <span class="nutrition-value">${recipeDetails.nutricao.gorduras}</span>
                    </div>
                </div>
            `;
        }
        
        // Instruções
        if (recipeDetails.preparo) {
            document.getElementById('instructionsList').innerHTML = recipeDetails.preparo.map((passo, index) => `
                <div class="instruction-item">
                    <div class="instruction-number">${index + 1}</div>
                    <div class="instruction-text">${passo}</div>
                </div>
            `).join('');
        }
        
        // Dicas do chef
        if (recipeDetails.dicas) {
            document.getElementById('chefTips').innerHTML = `
                <h4><i class="fas fa-lightbulb"></i> Dicas do Chef</h4>
                <ul class="tips-list">
                    ${recipeDetails.dicas.map(dica => `
                        <li class="tip-item">
                            <span class="tip-icon">✨</span>
                            <span class="tip-text">${dica}</span>
                        </li>
                    `).join('')}
                </ul>
            `;
        }
        
        // Mostrar modal
        document.getElementById('receitaModal').classList.add('active');
        
    } catch (error) {
        console.error('Erro ao carregar detalhes da receita:', error);
    }
}

// Carregar bookmarks na inicialização
loadBookmarks();