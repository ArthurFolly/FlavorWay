<?php
include('culinaria_bras_receitas_api.php');
include('culinaria_bras_receitas_detalhes_api.php');
include('config_database.php');
include('db_schema.sql');
include('culinariabrasileira.html');
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();
        
        // Inserir receita principal
        $stmt = $pdo->prepare("
            INSERT INTO receitas (nome, descricao, tempo, pessoas, rating, dificuldade, regiao, destaque, badge)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $_POST['nome'],
            $_POST['descricao'],
            $_POST['tempo'],
            $_POST['pessoas'],
            $_POST['rating'],
            $_POST['dificuldade'],
            $_POST['regiao'],
            isset($_POST['destaque']) ? 1 : 0,
            $_POST['badge'] ?: null
        ]);
        
        $receita_id = $pdo->lastInsertId();
        
        // Inserir detalhes
        if (!empty($_POST['tempo_preparo'])) {
            $stmt = $pdo->prepare("
                INSERT INTO receitas_detalhes (receita_id, tempo_preparo, tempo_cozimento, rendimento, calorias, proteinas, carboidratos, gorduras)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)
            ");
            
            $stmt->execute([
                $receita_id,
                $_POST['tempo_preparo'],
                $_POST['tempo_cozimento'],
                $_POST['rendimento'],
                $_POST['calorias'],
                $_POST['proteinas'],
                $_POST['carboidratos'],
                $_POST['gorduras']
            ]);
        }
        
        // Inserir ingredientes
        if (!empty($_POST['ingredientes'])) {
            $stmt = $pdo->prepare("
                INSERT INTO ingredientes (receita_id, item, quantidade, categoria, ordem)
                VALUES (?, ?, ?, ?, ?)
            ");
            
            foreach ($_POST['ingredientes'] as $index => $ingrediente) {
                $stmt->execute([
                    $receita_id,
                    $ingrediente['item'],
                    $ingrediente['quantidade'],
                    $ingrediente['categoria'],
                    $index + 1
                ]);
            }
        }
        
        // Inserir preparo
        if (!empty($_POST['preparo'])) {
            $stmt = $pdo->prepare("
                INSERT INTO preparo (receita_id, passo, ordem)
                VALUES (?, ?, ?)
            ");
            
            foreach ($_POST['preparo'] as $index => $passo) {
                $stmt->execute([
                    $receita_id,
                    $passo,
                    $index + 1
                ]);
            }
        }
        
        // Inserir dicas
        if (!empty($_POST['dicas'])) {
            $stmt = $pdo->prepare("
                INSERT INTO dicas (receita_id, dica, ordem)
                VALUES (?, ?, ?)
            ");
            
            foreach ($_POST['dicas'] as $index => $dica) {
                $stmt->execute([
                    $receita_id,
                    $dica,
                    $index + 1
                ]);
            }
        }
        
        // Inserir tags
        if (!empty($_POST['tags'])) {
            foreach ($_POST['tags'] as $tag_nome) {
                // Inserir tag se não existir
                $stmt = $pdo->prepare("INSERT IGNORE INTO tags (nome) VALUES (?)");
                $stmt->execute([$tag_nome]);
                
                // Buscar ID da tag
                $stmt = $pdo->prepare("SELECT id FROM tags WHERE nome = ?");
                $stmt->execute([$tag_nome]);
                $tag_id = $stmt->fetchColumn();
                
                // Relacionar receita com tag
                $stmt = $pdo->prepare("INSERT INTO receita_tags (receita_id, tag_id) VALUES (?, ?)");
                $stmt->execute([$receita_id, $tag_id]);
            }
        }
        
        $pdo->commit();
        $success = "Receita adicionada com sucesso!";
        
    } catch (Exception $e) {
        $pdo->rollback();
        $error = "Erro ao adicionar receita: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Receita - FlavorWay</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        .admin-container {
            max-width: 800px;
            margin: 100px auto 50px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #374151;
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 16px;
        }
        
        .form-group textarea {
            height: 100px;
            resize: vertical;
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .dynamic-list {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 15px;
            background: #f9fafb;
        }
        
        .dynamic-item {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
            align-items: center;
        }
        
        .dynamic-item input,
        .dynamic-item select {
            margin: 0;
        }
        
        .btn-remove {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 4px;
            cursor: pointer;
        }
        
        .btn-add {
            background: #16a34a;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .alert {
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #a7f3d0;
        }
        
        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h1>Adicionar Nova Receita</h1>
        
        <?php if (isset($success)): ?>
            <div class="alert alert-success"><?php echo $success; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome da Receita</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <textarea id="descricao" name="descricao" required></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="tempo">Tempo Total</label>
                    <input type="text" id="tempo" name="tempo" placeholder="Ex: 1h 30min" required>
                </div>
                
                <div class="form-group">
                    <label for="pessoas">Pessoas</label>
                    <input type="text" id="pessoas" name="pessoas" placeholder="Ex: 4 pessoas" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="rating">Avaliação</label>
                    <input type="number" id="rating" name="rating" min="0" max="5" step="0.1" value="4.5">
                </div>
                
                <div class="form-group">
                    <label for="dificuldade">Dificuldade</label>
                    <select id="dificuldade" name="dificuldade" required>
                        <option value="Básico">Básico</option>
                        <option value="Intermediário">Intermediário</option>
                        <option value="Avançado">Avançado</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="regiao">Região</label>
                    <select id="regiao" name="regiao" required>
                        <option value="nordeste">Nordeste</option>
                        <option value="sudeste">Sudeste</option>
                        <option value="sul">Sul</option>
                        <option value="norte">Norte</option>
                        <option value="centro-oeste">Centro-Oeste</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="badge">Badge (opcional)</label>
                    <input type="text" id="badge" name="badge" placeholder="Ex: Prato Nacional">
                </div>
            </div>
            
            <div class="form-group">
                <label>
                    <input type="checkbox" name="destaque"> Receita em destaque
                </label>
            </div>
            
            <h3>Detalhes da Receita</h3>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="tempo_preparo">Tempo de Preparo</label>
                    <input type="text" id="tempo_preparo" name="tempo_preparo" placeholder="Ex: 30 min">
                </div>
                
                <div class="form-group">
                    <label for="tempo_cozimento">Tempo de Cozimento</label>
                    <input type="text" id="tempo_cozimento" name="tempo_cozimento" placeholder="Ex: 1h">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="rendimento">Rendimento</label>
                    <input type="text" id="rendimento" name="rendimento" placeholder="Ex: 6 porções">
                </div>
                
                <div class="form-group">
                    <label for="calorias">Calorias</label>
                    <input type="text" id="calorias" name="calorias" placeholder="Ex: 350 kcal por porção">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="proteinas">Proteínas</label>
                    <input type="text" id="proteinas" name="proteinas" placeholder="Ex: 25g">
                </div>
                
                <div class="form-group">
                    <label for="carboidratos">Carboidratos</label>
                    <input type="text" id="carboidratos" name="carboidratos" placeholder="Ex: 30g">
                </div>
            </div>
            
            <div class="form-group">
                <label for="gorduras">Gorduras</label>
                <input type="text" id="gorduras" name="gorduras" placeholder="Ex: 15g">
            </div>
            
            <h3>Ingredientes</h3>
            <div class="dynamic-list" id="ingredientes-list">
                <div class="dynamic-item">
                    <input type="text" name="ingredientes[0][item]" placeholder="Ingrediente" required>
                    <input type="text" name="ingredientes[0][quantidade]" placeholder="Quantidade" required>
                    <select name="ingredientes[0][categoria]" required>
                        <option value="base">Base</option>
                        <option value="carne">Carne</option>
                        <option value="vegetal">Vegetal</option>
                        <option value="tempero">Tempero</option>
                        <option value="fritura">Fritura</option>
                        <option value="recheio">Recheio</option>
                    </select>
                    <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addIngrediente()">Adicionar Ingrediente</button>
            
            <h3>Modo de Preparo</h3>
            <div class="dynamic-list" id="preparo-list">
                <div class="dynamic-item">
                    <textarea name="preparo[0]" placeholder="Passo do preparo" required style="flex: 1;"></textarea>
                    <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addPreparo()">Adicionar Passo</button>
            
            <h3>Dicas do Chef</h3>
            <div class="dynamic-list" id="dicas-list">
                <div class="dynamic-item">
                    <input type="text" name="dicas[0]" placeholder="Dica" style="flex: 1;">
                    <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addDica()">Adicionar Dica</button>
            
            <h3>Tags</h3>
            <div class="dynamic-list" id="tags-list">
                <div class="dynamic-item">
                    <input type="text" name="tags[0]" placeholder="Tag" style="flex: 1;">
                    <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
                </div>
            </div>
            <button type="button" class="btn-add" onclick="addTag()">Adicionar Tag</button>
            
            <div style="margin-top: 30px;">
                <button type="submit" class="btn btn-primary">Salvar Receita</button>
                <a href="../index.html" class="btn btn-outline" style="margin-left: 10px;">Voltar</a>
            </div>
        </form>
    </div>
    
    <script>
        let ingredienteCount = 1;
        let preparoCount = 1;
        let dicaCount = 1;
        let tagCount = 1;
        
        function addIngrediente() {
            const list = document.getElementById('ingredientes-list');
            const div = document.createElement('div');
            div.className = 'dynamic-item';
            div.innerHTML = `
                <input type="text" name="ingredientes[${ingredienteCount}][item]" placeholder="Ingrediente" required>
                <input type="text" name="ingredientes[${ingredienteCount}][quantidade]" placeholder="Quantidade" required>
                <select name="ingredientes[${ingredienteCount}][categoria]" required>
                    <option value="base">Base</option>
                    <option value="carne">Carne</option>
                    <option value="vegetal">Vegetal</option>
                    <option value="tempero">Tempero</option>
                    <option value="fritura">Fritura</option>
                    <option value="recheio">Recheio</option>
                </select>
                <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
            `;
            list.appendChild(div);
            ingredienteCount++;
        }
        
        function addPreparo() {
            const list = document.getElementById('preparo-list');
            const div = document.createElement('div');
            div.className = 'dynamic-item';
            div.innerHTML = `
                <textarea name="preparo[${preparoCount}]" placeholder="Passo do preparo" required style="flex: 1;"></textarea>
                <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
            `;
            list.appendChild(div);
            preparoCount++;
        }
        
        function addDica() {
            const list = document.getElementById('dicas-list');
            const div = document.createElement('div');
            div.className = 'dynamic-item';
            div.innerHTML = `
                <input type="text" name="dicas[${dicaCount}]" placeholder="Dica" style="flex: 1;">
                <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
            `;
            list.appendChild(div);
            dicaCount++;
        }
        
        function addTag() {
            const list = document.getElementById('tags-list');
            const div = document.createElement('div');
            div.className = 'dynamic-item';
            div.innerHTML = `
                <input type="text" name="tags[${tagCount}]" placeholder="Tag" style="flex: 1;">
                <button type="button" class="btn-remove" onclick="removeItem(this)">Remover</button>
            `;
            list.appendChild(div);
            tagCount++;
        }
        
        function removeItem(button) {
            button.parentElement.remove();
        }
    </script>
</body>
</html>