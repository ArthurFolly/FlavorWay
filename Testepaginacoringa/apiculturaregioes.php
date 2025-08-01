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
            cr.*,
            r.nome as regiao_nome
        FROM cultura_regiao cr
        JOIN regioes r ON cr.regiao_id = r.id
        WHERE r.slug = ? AND cr.ativo = 1
        ORDER BY cr.ordem ASC, cr.titulo ASC
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regiao_slug]);
    
    $cultura = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $item = [
            'id' => (int)$row['id'],
            'titulo' => $row['titulo'],
            'descricao' => $row['descricao'],
            'icon' => $row['icon'],
            'tipo' => $row['tipo'],
            'ordem' => (int)$row['ordem']
        ];
        $cultura[] = $item;
    }
    
    echo json_encode($cultura);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar informações culturais: ' . $e->getMessage()]);
}
?>