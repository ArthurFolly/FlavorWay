-- Estrutura para sistema dinâmico de regiões

-- Tabela de regiões
CREATE TABLE regioes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    slug VARCHAR(50) NOT NULL UNIQUE,
    descricao TEXT NOT NULL,
    hero_titulo VARCHAR(200) NOT NULL,
    hero_subtitulo VARCHAR(300) NOT NULL,
    hero_descricao TEXT NOT NULL,
    hero_icon VARCHAR(10) DEFAULT '🍽️',
    tema_cor_primaria VARCHAR(7) DEFAULT '#ea580c',
    tema_cor_secundaria VARCHAR(7) DEFAULT '#eab308',
    tema_cor_accent VARCHAR(7) DEFAULT '#dc2626',
    total_receitas INT DEFAULT 0,
    total_estados INT DEFAULT 0,
    total_ingredientes INT DEFAULT 0,
    ativo BOOLEAN DEFAULT TRUE,
    ordem INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de estados por região
CREATE TABLE estados_regiao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regiao_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    slug VARCHAR(50) NOT NULL,
    capital VARCHAR(100) NOT NULL,
    descricao TEXT,
    total_receitas INT DEFAULT 0,
    ingrediente_destaque VARCHAR(100),
    especialidades JSON,
    ativo BOOLEAN DEFAULT TRUE,
    ordem INT DEFAULT 0,
    FOREIGN KEY (regiao_id) REFERENCES regioes(id) ON DELETE CASCADE,
    UNIQUE KEY unique_estado_regiao (regiao_id, slug)
);

-- Tabela de ingredientes por região
CREATE TABLE ingredientes_regiao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regiao_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    subtitulo VARCHAR(200),
    descricao TEXT NOT NULL,
    origem VARCHAR(50),
    usos JSON,
    estados JSON,
    imagem VARCHAR(255),
    ativo BOOLEAN DEFAULT TRUE,
    ordem INT DEFAULT 0,
    FOREIGN KEY (regiao_id) REFERENCES regioes(id) ON DELETE CASCADE
);

-- Tabela de técnicas por região
CREATE TABLE tecnicas_regiao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regiao_id INT NOT NULL,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    nivel ENUM('Básico', 'Intermediário', 'Avançado') NOT NULL,
    duracao VARCHAR(50) NOT NULL,
    icon VARCHAR(10) DEFAULT '🔥',
    origem VARCHAR(50),
    video_url VARCHAR(255),
    ativo BOOLEAN DEFAULT TRUE,
    ordem INT DEFAULT 0,
    FOREIGN KEY (regiao_id) REFERENCES regioes(id) ON DELETE CASCADE
);

-- Tabela de cultura por região
CREATE TABLE cultura_regiao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    regiao_id INT NOT NULL,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT NOT NULL,
    icon VARCHAR(10) DEFAULT '🏛️',
    tipo ENUM('influencia', 'tradicao', 'historia') DEFAULT 'influencia',
    ativo BOOLEAN DEFAULT TRUE,
    ordem INT DEFAULT 0,
    FOREIGN KEY (regiao_id) REFERENCES regioes(id) ON DELETE CASCADE
);

-- Atualizar tabela de receitas para incluir estado_slug
ALTER TABLE receitas ADD COLUMN estado_slug VARCHAR(50) AFTER estado;

-- Inserir dados das regiões
INSERT INTO regioes (nome, slug, descricao, hero_titulo, hero_subtitulo, hero_descricao, hero_icon, tema_cor_primaria, tema_cor_secundaria, tema_cor_accent, total_estados) VALUES
('Nordeste', 'nordeste', 'Região de sabores intensos e temperos marcantes', 'Culinária do Nordeste', 'Sabores intensos e tradições ancestrais', 'Descubra os sabores intensos e temperos marcantes da culinária nordestina! Uma região rica em tradições africanas, indígenas e portuguesas, onde o dendê, o coco e os frutos do mar criam pratos únicos e inesquecíveis.', '🌶️', '#ea580c', '#eab308', '#dc2626', 9),
('Sudeste', 'sudeste', 'Região de diversidade gastronômica e tradições', 'Culinária do Sudeste', 'Tradição e modernidade em harmonia', 'Explore a rica tradição culinária do Sudeste brasileiro! Uma região que combina influências portuguesas, africanas, italianas e árabes, criando pratos icônicos como a feijoada, o pão de açúcar e as delícias mineiras.', '🏙️', '#dc2626', '#7c2d12', '#ea580c', 4),
('Sul', 'sul', 'Região de influência europeia e tradições gaúchas', 'Culinária do Sul', 'Tradições europeias e sabores gaúchos', 'Conheça a culinária sulista, marcada pela forte influência europeia! Churrasco gaúcho, pratos alemães e italianos adaptados ao paladar brasileiro, criando uma identidade gastronômica única.', '🥩', '#16a34a', '#7c2d12', '#eab308', 3),
('Norte', 'norte', 'Região amazônica com ingredientes únicos', 'Culinária do Norte', 'Sabores da Amazônia', 'Descubra os sabores exóticos da Amazônia! Ingredientes únicos como açaí, tucumã, pirarucu e jambu criam uma culinária rica em nutrientes e tradições indígenas preservadas.', '🌿', '#16a34a', '#eab308', '#059669', 7),
('Centro-Oeste', 'centro-oeste', 'Região do pantanal e cerrado', 'Culinária do Centro-Oeste', 'Sabores do pantanal e cerrado', 'Explore a culinária do coração do Brasil! Peixes do pantanal, pequi do cerrado e tradições que misturam influências de todas as regiões brasileiras.', '🐟', '#7c2d12', '#ea580c', '#eab308', 4);

-- Inserir estados do Nordeste
INSERT INTO estados_regiao (regiao_id, nome, slug, capital, descricao, ingrediente_destaque, especialidades) VALUES
(1, 'Bahia', 'bahia', 'Salvador', 'Berço da culinária afro-brasileira', 'Dendê', '["Acarajé", "Moqueca", "Vatapá", "Caruru"]'),
(1, 'Pernambuco', 'pernambuco', 'Recife', 'Tradição doce e salgada', 'Queijo Coalho', '["Caldinho de Feijão", "Bolo de Rolo", "Cartola"]'),
(1, 'Ceará', 'ceara', 'Fortaleza', 'Sabores do sertão e do mar', 'Carne de Sol', '["Baião de Dois", "Carne de Sol", "Tapioca"]'),
(1, 'Maranhão', 'maranhao', 'São Luís', 'Influência francesa e africana', 'Vinagreira', '["Arroz de Cuxá", "Torta de Camarão", "Juçara"]');

-- Inserir estados do Sudeste
INSERT INTO estados_regiao (regiao_id, nome, slug, capital, descricao, ingrediente_destaque, especialidades) VALUES
(2, 'Minas Gerais', 'minas-gerais', 'Belo Horizonte', 'Tradição mineira autêntica', 'Queijo Minas', '["Feijão Tropeiro", "Pão de Queijo", "Doce de Leite"]'),
(2, 'São Paulo', 'sao-paulo', 'São Paulo', 'Fusão de culturas imigrantes', 'Linguiça', '["Virado à Paulista", "Coxinha", "Pastel"]'),
(2, 'Rio de Janeiro', 'rio-de-janeiro', 'Rio de Janeiro', 'Berço da feijoada brasileira', 'Cachaça', '["Feijoada", "Brigadeiro", "Biscoito Globo"]'),
(2, 'Espírito Santo', 'espirito-santo', 'Vitória', 'Sabores do mar capixaba', 'Urucum', '["Moqueca Capixaba", "Torta Capixaba"]');

-- Inserir ingredientes do Nordeste
INSERT INTO ingredientes_regiao (regiao_id, nome, subtitulo, descricao, origem, usos, estados) VALUES
(1, 'Dendê', 'Óleo sagrado da Bahia', 'Extraído da palma africana, é o ingrediente mais característico da culinária baiana. Rico em vitamina A e betacaroteno.', 'Africana', '["Acarajé", "Moqueca", "Vatapá", "Caruru"]', '["Bahia", "Sergipe"]'),
(1, 'Carne de Sol', 'Proteína do sertão', 'Carne bovina salgada e seca ao sol, técnica de conservação tradicional do sertão nordestino.', 'Sertaneja', '["Baião de Dois", "Paçoca de Carne", "Escondidinho"]', '["Ceará", "Rio Grande do Norte", "Paraíba"]'),
(1, 'Queijo Coalho', 'Queijo do nordeste', 'Queijo fresco e salgado, tradicionalmente assado na brasa. Acompanhamento perfeito para a rapadura.', 'Sertaneja', '["Grelhado", "Espetinho", "Sanduíches"]', '["Pernambuco", "Ceará", "Paraíba"]');

-- Inserir ingredientes do Sudeste
INSERT INTO ingredientes_regiao (regiao_id, nome, subtitulo, descricao, origem, usos, estados) VALUES
(2, 'Queijo Minas', 'Tradição mineira', 'Queijo fresco e cremoso, produzido artesanalmente em Minas Gerais. Base do famoso pão de queijo.', 'Mineira', '["Pão de Queijo", "Doces", "Pratos Salgados"]', '["Minas Gerais"]'),
(2, 'Doce de Leite', 'Doçura mineira', 'Doce cremoso feito com leite e açúcar, cozido lentamente até atingir consistência perfeita.', 'Mineira', '["Sobremesas", "Recheios", "Acompanhamentos"]', '["Minas Gerais", "São Paulo"]'),
(2, 'Cachaça', 'Aguardente brasileira', 'Destilado de cana-de-açúcar, ingrediente principal da caipirinha e diversos pratos flambados.', 'Colonial', '["Caipirinha", "Pratos Flambados", "Marinadas"]', '["Todos os estados"]');

-- Inserir técnicas do Nordeste
INSERT INTO tecnicas_regiao (regiao_id, nome, descricao, nivel, duracao, icon, origem) VALUES
(1, 'Fritura no Dendê', 'Técnica tradicional baiana para frituras, mantendo a temperatura ideal do dendê para não queimar.', 'Intermediário', '15 min', '🔥', 'Africana'),
(1, 'Salga da Carne de Sol', 'Processo de conservação da carne através da salga e secagem ao sol, técnica milenar do sertão.', 'Avançado', '3 dias', '☀️', 'Sertaneja'),
(1, 'Preparo do Vatapá', 'Técnica para fazer o cremoso vatapá baiano, equilibrando leite de coco, dendê e temperos.', 'Intermediário', '45 min', '🥥', 'Africana');

-- Inserir técnicas do Sudeste
INSERT INTO tecnicas_regiao (regiao_id, nome, descricao, nivel, duracao, icon, origem) VALUES
(2, 'Preparo da Feijoada', 'Técnica tradicional carioca para cozinhar feijão preto com carnes defumadas e temperos especiais.', 'Intermediário', '4h', '🍲', 'Carioca'),
(2, 'Massa do Pão de Queijo', 'Técnica mineira para preparar a massa perfeita com polvilho, queijo e ovos.', 'Básico', '30 min', '🧀', 'Mineira'),
(2, 'Doce de Leite Caseiro', 'Método tradicional mineiro para fazer doce de leite cremoso e sem grumos.', 'Intermediário', '2h', '🥛', 'Mineira');

-- Inserir cultura do Nordeste
INSERT INTO cultura_regiao (regiao_id, titulo, descricao, icon, tipo) VALUES
(1, 'Influência Africana', 'A culinária nordestina foi profundamente influenciada pela cultura africana, especialmente na Bahia. O dendê, o azeite de dendê, e pratos como acarajé e vatapá são heranças diretas dessa rica tradição.', '🏛️', 'influencia'),
(1, 'Tradição Indígena', 'Os povos indígenas contribuíram com ingredientes como mandioca, milho, frutas tropicais e técnicas de preparo que ainda são utilizadas hoje, como o uso da farinha de mandioca.', '🌿', 'tradicao'),
(1, 'Herança Portuguesa', 'Os colonizadores portugueses trouxeram técnicas de conservação, temperos e a tradição dos doces conventuais, que se adaptaram aos ingredientes locais.', '⛵', 'historia');

-- Inserir cultura do Sudeste
INSERT INTO cultura_regiao (regiao_id, titulo, descricao, icon, tipo) VALUES
(2, 'Herança Portuguesa', 'A colonização portuguesa deixou marcas profundas na culinária sudestina, especialmente em Minas Gerais, com pratos como o feijão tropeiro e a linguiça.', '🇵🇹', 'influencia'),
(2, 'Imigração Italiana', 'A forte imigração italiana, principalmente em São Paulo, trouxe massas, pizzas e técnicas que se tornaram parte da identidade culinária da região.', '🇮🇹', 'influencia'),
(2, 'Cultura do Café', 'O Sudeste é o berço da cultura cafeeira no Brasil, influenciando não apenas a economia, mas também os hábitos alimentares e sociais da região.', '☕', 'historia');

-- Atualizar contadores
UPDATE regioes SET 
    total_receitas = (SELECT COUNT(*) FROM receitas WHERE regiao = slug),
    total_ingredientes = (SELECT COUNT(*) FROM ingredientes_regiao WHERE regiao_id = regioes.id);