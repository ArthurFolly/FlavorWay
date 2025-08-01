-- Inserir dados específicos das regiões

-- Adicionar coluna estado na tabela receitas
ALTER TABLE receitas ADD COLUMN estado VARCHAR(50) AFTER regiao;

-- Atualizar receitas existentes com estados
UPDATE receitas SET estado = 'bahia' WHERE id = 2;
UPDATE receitas SET estado = 'bahia' WHERE id = 3;
UPDATE receitas SET estado = 'rio-de-janeiro' WHERE id = 1;
UPDATE receitas SET estado = 'rio-de-janeiro' WHERE id = 4;
UPDATE receitas SET estado = 'sao-paulo' WHERE id = 5;
UPDATE receitas SET estado = 'para' WHERE id = 6;

-- Inserir mais receitas do Nordeste
INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, estado, destaque, badge) VALUES
('Baião de Dois', 'Arroz com feijão de corda, carne de sol, queijo coalho e temperos do sertão.', '1h 30min', '6 pessoas', 4.6, 'Intermediário', 'nordeste', 'ceara', FALSE, NULL),
('Caldinho de Feijão', 'Caldo cremoso de feijão com camarão, bacon e temperos pernambucanos.', '1h 15min', '8 pessoas', 4.5, 'Básico', 'nordeste', 'pernambuco', FALSE, NULL),
('Arroz de Cuxá', 'Prato típico maranhense com arroz, vinagreira, camarão seco e gergelim.', '50 min', '4 pessoas', 4.4, 'Intermediário', 'nordeste', 'maranhao', FALSE, NULL),
('Tapioca Recheada', 'Massa de tapioca com recheios doces ou salgados, lanche típico do nordeste.', '20 min', '2 pessoas', 4.3, 'Básico', 'nordeste', 'ceara', FALSE, NULL),
('Bolo de Rolo', 'Doce pernambucano em camadas finas com recheio de goiabada.', '2h', '12 fatias', 4.7, 'Avançado', 'nordeste', 'pernambuco', FALSE, NULL),
('Cartola', 'Sobremesa pernambucana com banana, queijo coalho e canela.', '15 min', '4 pessoas', 4.4, 'Básico', 'nordeste', 'pernambuco', FALSE, NULL);

-- Inserir receitas do Sudeste
INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, estado, destaque, badge) VALUES
('Pão de Queijo', 'Quitanda mineira feita com polvilho, queijo minas e ovos. Perfeito para o café da manhã.', '45 min', '20 unidades', 4.8, 'Básico', 'sudeste', 'minas-gerais', FALSE, NULL),
('Feijão Tropeiro', 'Prato mineiro com feijão, farinha de mandioca, bacon, linguiça e couve refogada.', '1h 30min', '6 pessoas', 4.7, 'Intermediário', 'sudeste', 'minas-gerais', FALSE, NULL),
('Moqueca Capixaba', 'Moqueca do Espírito Santo feita com urucum, sem dendê, cozida em panela de barro.', '40 min', '4 pessoas', 4.6, 'Básico', 'sudeste', 'espirito-santo', FALSE, NULL),
('Virado à Paulista', 'Prato paulista com feijão, farinha de mandioca, couve, linguiça e ovo frito.', '1h 15min', '4 pessoas', 4.5, 'Intermediário', 'sudeste', 'sao-paulo', FALSE, NULL),
('Frango com Quiabo', 'Prato mineiro tradicional com frango caipira e quiabo refogado.', '1h 45min', '6 pessoas', 4.6, 'Intermediário', 'sudeste', 'minas-gerais', FALSE, NULL),
('Torta Capixaba', 'Torta salgada capixaba com frutos do mar, tradicionalmente consumida na Páscoa.', '2h 30min', '8 pessoas', 4.4, 'Avançado', 'sudeste', 'espirito-santo', FALSE, NULL);

-- Inserir receitas do Sul
INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, estado, destaque, badge) VALUES
('Churrasco Gaúcho', 'Carnes assadas na brasa ao estilo tradicional do Rio Grande do Sul.', '2h', '10 pessoas', 4.9, 'Intermediário', 'sul', 'rio-grande-do-sul', TRUE, 'Tradição Gaúcha'),
('Barreado', 'Prato típico paranaense cozido em panela de barro por horas.', '6h', '8 pessoas', 4.5, 'Avançado', 'sul', 'parana', FALSE, NULL),
('Polenta com Frango', 'Prato italiano adaptado no Sul, com polenta cremosa e frango caipira.', '1h 30min', '6 pessoas', 4.4, 'Intermediário', 'sul', 'santa-catarina', FALSE, NULL),
('Cuca Alemã', 'Bolo doce alemão com farofa doce por cima, tradição dos imigrantes.', '1h 15min', '12 fatias', 4.6, 'Básico', 'sul', 'rio-grande-do-sul', FALSE, NULL),
('Entrevero', 'Prato gaúcho com carne, arroz e temperos misturados.', '45 min', '4 pessoas', 4.3, 'Básico', 'sul', 'rio-grande-do-sul', FALSE, NULL);

-- Inserir receitas do Norte
INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, estado, destaque, badge) VALUES
('Tucumã com Açaí', 'Combinação amazônica tradicional de tucumã e açaí.', '15 min', '2 pessoas', 4.5, 'Básico', 'norte', 'amazonas', FALSE, NULL),
('Pirarucu de Casaca', 'Prato amazonense com pirarucu, banana e farofa.', '1h 30min', '6 pessoas', 4.7, 'Intermediário', 'norte', 'amazonas', FALSE, NULL),
('Tacacá', 'Sopa paraense com tucumã, camarão seco e jambu.', '45 min', '4 pessoas', 4.4, 'Intermediário', 'norte', 'para', FALSE, NULL),
('Pato no Tucumã', 'Prato típico amazonense com pato cozido no tucumã.', '2h', '6 pessoas', 4.6, 'Avançado', 'norte', 'amazonas', FALSE, NULL);

-- Inserir receitas do Centro-Oeste
INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, estado, destaque, badge) VALUES
('Pacu Assado', 'Peixe do pantanal assado com temperos regionais.', '1h 15min', '4 pessoas', 4.5, 'Básico', 'centro-oeste', 'mato-grosso', FALSE, NULL),
('Farofa de Banana', 'Farofa doce com banana, típica do Centro-Oeste.', '30 min', '6 pessoas', 4.2, 'Básico', 'centro-oeste', 'mato-grosso', FALSE, NULL),
('Pequi com Frango', 'Prato goiano com pequi e frango caipira.', '1h 45min', '6 pessoas', 4.6, 'Intermediário', 'centro-oeste', 'goias', FALSE, NULL),
('Mojica de Pintado', 'Prato pantaneiro com pintado e temperos locais.', '1h', '4 pessoas', 4.4, 'Intermediário', 'centro-oeste', 'mato-grosso-do-sul', FALSE, NULL);

-- Inserir mais tags
INSERT INTO tags (nome) VALUES
('Bahia'), ('Ceará'), ('Pernambuco'), ('Maranhão'), ('Paraíba'), ('Sergipe'),
('Minas Gerais'), ('São Paulo'), ('Rio de Janeiro'), ('Espírito Santo'),
('Rio Grande do Sul'), ('Paraná'), ('Santa Catarina'),
('Amazonas'), ('Pará'), ('Acre'), ('Rondônia'),
('Mato Grosso'), ('Goiás'), ('Mato Grosso do Sul'), ('Distrito Federal'),
('Carne de Sol'), ('Queijo Coalho'), ('Vinagreira'), ('Urucum'), ('Pequi'),
('Tucumã'), ('Jambu'), ('Pirarucu'), ('Pintado'), ('Polenta');

-- Relacionar novas receitas com tags
INSERT INTO receita_tags (receita_id, tag_id) VALUES
-- Baião de Dois
(7, (SELECT id FROM tags WHERE nome = 'Ceará')),
(7, (SELECT id FROM tags WHERE nome = 'Carne de Sol')),
(7, (SELECT id FROM tags WHERE nome = 'Tradicional')),

-- Caldinho de Feijão
(8, (SELECT id FROM tags WHERE nome = 'Pernambuco')),
(8, (SELECT id FROM tags WHERE nome = 'Feijão')),

-- Pão de Queijo
(11, (SELECT id FROM tags WHERE nome = 'Minas Gerais')),
(11, (SELECT id FROM tags WHERE nome = 'Queijo')),

-- Churrasco Gaúcho
((SELECT id FROM receitas WHERE nome = 'Churrasco Gaúcho'), (SELECT id FROM tags WHERE nome = 'Rio Grande do Sul')),
((SELECT id FROM receitas WHERE nome = 'Churrasco Gaúcho'), (SELECT id FROM tags WHERE nome = 'Carnes')),

-- Tucumã com Açaí
((SELECT id FROM receitas WHERE nome = 'Tucumã com Açaí'), (SELECT id FROM tags WHERE nome = 'Amazonas')),
((SELECT id FROM receitas WHERE nome = 'Tucumã com Açaí'), (SELECT id FROM tags WHERE nome = 'Açaí')),

-- Pacu Assado
((SELECT id FROM receitas WHERE nome = 'Pacu Assado'), (SELECT id FROM tags WHERE nome = 'Mato Grosso')),
((SELECT id FROM receitas WHERE nome = 'Pacu Assado'), (SELECT id FROM tags WHERE nome = 'Peixe'));