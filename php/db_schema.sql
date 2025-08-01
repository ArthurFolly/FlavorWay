-- Criar banco de dados
CREATE DATABASE IF NOT EXISTS culinaria_brasileira CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE culinaria_brasileira;

-- Tabela de receitas principais
CREATE TABLE receitas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT NOT NULL,
    tempo VARCHAR(50) NOT NULL,
    pessoas VARCHAR(50) NOT NULL,
    rating DECIMAL(2,1) DEFAULT 0,
    dificuldade ENUM('Básico', 'Intermediário', 'Avançado') NOT NULL,
    regiao ENUM('nordeste', 'sudeste', 'sul', 'norte', 'centro-oeste') NOT NULL,
    destaque BOOLEAN DEFAULT FALSE,
    badge VARCHAR(100) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de detalhes das receitas
CREATE TABLE receitas_detalhes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receita_id INT NOT NULL,
    tempo_preparo VARCHAR(50),
    tempo_cozimento VARCHAR(50),
    rendimento VARCHAR(50),
    calorias VARCHAR(50),
    proteinas VARCHAR(50),
    carboidratos VARCHAR(50),
    gorduras VARCHAR(50),
    FOREIGN KEY (receita_id) REFERENCES receitas(id) ON DELETE CASCADE
);

-- Tabela de ingredientes
CREATE TABLE ingredientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receita_id INT NOT NULL,
    item VARCHAR(255) NOT NULL,
    quantidade VARCHAR(100) NOT NULL,
    categoria ENUM('base', 'carne', 'vegetal', 'tempero', 'fritura', 'recheio') NOT NULL,
    ordem INT DEFAULT 0,
    FOREIGN KEY (receita_id) REFERENCES receitas(id) ON DELETE CASCADE
);

-- Tabela de preparo (passos)
CREATE TABLE preparo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receita_id INT NOT NULL,
    passo TEXT NOT NULL,
    ordem INT NOT NULL,
    FOREIGN KEY (receita_id) REFERENCES receitas(id) ON DELETE CASCADE
);

-- Tabela de dicas
CREATE TABLE dicas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    receita_id INT NOT NULL,
    dica TEXT NOT NULL,
    ordem INT DEFAULT 0,
    FOREIGN KEY (receita_id) REFERENCES receitas(id) ON DELETE CASCADE
);

-- Tabela de tags
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

-- Tabela de relacionamento receita-tags
CREATE TABLE receita_tags (
    receita_id INT NOT NULL,
    tag_id INT NOT NULL,
    PRIMARY KEY (receita_id, tag_id),
    FOREIGN KEY (receita_id) REFERENCES receitas(id) ON DELETE CASCADE,
    FOREIGN KEY (tag_id) REFERENCES tags(id) ON DELETE CASCADE
);

-- Inserir dados de exemplo
INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, destaque, badge) VALUES
('Feijoada Completa', 'O prato mais tradicional do Brasil, com feijão preto, carnes defumadas e acompanhamentos clássicos.', '3h 30min', '8 pessoas', 4.9, 'Intermediário', 'sudeste', TRUE, 'Prato Nacional'),
('Acarajé Baiano', 'Bolinho de feijão fradinho frito no dendê, recheado com vatapá, caruru e camarão seco.', '2h 15min', '6 pessoas', 4.8, 'Avançado', 'nordeste', FALSE, NULL),
('Moqueca de Peixe', 'Peixe cozido no leite de coco com dendê, pimentões e coentro. Sabor do mar brasileiro.', '45 min', '4 pessoas', 4.7, 'Básico', 'nordeste', FALSE, NULL),
('Brigadeiro Gourmet', 'O doce mais amado do Brasil em versão sofisticada, com chocolate belga e coberturas especiais.', '30 min', '20 unidades', 4.9, 'Básico', 'sudeste', FALSE, NULL),
('Coxinha de Frango', 'Salgadinho brasileiro clássico com massa de batata, recheio de frango desfiado e temperos.', '1h 45min', '30 unidades', 4.8, 'Intermediário', 'sudeste', FALSE, NULL),
('Açaí Bowl Amazônico', 'Açaí puro da Amazônia servido com granola, frutas tropicais e mel de abelhas nativas.', '15 min', '2 pessoas', 4.6, 'Básico', 'norte', FALSE, NULL);

-- Inserir detalhes das receitas
INSERT INTO receitas_detalhes (receita_id, tempo_preparo, tempo_cozimento, rendimento, calorias, proteinas, carboidratos, gorduras) VALUES
(1, '30 min', '3h', '8 porções', '420 kcal por porção', '28g', '35g', '18g'),
(2, '45 min', '1h 30min', '6 unidades', '380 kcal por unidade', '15g', '25g', '25g'),
(3, '20 min', '25 min', '4 porções', '320 kcal por porção', '35g', '8g', '16g');

-- Inserir ingredientes da Feijoada
INSERT INTO ingredientes (receita_id, item, quantidade, categoria, ordem) VALUES
(1, 'Feijão preto', '500g', 'base', 1),
(1, 'Linguiça calabresa', '300g', 'carne', 2),
(1, 'Carne seca', '200g', 'carne', 3),
(1, 'Costela suína', '400g', 'carne', 4),
(1, 'Bacon', '150g', 'carne', 5),
(1, 'Cebola média', '2 unidades', 'tempero', 6),
(1, 'Alho', '6 dentes', 'tempero', 7),
(1, 'Folha de louro', '3 unidades', 'tempero', 8),
(1, 'Sal e pimenta', 'a gosto', 'tempero', 9),
(1, 'Óleo', '3 colheres de sopa', 'tempero', 10);

-- Inserir preparo da Feijoada
INSERT INTO preparo (receita_id, passo, ordem) VALUES
(1, 'Deixe o feijão de molho na véspera, por pelo menos 8 horas.', 1),
(1, 'Escorra e lave o feijão. Coloque em uma panela de pressão com água suficiente para cobrir.', 2),
(1, 'Cozinhe por 20 minutos após pegar pressão. Reserve.', 3),
(1, 'Em uma panela grande, refogue a cebola e o alho no óleo até dourar.', 4),
(1, 'Adicione as carnes cortadas em pedaços médios e refogue bem.', 5),
(1, 'Acrescente o feijão cozido com o caldo e as folhas de louro.', 6),
(1, 'Tempere com sal e pimenta. Deixe cozinhar em fogo baixo por 1 hora.', 7),
(1, 'Mexa ocasionalmente e adicione água quente se necessário.', 8),
(1, 'Sirva com arroz branco, couve refogada, farofa e laranja.', 9);

-- Inserir dicas da Feijoada
INSERT INTO dicas (receita_id, dica, ordem) VALUES
(1, 'O segredo está no refogado inicial das carnes', 1),
(1, 'Deixe cozinhar em fogo baixo para os sabores se integrarem', 2),
(1, 'A feijoada fica ainda melhor no dia seguinte', 3);

-- Inserir tags
INSERT INTO tags (nome) VALUES
('Tradicional'), ('Feijão'), ('Carnes'), ('Nordeste'), ('Dendê'), 
('Peixe'), ('Coco'), ('Doce'), ('Chocolate'), ('Salgado'), 
('Frango'), ('Saudável'), ('Açaí');

-- Relacionar receitas com tags
INSERT INTO receita_tags (receita_id, tag_id) VALUES
(1, 1), (1, 2), (1, 3),  -- Feijoada: Tradicional, Feijão, Carnes
(2, 4), (2, 5),          -- Acarajé: Nordeste, Dendê
(3, 6), (3, 7),          -- Moqueca: Peixe, Coco
(4, 8), (4, 9),          -- Brigadeiro: Doce, Chocolate
(5, 10), (5, 11),        -- Coxinha: Salgado, Frango
(6, 12), (6, 13);        -- Açaí: Saudável, Açaí