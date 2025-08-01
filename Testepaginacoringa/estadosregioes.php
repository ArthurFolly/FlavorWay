<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

if (!isset($_GET['regiao'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Região é obrigatória']);
    exit;
}

$regiao_slug = $_GET['regiao'];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    
    $sql = "
        SELECT 
            er.*,
            r.nome as regiao_nome
        FROM estados_regiao er
        JOIN regioes r ON er.regiao_id = r.id
        WHERE r.slug = ? AND er.ativo = 1
        ORDER BY er.ordem ASC, er.nome ASC
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regiao_slug]);
    
    $estados = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // Contar receitas do estado
        $countStmt = $pdo->prepare("SELECT COUNT(*) FROM receitas WHERE estado_slug = ?");
        $countStmt->execute([$row['slug']]);
        $totalReceitas = $countStmt->fetchColumn();
        
        $estado = [
            'id' => (int)$row['id'],
            'nome' => $row['nome'],
            'slug' => $row['slug'],
            'capital' => $row['capital'],
            'descricao' => $row['descricao'],
            'total_receitas' => (int)$totalReceitas,
            'ingrediente_destaque' => $row['ingrediente_destaque'],
            'especialidades' => $row['especialidades'] ? json_decode($row['especialidades'], true) : [],
            'ordem' => (int)$row['ordem']
        ];
        $estados[] = $estado;
    }
    
    echo json_encode($estados);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar estados: ' . $e->getMessage()]);
}
?>