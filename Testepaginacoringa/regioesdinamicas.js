// Sistema dinâmico de regiões
class RegiaoDinamica {
    constructor() {
        this.regiaoAtual = window.REGIAO_ATUAL;
        this.regiaoId = window.REGIAO_ID;
        this.bookmarkedRecipes = [];
        this.activeFilter = 'todos';
        this.receitas = [];
        this.estados = [];
        this.ingredientes = [];
        this.tecnicas = [];
        this.cultura = [];
        
        this.init();
    }
    
    async init() {
        await this.loadData();
        this.setupEventListeners();
        this.loadBookmarks();
        this.renderAll();
    }
    
    async loadData() {
        try {
            // Carregar todos os dados em paralelo
            const [estadosRes, receitasRes, ingredientesRes, tecnicasRes, culturaRes] = await Promise.all([
                fetch(`api/estados-regiao.php?regiao=${this.regiaoAtual}`),
                fetch(`api/receitas-regiao.php?regiao=${this.regiaoAtual}`),
                fetch(`api/ingredientes-regiao.php?regiao=${this.regiaoAtual}`),
                fetch(`api/tecnicas-regiao.php?regiao=${this.regiaoAtual}`),
                fetch(`api/cultura-regiao.php?regiao=${this.regiaoAtual}`)
            ]);
            
            this.estados = await estadosRes.json();
            this.receitas = await receitasRes.json();
            this.ingredientes = await ingredientesRes.json();
            this.tecnicas = await tecnicasRes.json();
            this.cultura = await culturaRes.json();
            
        } catch (error) {
            console.error('Erro ao carregar dados:', error);
            this.loadFallbackData();
        }
    }
    
    loadFallbackData() {
        // Dados de fallback caso a API falhe
        this.estados = [
            {
                nome: "Estado Exemplo",
                slug: "exemplo",
                capital: "Capital",
                descricao: "Descrição do estado",
                especialidades: ["Prato 1", "Prato 2"],
                total_receitas: 5,
                ingrediente_destaque: "Ingrediente"
            }
        ];
        
        this.receitas = [
            {
                id: 1,
                nome: "Receita Exemplo",
                descricao: "Descrição da receita",
                tempo: "1h",
                pessoas: "4 pessoas",
                rating: 4.5,
                dificuldade: "Básico",
                tags: ["Tag1", "Tag2"],
                estado_slug: "exemplo"
            }
        ];
        
        this.ingredientes = [];
        this.tecnicas = [];
        this.cultura = [];
    }
    
    renderAll() {
        this.renderEstados();
        this.renderReceitas();
        this.renderIngredientes();
        this.renderTecnicas();
        this.renderCultura();
        this.renderFiltros();
        this.renderFooter();
    }
    
    renderEstados() {
        const container = document.getElementById('estadosGrid');
        if (!container) return;
        
        if (this.estados.length === 0) {
            container.innerHTML = '<div class="loading">Nenhum estado encontrado.</div>';
            return;
        }
        
        container.innerHTML = this.estados.map(estado => `
            <div class="estado-card" data-estado="${estado.slug}">
                <div class="estado-header">
                    <div class="estado-content">
                        <h3>${estado.nome}</h3>
                        <p>${estado.capital}</p>
                    </div>
                </div>
                <div class="estado-body">
                    <h4>${estado.descricao}</h4>
                    <div class="estado-especialidades">
                        ${this.renderEspecialidades(estado.especialidades)}
                    </div>
                    <div class="estado-stats">
                        <span>${estado.total_receitas}+ receitas</span>
                        <span>${estado.ingrediente_destaque}</span>
                    </div>
                    <button class="estado-button" onclick="regiaoDinamica.filterByEstado('${estado.slug}')">
                        Ver Receitas
                    </button>
                </div>
            </div>
        `).join('');
    }
    
    renderEspecialidades(especialidades) {
        if (!especialidades) return '';
        
        // Se especialidades é uma string JSON, fazer parse
        if (typeof especialidades === 'string') {
            try {
                especialidades = JSON.parse(especialidades);
            } catch (e) {
                return '';
            }
        }
        
        if (!Array.isArray(especialidades)) return '';
        
        return especialidades.map(esp => 
            `<span class="especialidade-tag">${esp}</span>`
        ).join('');
    }
    
    renderReceitas() {
        const container = document.getElementById('receitasGrid');
        if (!container) return;
        
        const filteredReceitas = this.activeFilter === 'todos' 
            ? this.receitas 
            : this.receitas.filter(receita => receita.estado_slug === this.activeFilter);
        
        if (filteredReceitas.length === 0) {
            container.innerHTML = '<div class="loading">Nenhuma receita encontrada.</div>';
            return;
        }
        
        container.innerHTML = filteredReceitas.map(receita => `
            <div class="receita-card ${receita.destaque ? 'destaque' : ''}">
                <div class="receita-header">
                    <div class="receita-badges">
                        <span class="badge ${this.getDifficultyClass(receita.dificuldade)}">${receita.dificuldade}</span>
                        ${receita.badge ? `<span class="badge" style="background: var(--gradient-primary); margin-top: 8px;">${receita.badge}</span>` : ''}
                    </div>
                    <button class="receita-bookmark ${this.bookmarkedRecipes.includes(receita.id) ? 'bookmarked' : ''}" 
                            onclick="regiaoDinamica.toggleBookmark(${receita.id})">
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
                        ${this.renderTags(receita.tags)}
                    </div>
                    
                    <button class="card-button" onclick="regiaoDinamica.openRecipeModal(${receita.id})">
                        Ver Receita Completa
                    </button>
                </div>
            </div>
        `).join('');
    }
    
    renderTags(tags) {
        if (!tags) return '';
        
        if (typeof tags === 'string') {
            try {
                tags = JSON.parse(tags);
            } catch (e) {
                return '';
            }
        }
        
        if (!Array.isArray(tags)) return '';
        
        return tags.map(tag => `<span class="tag">${tag}</span>`).join('');
    }
    
    renderIngredientes() {
        const container = document.getElementById('ingredientesGrid');
        if (!container) return;
        
        if (this.ingredientes.length === 0) {
            container.innerHTML = '<div class="loading">Nenhum ingrediente encontrado.</div>';
            return;
        }
        
        container.innerHTML = this.ingredientes.map(ingrediente => `
            <div class="ingrediente-card">
                <div class="ingrediente-header">
                    <div class="ingrediente-content">
                        <h3>${ingrediente.nome}</h3>
                        <p>${ingrediente.subtitulo || ''}</p>
                    </div>
                </div>
                <div class="ingrediente-body">
                    <h4>Origem ${ingrediente.origem || 'Regional'}</h4>
                    <p>${ingrediente.descricao}</p>
                    <div class="ingrediente-usos">
                        ${this.renderUsos(ingrediente.usos)}
                    </div>
                    <div style="margin-top: 12px; font-size: 0.875rem; color: #6b7280;">
                        <strong>Estados:</strong> ${this.renderEstadosIngrediente(ingrediente.estados)}
                    </div>
                </div>
            </div>
        `).join('');
    }
    
    renderUsos(usos) {
        if (!usos) return '';
        
        if (typeof usos === 'string') {
            try {
                usos = JSON.parse(usos);
            } catch (e) {
                return '';
            }
        }
        
        if (!Array.isArray(usos)) return '';
        
        return usos.map(uso => `<span class="uso-tag">${uso}</span>`).join('');
    }
    
    renderEstadosIngrediente(estados) {
        if (!estados) return 'Todos os estados';
        
        if (typeof estados === 'string') {
            try {
                estados = JSON.parse(estados);
            } catch (e) {
                return estados;
            }
        }
        
        if (Array.isArray(estados)) {
            return estados.join(', ');
        }
        
        return estados;
    }
    
    renderTecnicas() {
        const container = document.getElementById('tecnicasGrid');
        if (!container) return;
        
        if (this.tecnicas.length === 0) {
            container.innerHTML = '<div class="loading">Nenhuma técnica encontrada.</div>';
            return;
        }
        
        container.innerHTML = this.tecnicas.map(tecnica => `
            <div class="tecnica-card">
                <div class="tecnica-header">
                    <div class="tecnica-badges">
                        <span class="badge ${this.getDifficultyClass(tecnica.nivel)}">${tecnica.nivel}</span>
                        <span class="badge" style="background: rgba(0,0,0,0.6); margin-left: 8px;">${tecnica.duracao}</span>
                    </div>
                    <div class="tecnica-overlay">
                        <button class="play-btn">
                            <i class="fas fa-play"></i>
                            Aprender
                        </button>
                    </div>
                    <div class="tecnica-icon">${tecnica.icon || '🔥'}</div>
                </div>
                <div class="tecnica-body">
                    <div class="tecnica-title">
                        <div class="tecnica-emoji">${tecnica.icon || '🔥'}</div>
                        <h3>${tecnica.nome}</h3>
                    </div>
                    <p>${tecnica.descricao}</p>
                    <div style="margin-top: 12px; font-size: 0.875rem; color: var(--primary-color); font-weight: 600;">
                        Origem: ${tecnica.origem || 'Regional'}
                    </div>
                    <button class="card-button">Aprender Técnica</button>
                </div>
            </div>
        `).join('');
    }
    
    renderCultura() {
        const container = document.getElementById('culturaContent');
        if (!container) return;
        
        if (this.cultura.length === 0) {
            container.innerHTML = '<div class="loading">Nenhuma informação cultural encontrada.</div>';
            return;
        }
        
        container.innerHTML = this.cultura.map(item => `
            <div class="cultura-card">
                <div class="cultura-icon">${item.icon || '🏛️'}</div>
                <h3>${item.titulo}</h3>
                <p>${item.descricao}</p>
            </div>
        `).join('');
    }
    
    renderFiltros() {
        const container = document.getElementById('filtros');
        if (!container) return;
        
        const filtrosHtml = ['<button class="filtro-btn active" data-filtro="todos">Todos os Estados</button>'];
        
        this.estados.forEach(estado => {
            filtrosHtml.push(`<button class="filtro-btn" data-filtro="${estado.slug}">${estado.nome}</button>`);
        });
        
        container.innerHTML = filtrosHtml.join('');
    }
    
    renderFooter() {
        // Renderizar estados no footer
        const footerEstados = document.getElementById('footerEstados');
        if (footerEstados) {
            footerEstados.innerHTML = this.estados.map(estado => 
                `<li><a href="#" onclick="regiaoDinamica.filterByEstado('${estado.slug}')">${estado.nome}</a></li>`
            ).join('');
        }
        
        // Renderizar pratos típicos no footer
        const footerPratos = document.getElementById('footerPratos');
        if (footerPratos && this.receitas.length > 0) {
            const pratosDestaque = this.receitas.slice(0, 5);
            footerPratos.innerHTML = pratosDestaque.map(receita => 
                `<li><a href="#" onclick="regiaoDinamica.openRecipeModal(${receita.id})">${receita.nome}</a></li>`
            ).join('');
        }
    }
    
    setupEventListeners() {
        // Filtros de receitas
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('filtro-btn')) {
                document.querySelectorAll('.filtro-btn').forEach(btn => btn.classList.remove('active'));
                e.target.classList.add('active');
                this.activeFilter = e.target.dataset.filtro;
                this.renderReceitas();
            }
        });

        // Modal
        const modal = document.getElementById('receitaModal');
        const closeBtn = document.getElementById('modalClose');
        
        if (closeBtn) {
            closeBtn.addEventListener('click', () => {
                modal.classList.remove('active');
            });
        }
        
        if (modal) {
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                }
            });
        }

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
    
    filterByEstado(estadoSlug) {
        // Atualizar filtro ativo
        document.querySelectorAll('.filtro-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.filtro === estadoSlug) {
                btn.classList.add('active');
            }
        });
        
        this.activeFilter = estadoSlug;
        this.renderReceitas();
        this.scrollToSection('receitas');
    }
    
    toggleBookmark(recipeId) {
        if (this.bookmarkedRecipes.includes(recipeId)) {
            this.bookmarkedRecipes = this.bookmarkedRecipes.filter(id => id !== recipeId);
        } else {
            this.bookmarkedRecipes.push(recipeId);
        }
        this.renderReceitas();
        localStorage.setItem('bookmarkedRecipes', JSON.stringify(this.bookmarkedRecipes));
    }
    
    loadBookmarks() {
        const saved = localStorage.getItem('bookmarkedRecipes');
        if (saved) {
            this.bookmarkedRecipes = JSON.parse(saved);
        }
    }
    
    getDifficultyClass(dificuldade) {
        switch(dificuldade) {
            case 'Básico': return 'bg-green-600';
            case 'Intermediário': return 'bg-yellow-600';
            case 'Avançado': return 'bg-red-600';
            default: return 'bg-gray-600';
        }
    }
    
    scrollToSection(sectionId) {
        const element = document.getElementById(sectionId);
        if (element) {
            element.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
    
    async openRecipeModal(recipeId) {
        try {
            const response = await fetch(`api/receita-detalhes.php?id=${recipeId}`);
            const recipeDetails = await response.json();
            
            if (recipeDetails.error) {
                console.error('Receita não encontrada');
                return;
            }
            
            const receita = this.receitas.find(r => r.id === recipeId);
            if (!receita) return;
            
            // Preencher modal
            document.getElementById('modalTitulo').textContent = receita.nome;
            document.getElementById('modalMeta').innerHTML = `
                <span><i class="fas fa-clock"></i> ${receita.tempo}</span>
                <span><i class="fas fa-users"></i> ${receita.pessoas}</span>
                <span class="badge ${this.getDifficultyClass(receita.dificuldade)}">${receita.dificuldade}</span>
            `;
            document.getElementById('modalDescricao').textContent = receita.descricao;
            document.getElementById('modalTags').innerHTML = this.renderTags(receita.tags);
            
            // Preencher ingredientes e preparo se disponível
            if (recipeDetails.ingredientes) {
                document.getElementById('ingredientsList').innerHTML = recipeDetails.ingredientes.map(ing => 
                    `<div class="ingredient-item">
                        <span class="ingredient-amount">${ing.quantidade}</span>
                        <span class="ingredient-name">${ing.item}</span>
                    </div>`
                ).join('');
            }
            
            if (recipeDetails.preparo) {
                document.getElementById('instructionsList').innerHTML = recipeDetails.preparo.map((passo, index) => 
                    `<div class="instruction-step">
                        <div class="step-number">${index + 1}</div>
                        <div class="step-text">${passo.passo}</div>
                    </div>`
                ).join('');
            }
            
            if (recipeDetails.dicas) {
                document.getElementById('chefTips').innerHTML = `
                    <h4><i class="fas fa-lightbulb"></i> Dicas do Chef</h4>
                    ${recipeDetails.dicas.map(dica => `<p class="tip">${dica.dica}</p>`).join('')}
                `;
            }
            
            document.getElementById('receitaModal').classList.add('active');
            
        } catch (error) {
            console.error('Erro ao carregar detalhes da receita:', error);
        }
    }
}

// Função global para mudança de região
function changeRegion(regiao) {
    if (regiao && regiao !== window.REGIAO_ATUAL) {
        window.location.href = `regiao.php?regiao=${regiao}`;
    }
}

// Função global para scroll
function scrollToSection(sectionId) {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Inicializar quando o DOM estiver carregado
let regiaoDinamica;
document.addEventListener('DOMContentLoaded', function() {
    regiaoDinamica = new RegiaoDinamica();
});