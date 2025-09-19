<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlavorWay - Sua Jornada Culinária</title>
    <link rel="stylesheet" href="../../css/index/culinariabrasileiraregioespadrao.css">
    <link rel="stylesheet" href="../../css/index/components.css">
    <link rel="stylesheet" href="../../css/index/responsive.css">
    <link rel="stylesheet" href="../../css/index/index.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <h1>FlavorWay</h1>
                </div>
                
                <nav class="nav" id="nav">
                    <a href="#cuisines" class="nav-link">
                        <i class="fas fa-book"></i>
                        Culinárias
                    </a>
                    <a href="#recipes" class="nav-link">Receitas</a>
                    <a href="#techniques" class="nav-link">Técnicas</a>
                    <a href="#ingredients" class="nav-link">Ingredientes</a>
                    <a href="#community" class="nav-link">
                        <i class="fas fa-users"></i>
                        Comunidade
                    </a>
                    <button class="btn btn-secondary">
                        <i class="fas fa-search"></i>
                        Buscar
                    </button>
                    <button class="btn btn-secondary">
                        Login
                    </button>
                </nav>
                
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <h1 class="hero-title">
                    Desperte o <span class="text-secondary">Chef</span> em Você
                </h1>
                <p class="hero-description">
                    Aprenda a cozinhar com criatividade através de combinações únicas de ingredientes, técnicas e sabores.
                    Transforme sua cozinha em um laboratório de descobertas gastronômicas.
                </p>
                <div class="hero-buttons">
                    <button class="btn btn-secondary btn-lg">
                        <i class="fas fa-sparkles"></i>
                        Começar Jornada
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <button class="btn btn-outline btn-lg">
                        Explorar Receitas
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Cuisine Categories -->
    <section id="cuisines" class="cuisines">
        <div class="container">
            <div class="section-header">
                <h2>Explore <span class="text-secondary">Culinárias</span> do Mundo</h2>
                <p>Cada culinária tem sua personalidade única. Descubra técnicas, ingredientes e combinações que fazem de cada tradição gastronômica uma experiência especial.</p>
            </div>
            
            <div class="cuisines-grid">
                <div class="cuisine-card">
                    <div class="cuisine-image brazilian">
                        <div class="cuisine-overlay"></div>
                        <h3>Culinária Brasileira</h3>
                    </div>
                    <div class="cuisine-content">
                        <p>Sabores tropicais, temperos marcantes e a diversidade regional do Brasil</p>
                        <div class="cuisine-stats">
                            <span>120+ receitas</span>
                            <span>15 técnicas</span>
                        </div>
                        <button class="btn btn-primary" onclick=location.href="html/culinariabrasileira.html">
                            Explorar Culinária
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <div class="cuisine-card">
                    <div class="cuisine-image french">
                        <div class="cuisine-overlay"></div>
                        <h3>Culinária Francesa</h3>
                    </div>
                    <div class="cuisine-content">
                        <p>Elegância, técnicas refinadas e a arte da gastronomia clássica</p>
                        <div class="cuisine-stats">
                            <span>95+ receitas</span>
                            <span>20 técnicas</span>
                        </div>
                        <button class="btn btn-primary">
                            Explorar Culinária
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
                
                <div class="cuisine-card">
                    <div class="cuisine-image italian">
                        <div class="cuisine-overlay"></div>
                        <h3>Culinária Italiana</h3>
                    </div>
                    <div class="cuisine-content">
                        <p>Simplicidade, ingredientes frescos e tradições familiares milenares</p>
                        <div class="cuisine-stats">
                            <span>110+ receitas</span>
                            <span>12 técnicas</span>
                        </div>
                        <button class="btn btn-primary">
                            Explorar Culinária
                            <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="section-footer">
                <button class="btn btn-outline-secondary btn-lg">
                    Ver Todas as Culinárias
                </button>
            </div>
        </div>
    </section>

    <!-- Featured Recipes -->
    <section id="recipes" class="recipes">
        <div class="container">
            <div class="section-header">
                <h2>Receitas em <span class="text-secondary">Destaque</span></h2>
                <p>Combinações criativas que quebram barreiras culinárias. Aprenda a criar pratos únicos misturando técnicas e sabores de diferentes tradições.</p>
            </div>
            
            <div class="recipes-grid">
                <div class="recipe-card">
                    <div class="recipe-image">
                        <img src="https://via.placeholder.com/350x250/FF6B6B/FFFFFF?text=Risotto+Camarão" alt="Risotto de Camarão">
                        <div class="recipe-category">Fusão</div>
                        <button class="recipe-bookmark">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <div class="recipe-content">
                        <h3>Risotto de Camarão com Açafrão</h3>
                        <p>Fusão entre a cremosidade italiana e os sabores tropicais brasileiros</p>
                        <div class="recipe-meta">
                            <span><i class="fas fa-clock"></i> 35 min</span>
                            <span><i class="fas fa-users"></i> 4 pessoas</span>
                            <span><i class="fas fa-star"></i> 4.8</span>
                        </div>
                        <div class="recipe-tags">
                            <span class="tag">Frutos do Mar</span>
                            <span class="tag">Cremoso</span>
                        </div>
                        <button class="btn btn-primary">Ver Receita</button>
                    </div>
                </div>
                
                <div class="recipe-card">
                    <div class="recipe-image">
                        <img src="https://via.placeholder.com/350x250/4ECDC4/FFFFFF?text=Coq+au+Vin" alt="Coq au Vin Brasileiro">
                        <div class="recipe-category">Fusão</div>
                        <button class="recipe-bookmark">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <div class="recipe-content">
                        <h3>Coq au Vin Brasileiro</h3>
                        <p>Clássico francês com toque de cachaça e temperos nacionais</p>
                        <div class="recipe-meta">
                            <span><i class="fas fa-clock"></i> 1h 20min</span>
                            <span><i class="fas fa-users"></i> 6 pessoas</span>
                            <span><i class="fas fa-star"></i> 4.9</span>
                        </div>
                        <div class="recipe-tags">
                            <span class="tag">Aves</span>
                            <span class="tag">Vinho</span>
                        </div>
                        <button class="btn btn-primary">Ver Receita</button>
                    </div>
                </div>
                
                <div class="recipe-card">
                    <div class="recipe-image">
                        <img src="https://via.placeholder.com/350x250/45B7D1/FFFFFF?text=Gnocchi+Mandioca" alt="Gnocchi de Mandioca">
                        <div class="recipe-category">Inovação</div>
                        <button class="recipe-bookmark">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <div class="recipe-content">
                        <h3>Gnocchi de Mandioca</h3>
                        <p>Massa italiana com ingrediente tipicamente brasileiro</p>
                        <div class="recipe-meta">
                            <span><i class="fas fa-clock"></i> 45 min</span>
                            <span><i class="fas fa-users"></i> 4 pessoas</span>
                            <span><i class="fas fa-star"></i> 4.7</span>
                        </div>
                        <div class="recipe-tags">
                            <span class="tag">Massas</span>
                            <span class="tag">Vegetariano</span>
                        </div>
                        <button class="btn btn-primary">Ver Receita</button>
                    </div>
                </div>
                
                <div class="recipe-card">
                    <div class="recipe-image">
                        <img src="https://via.placeholder.com/350x250/F7DC6F/FFFFFF?text=Bouillabaisse" alt="Bouillabaisse Nordestina">
                        <div class="recipe-category">Fusão</div>
                        <button class="recipe-bookmark">
                            <i class="fas fa-bookmark"></i>
                        </button>
                    </div>
                    <div class="recipe-content">
                        <h3>Bouillabaisse Nordestina</h3>
                        <p>Sopa de peixe francesa com peixes e temperos do Nordeste</p>
                        <div class="recipe-meta">
                            <span><i class="fas fa-clock"></i> 1h 10min</span>
                            <span><i class="fas fa-users"></i> 6 pessoas</span>
                            <span><i class="fas fa-star"></i> 4.6</span>
                        </div>
                        <div class="recipe-tags">
                            <span class="tag">Sopas</span>
                            <span class="tag">Peixes</span>
                        </div>
                        <button class="btn btn-primary">Ver Receita</button>
                    </div>
                </div>
            </div>
            
            <div class="section-footer">
                <button class="btn btn-secondary btn-lg">
                    Explorar Todas as Receitas
                </button>
            </div>
        </div>
    </section>

    <!-- Techniques Section -->
    <section id="techniques" class="techniques">
        <div class="container">
            <div class="section-header">
                <h2>Domine <span class="text-secondary">Técnicas</span> Culinárias</h2>
                <p>Aprenda técnicas fundamentais e avançadas que vão transformar sua forma de cozinhar. Cada técnica é explicada de forma didática e prática.</p>
            </div>
            
            <div class="techniques-grid">
                <div class="technique-card">
                    <div class="technique-image">
                        <img src="https://via.placeholder.com/300x200/E74C3C/FFFFFF?text=Sous+Vide" alt="Sous Vide">
                        <div class="technique-overlay">
                            <button class="play-btn">
                                <i class="fas fa-play"></i>
                                Assistir
                            </button>
                        </div>
                        <div class="technique-level">Avançado</div>
                        <div class="technique-duration">15 min</div>
                    </div>
                    <div class="technique-content">
                        <div class="technique-header">
                            <div class="technique-icon">
                                <i class="fas fa-award"></i>
                            </div>
                            <h3>Sous Vide Caseiro</h3>
                        </div>
                        <p>Aprenda a técnica francesa de cozimento a baixa temperatura usando equipamentos domésticos</p>
                        <button class="btn btn-primary">Aprender Técnica</button>
                    </div>
                </div>
                
                <div class="technique-card">
                    <div class="technique-image">
                        <img src="https://via.placeholder.com/300x200/27AE60/FFFFFF?text=Fermentação" alt="Fermentação">
                        <div class="technique-overlay">
                            <button class="play-btn">
                                <i class="fas fa-play"></i>
                                Assistir
                            </button>
                        </div>
                        <div class="technique-level">Intermediário</div>
                        <div class="technique-duration">12 min</div>
                    </div>
                    <div class="technique-content">
                        <div class="technique-header">
                            <div class="technique-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h3>Fermentação Natural</h3>
                        </div>
                        <p>Domine a arte da fermentação para criar sabores únicos e probióticos naturais</p>
                        <button class="btn btn-primary">Aprender Técnica</button>
                    </div>
                </div>
                
                <div class="technique-card">
                    <div class="technique-image">
                        <img src="https://via.placeholder.com/300x200/3498DB/FFFFFF?text=Emulsificação" alt="Emulsificação">
                        <div class="technique-overlay">
                            <button class="play-btn">
                                <i class="fas fa-play"></i>
                                Assistir
                            </button>
                        </div>
                        <div class="technique-level">Básico</div>
                        <div class="technique-duration">8 min</div>
                    </div>
                    <div class="technique-content">
                        <div class="technique-header">
                            <div class="technique-icon">
                                <i class="fas fa-play"></i>
                            </div>
                            <h3>Emulsificação Perfeita</h3>
                        </div>
                        <p>Segredos para criar molhos cremosos e estáveis sem separar</p>
                        <button class="btn btn-primary">Aprender Técnica</button>
                    </div>
                </div>
            </div>
            
            <div class="masterclass-banner">
                <h3>Masterclass Completa</h3>
                <p>Acesse nossa biblioteca completa com mais de 50 técnicas culinárias, desde o básico até técnicas de alta gastronomia, todas explicadas passo a passo.</p>
                <button class="btn btn-secondary btn-lg">Ver Todas as Técnicas</button>
            </div>
        </div>
    </section>

    <!-- Ingredient Explorer -->
    <section id="ingredients" class="ingredients">
        <div class="container">
            <div class="section-header">
                <h2>Explore <span class="text-secondary">Ingredientes</span></h2>
                <p>Descubra ingredientes únicos e aprenda combinações que criam sabores extraordinários. Nosso explorador de ingredientes te guia na criação de pratos inovadores.</p>
            </div>
            
            <div class="ingredient-search">
                <h3>Buscar por Ingredientes</h3>
                <div class="search-container">
                    <div class="search-input">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Digite um ingrediente (ex: açafrão, quinoa, miso...)">
                    </div>
                    <button class="btn btn-primary">
                        <i class="fas fa-filter"></i>
                        Filtros
                    </button>
                </div>
                <button class="btn btn-secondary">
                    <i class="fas fa-sparkles"></i>
                    Gerar Combinação Aleatória
                </button>
            </div>
            
            <div class="ingredient-categories">
                <div class="ingredient-category spices">
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <h4>Especiarias Exóticas</h4>
                        <p>45+ ingredientes</p>
                    </div>
                </div>
                <div class="ingredient-category herbs">
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <h4>Ervas Aromáticas</h4>
                        <p>30+ ingredientes</p>
                    </div>
                </div>
                <div class="ingredient-category proteins">
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <h4>Proteínas Alternativas</h4>
                        <p>25+ ingredientes</p>
                    </div>
                </div>
                <div class="ingredient-category grains">
                    <div class="category-overlay"></div>
                    <div class="category-content">
                        <h4>Grãos Ancestrais</h4>
                        <p>20+ ingredientes</p>
                    </div>
                </div>
            </div>
            
            <div class="featured-combinations">
                <h3>Combinações em Destaque</h3>
                <div class="combinations-grid">
                    <div class="combination-card">
                        <div class="combination-ingredients">
                            <span class="ingredient">Açafrão</span>
                            <span class="ingredient">Leite de Coco</span>
                            <span class="ingredient">Camarão</span>
                        </div>
                        <h4>Sabor tropical sofisticado</h4>
                        <p>12 receitas disponíveis</p>
                        <button class="btn btn-primary">Ver Receitas</button>
                    </div>
                    
                    <div class="combination-card">
                        <div class="combination-ingredients">
                            <span class="ingredient">Miso</span>
                            <span class="ingredient">Manteiga</span>
                            <span class="ingredient">Alho</span>
                        </div>
                        <h4>Umami cremoso intenso</h4>
                        <p>8 receitas disponíveis</p>
                        <button class="btn btn-primary">Ver Receitas</button>
                    </div>
                    
                    <div class="combination-card">

