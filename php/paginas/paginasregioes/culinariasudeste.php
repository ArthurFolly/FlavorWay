<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Culinária do Sudeste - FlavorWay</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="regiao.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="sudeste-theme">
    <!-- Header -->
    <header class="header sudeste-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-utensils"></i>
                    <div>
                        <h1>FlavorWay</h1>
                        <span>Culinária do Sudeste</span>
                    </div>
                </div>
                
                <nav class="nav">
                    <a href="../index.html" class="nav-link">
                        <i class="fas fa-home"></i>
                        <span>Início</span>
                    </a>
                    <a href="#receitas" class="nav-link">Receitas</a>
                    <a href="#ingredientes" class="nav-link">Ingredientes</a>
                    <a href="#tecnicas" class="nav-link">Técnicas</a>
                    <a href="#cultura" class="nav-link">Cultura</a>
                    <button class="search-btn">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                </nav>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero sudeste-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-icon">🏙️</div>
                
                <h1 class="hero-title">
                    Culinária do <span class="highlight">Sudeste</span>
                </h1>
                
                <p class="hero-description">
                    Explore a rica tradição culinária do Sudeste brasileiro! Uma região que combina 
                    influências portuguesas, africanas, italianas e árabes, criando pratos icônicos 
                    como a feijoada, o pão de açúcar e as delícias mineiras.
                </p>
                
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="scrollToSection('receitas')">
                        <i class="fas fa-utensils"></i>
                        Ver Receitas do Sudeste
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <button class="btn btn-outline" onclick="scrollToSection('ingredientes')">
                        <i class="fas fa-seedling"></i>
                        Ingredientes Típicos
                    </button>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number">40+</div>
                        <div class="stat-label">Receitas Tradicionais</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">4</div>
                        <div class="stat-label">Estados</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">15+</div>
                        <div class="stat-label">Ingredientes Únicos</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Estados do Sudeste -->
    <section class="estados-section">
        <div class="container">
            <div class="section-header">
                <h2>Estados do <span class="highlight">Sudeste</span></h2>
                <p>Cada estado contribui com suas tradições culinárias únicas</p>
            </div>
            
            <div class="estados-grid" id="estadosGrid">
                <!-- Estados serão carregados via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Receitas do Sudeste -->
    <section id="receitas" class="receitas">
        <div class="container">
            <div class="section-header">
                <h2>Receitas do <span class="highlight">Sudeste</span></h2>
                <p>Os pratos mais tradicionais e saborosos da região</p>
            </div>
            
            <!-- Filtros por Estado -->
            <div class="filtros" id="filtros">
                <button class="filtro-btn active" data-filtro="todos">Todos os Estados</button>
                <button class="filtro-btn" data-filtro="minas-gerais">Minas Gerais</button>
                <button class="filtro-btn" data-filtro="sao-paulo">São Paulo</button>
                <button class="filtro-btn" data-filtro="rio-de-janeiro">Rio de Janeiro</button>
                <button class="filtro-btn" data-filtro="espirito-santo">Espírito Santo</button>
            </div>
            
            <div class="receitas-grid" id="receitasGrid">
                <!-- Receitas serão carregadas via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Ingredientes do Sudeste -->
    <section id="ingredientes" class="ingredientes">
        <div class="container">
            <div class="section-header">
                <h2>Ingredientes do <span class="highlight">Sudeste</span></h2>
                <p>Os sabores que definem a culinária da região</p>
            </div>
            
            <div class="ingredientes-grid" id="ingredientesGrid">
                <!-- Ingredientes serão carregados via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Técnicas do Sudeste -->
    <section id="tecnicas" class="tecnicas">
        <div class="container">
            <div class="section-header">
                <h2>Técnicas <span class="highlight">Tradicionais</span></h2>
                <p>Métodos culinários tradicionais da região</p>
            </div>
            
            <div class="tecnicas-grid" id="tecnicasGrid">
                <!-- Técnicas serão carregadas via JavaScript -->
            </div>
        </div>
    </section>

    <!-- Cultura e História -->
    <section id="cultura" class="cultura">
        <div class="container">
            <div class="section-header">
                <h2>Cultura <span class="highlight">Gastronômica</span></h2>
                <p>A história por trás dos sabores do Sudeste</p>
            </div>
            
            <div class="cultura-content">
                <div class="cultura-card">
                    <div class="cultura-icon">🇵🇹</div>
                    <h3>Herança Portuguesa</h3>
                    <p>A colonização portuguesa deixou marcas profundas na culinária sudestina, especialmente em Minas Gerais, com pratos como o feijão tropeiro e a linguiça.</p>
                </div>
                
                <div class="cultura-card">
                    <div class="cultura-icon">🇮🇹</div>
                    <h3>Imigração Italiana</h3>
                    <p>A forte imigração italiana, principalmente em São Paulo, trouxe massas, pizzas e técnicas que se tornaram parte da identidade culinária da região.</p>
                </div>
                
                <div class="cultura-card">
                    <div class="cultura-icon">☕</div>
                    <h3>Cultura do Café</h3>
                    <p>O Sudeste é o berço da cultura cafeeira no Brasil, influenciando não apenas a economia, mas também os hábitos alimentares e sociais da região.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer sudeste-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Culinária do Sudeste</h3>
                    <p>Descubra a diversidade gastronômica da região mais populosa do Brasil, onde tradição e modernidade se encontram.</p>
                    <div class="social-links">
                        <a href="#" class="social-link">📘</a>
                        <a href="#" class="social-link">📷</a>
                        <a href="#" class="social-link">📺</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Estados</h4>
                    <ul>
                        <li><a href="#">Minas Gerais</a></li>
                        <li><a href="#">São Paulo</a></li>
                        <li><a href="#">Rio de Janeiro</a></li>
                        <li><a href="#">Espírito Santo</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Pratos Típicos</h4>
                    <ul>
                        <li><a href="#">Feijoada</a></li>
                        <li><a href="#">Pão de Açúcar</a></li>
                        <li><a href="#">Brigadeiro</a></li>
                        <li><a href="#">Feijão Tropeiro</a></li>
                        <li><a href="#">Coxinha</a></li>
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Outras Regiões</h4>
                    <ul>
                        <li><a href="nordeste.html">Nordeste</a></li>
                        <li><a href="sul.html">Sul</a></li>
                        <li><a href="norte.html">Norte</a></li>
                        <li><a href="centro-oeste.html">Centro-Oeste</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 FlavorWay. Celebrando a riqueza da culinária do Sudeste.</p>
            </div>
        </div>
    </footer>

    <!-- Modal de Receita -->
    <div id="receitaModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title-section">
                    <div class="modal-icon">🍽️</div>
                    <div class="modal-title-info">
                        <h2 id="modalTitulo"></h2>
                        <div class="modal-meta" id="modalMeta"></div>
                    </div>
                </div>
                <button class="modal-close" id="modalClose">&times;</button>
            </div>
            
            <div class="modal-body">
                <div class="modal-description" id="modalDescricao"></div>
                <div class="modal-tags" id="modalTags"></div>
                
                <div class="modal-content-grid">
                    <div class="modal-ingredients">
                        <h3><i class="fas fa-shopping-cart"></i> Ingredientes</h3>
                        <div class="recipe-info" id="recipeInfo"></div>
                        <div class="ingredients-list" id="ingredientsList"></div>
                        <div class="nutrition-info" id="nutritionInfo"></div>
                    </div>
                    
                    <div class="modal-instructions">
                        <h3><i class="fas fa-chef-hat"></i> Modo de Preparo</h3>
                        <div class="instructions-list" id="instructionsList"></div>
                        <div class="chef-tips" id="chefTips"></div>
                        
                        <div class="modal-actions">
                            <button class="btn btn-primary">
                                <i class="fas fa-bookmark"></i>
                                Salvar Receita
                            </button>
                            <button class="btn btn-outline">
                                <i class="fas fa-share"></i>
                                Compartilhar
                            </button>
                            <button class="btn btn-outline">
                                <i class="fas fa-print"></i>
                                Imprimir
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="sudeste.js"></script>
</body>
</html>