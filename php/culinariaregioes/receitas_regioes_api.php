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

$regiao = $_GET['regiao'];
$estado = isset($_GET['estado']) ? $_GET['estado'] : null;

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    
    $sql = "
        SELECT 
            r.*,
            GROUP_CONCAT(t.nome) as tags
        FROM receitas r
        LEFT JOIN receita_tags rt ON r.id = rt.receita_id
        LEFT JOIN tags t ON rt.tag_id = t.id
        WHERE r.regiao = ?
    ";
    
    $params = [$regiao];
    
    if ($estado) {
        $sql .= " AND r.estado = ?";
        $params[] = $estado;
    }
    
    $sql .= " GROUP BY r.id ORDER BY r.destaque DESC, r.rating DESC";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    
    $receitas = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $receita = [
            'id' => (int)$row['id'],
            'nome' => $row['nome'],
            'descricao' => $row['descricao'],
            'tempo' => $row['tempo'],
            'pessoas' => $row['pessoas'],
            'rating' => (float)$row['rating'],
            'dificuldade' => $row['dificuldade'],
            'regiao' => $row['regiao'],
            'estado' => $row['estado'],
            'destaque' => (bool)$row['destaque'],
            'badge' => $row['badge'],
            'tags' => $row['tags'] ? explode(',', $row['tags']) : []
        ];
        $receitas[] = $receita;
    }
    
    echo json_encode($receitas);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar receitas: ' . $e->getMessage()]);
}
?>