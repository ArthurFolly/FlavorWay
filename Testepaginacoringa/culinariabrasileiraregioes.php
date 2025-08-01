<?php
require_once '/Testepaginacoringa/db_schema_regioes.php'; // Incluir o arquivo de configuração do banco de dados

// Verificar se a região foi especificada
$regiao_slug = isset($_GET['regiao']) ? $_GET['regiao'] : 'nordeste';

try {
    // Buscar dados da região
    $stmt = $pdo->prepare("SELECT * FROM regioes WHERE slug = ? AND ativo = 1");
    $stmt->execute([$regiao_slug]);
    $regiao = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$regiao) {
        header('Location: index.html');
        exit;
    }
    
} catch (PDOException $e) {
    header('Location: index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($regiao['hero_titulo']); ?> - FlavorWay</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/css/regiao-dinamica.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- CSS Dinâmico da Região -->
    <style>
        :root {
            --primary-color: <?php echo $regiao['tema_cor_primaria']; ?>;
            --secondary-color: <?php echo $regiao['tema_cor_secundaria']; ?>;
            --accent-color: <?php echo $regiao['tema_cor_accent']; ?>;
            --gradient-primary: linear-gradient(135deg, <?php echo $regiao['tema_cor_primaria']; ?> 0%, <?php echo $regiao['tema_cor_secundaria']; ?> 100%);
            --gradient-secondary: linear-gradient(135deg, <?php echo $regiao['tema_cor_accent']; ?> 0%, <?php echo $regiao['tema_cor_primaria']; ?> 100%);
        }
        
        .regiao-header {
            background: rgba(<?php echo hexToRgb($regiao['tema_cor_primaria']); ?>, 0.95);
        }
        
        .regiao-hero {
            background: linear-gradient(135deg, <?php echo $regiao['tema_cor_primaria']; ?> 0%, <?php echo $regiao['tema_cor_secundaria']; ?> 50%, <?php echo $regiao['tema_cor_accent']; ?> 100%);
        }
        
        .regiao-footer {
            background: <?php echo $regiao['tema_cor_primaria']; ?>;
        }
    </style>
</head>
<body class="regiao-theme" data-regiao="<?php echo $regiao['slug']; ?>">
    <!-- Header -->
    <header class="header regiao-header">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <i class="fas fa-utensils"></i>
                    <div>
                        <h1>FlavorWay</h1>
                        <span><?php echo htmlspecialchars($regiao['hero_titulo']); ?></span>
                    </div>
                </div>
                
                <nav class="nav">
                    <a href="index.html" class="nav-link">
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
                
                <!-- Seletor de Região -->
                <div class="region-selector">
                    <select id="regionSelect" onchange="changeRegion(this.value)">
                        <option value="">Escolha uma região</option>
                        <option value="nordeste" <?php echo $regiao['slug'] === 'nordeste' ? 'selected' : ''; ?>>Nordeste</option>
                        <option value="sudeste" <?php echo $regiao['slug'] === 'sudeste' ? 'selected' : ''; ?>>Sudeste</option>
                        <option value="sul" <?php echo $regiao['slug'] === 'sul' ? 'selected' : ''; ?>>Sul</option>
                        <option value="norte" <?php echo $regiao['slug'] === 'norte' ? 'selected' : ''; ?>>Norte</option>
                        <option value="centro-oeste" <?php echo $regiao['slug'] === 'centro-oeste' ? 'selected' : ''; ?>>Centro-Oeste</option>
                    </select>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="hero regiao-hero">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-icon"><?php echo $regiao['hero_icon']; ?></div>
                
                <h1 class="hero-title">
                    <?php echo htmlspecialchars($regiao['hero_titulo']); ?>
                </h1>
                
                <p class="hero-subtitle">
                    <?php echo htmlspecialchars($regiao['hero_subtitulo']); ?>
                </p>
                
                <p class="hero-description">
                    <?php echo htmlspecialchars($regiao['hero_descricao']); ?>
                </p>
                
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="scrollToSection('receitas')">
                        <i class="fas fa-utensils"></i>
                        Ver Receitas da Região
                        <i class="fas fa-arrow-right"></i>
                    </button>
                    <button class="btn btn-outline" onclick="scrollToSection('ingredientes')">
                        <i class="fas fa-seedling"></i>
                        Ingredientes Típicos
                    </button>
                </div>
                
                <div class="hero-stats">
                    <div class="stat-card">
                        <div class="stat-number" id="totalReceitas"><?php echo $regiao['total_receitas']; ?>+</div>
                        <div class="stat-label">Receitas Tradicionais</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number"><?php echo $regiao['total_estados']; ?></div>
                        <div class="stat-label">Estados</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="totalIngredientes"><?php echo $regiao['total_ingredientes']; ?>+</div>
                        <div class="stat-label">Ingredientes Únicos</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Estados da Região -->
    <section class="estados-section">
        <div class="container">
            <div class="section-header">
                <h2>Estados da <span class="highlight"><?php echo htmlspecialchars($regiao['nome']); ?></span></h2>
                <p>Cada estado contribui com suas especialidades culinárias únicas</p>
            </div>
            
            <div class="estados-grid" id="estadosGrid">
                <div class="loading">Carregando estados...</div>
            </div>
        </div>
    </section>

    <!-- Receitas da Região -->
    <section id="receitas" class="receitas">
        <div class="container">
            <div class="section-header">
                <h2>Receitas da <span class="highlight"><?php echo htmlspecialchars($regiao['nome']); ?></span></h2>
                <p>Os pratos mais autênticos e saborosos da região</p>
            </div>
            
            <!-- Filtros por Estado -->
            <div class="filtros" id="filtros">
                <button class="filtro-btn active" data-filtro="todos">Todos os Estados</button>
                <!-- Estados serão carregados dinamicamente -->
            </div>
            
            <div class="receitas-grid" id="receitasGrid">
                <div class="loading">Carregando receitas...</div>
            </div>
        </div>
    </section>

    <!-- Ingredientes da Região -->
    <section id="ingredientes" class="ingredientes">
        <div class="container">
            <div class="section-header">
                <h2>Ingredientes da <span class="highlight"><?php echo htmlspecialchars($regiao['nome']); ?></span></h2>
                <p>Os sabores únicos que definem a culinária da região</p>
            </div>
            
            <div class="ingredientes-grid" id="ingredientesGrid">
                <div class="loading">Carregando ingredientes...</div>
            </div>
        </div>
    </section>

    <!-- Técnicas da Região -->
    <section id="tecnicas" class="tecnicas">
        <div class="container">
            <div class="section-header">
                <h2>Técnicas <span class="highlight">Tradicionais</span></h2>
                <p>Métodos culinários passados de geração em geração</p>
            </div>
            
            <div class="tecnicas-grid" id="tecnicasGrid">
                <div class="loading">Carregando técnicas...</div>
            </div>
        </div>
    </section>

    <!-- Cultura e História -->
    <section id="cultura" class="cultura">
        <div class="container">
            <div class="section-header">
                <h2>Cultura <span class="highlight">Gastronômica</span></h2>
                <p>A rica história por trás dos sabores da região</p>
            </div>
            
            <div class="cultura-content" id="culturaContent">
                <div class="loading">Carregando informações culturais...</div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer regiao-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3><?php echo htmlspecialchars($regiao['hero_titulo']); ?></h3>
                    <p><?php echo htmlspecialchars($regiao['descricao']); ?></p>
                    <div class="social-links">
                        <a href="#" class="social-link">📘</a>
                        <a href="#" class="social-link">📷</a>
                        <a href="#" class="social-link">📺</a>
                    </div>
                </div>
                
                <div class="footer-section">
                    <h4>Estados</h4>
                    <ul id="footerEstados">
                        <!-- Estados serão carregados dinamicamente -->
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Pratos Típicos</h4>
                    <ul id="footerPratos">
                        <!-- Pratos serão carregados dinamicamente -->
                    </ul>
                </div>
                
                <div class="footer-section">
                    <h4>Outras Regiões</h4>
                    <ul>
                        <li><a href="regiao.php?regiao=nordeste">Nordeste</a></li>
                        <li><a href="regiao.php?regiao=sudeste">Sudeste</a></li>
                        <li><a href="regiao.php?regiao=sul">Sul</a></li>
                        <li><a href="regiao.php?regiao=norte">Norte</a></li>
                        <li><a href="regiao.php?regiao=centro-oeste">Centro-Oeste</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2024 FlavorWay. Celebrando a riqueza da culinária brasileira.</p>
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

    <!-- Scripts -->
    <script>
        // Configuração global da região
        window.REGIAO_ATUAL = '<?php echo $regiao['slug']; ?>';
        window.REGIAO_ID = <?php echo $regiao['id']; ?>;
    </script>
    <script src="assets/js/regiao-dinamica.js"></script>
</body>
</html>

<?php
// Função auxiliar para converter hex para RGB
function hexToRgb($hex) {
    $hex = str_replace('#', '', $hex);
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    return "$r, $g, $b";
}
?>