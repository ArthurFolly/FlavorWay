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
            tr.*,
            r.nome as regiao_nome
        FROM tecnicas_regiao tr
        JOIN regioes r ON tr.regiao_id = r.id
        WHERE r.slug = ? AND tr.ativo = 1
        ORDER BY tr.ordem ASC, tr.nome ASC
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regiao_slug]);
    
    $tecnicas = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $tecnica = [
            'id' => (int)$row['id'],
            'nome' => $row['nome'],
            'descricao' => $row['descricao'],
            'nivel' => $row['nivel'],
            'duracao' => $row['duracao'],
            'icon' => $row['icon'],
            'origem' => $row['origem'],
            'video_url' => $row['video_url'],
            'ordem' => (int)$row['ordem']
        ];
        $tecnicas[] = $tecnica;
    }
    
    echo json_encode($tecnicas);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar técnicas: ' . $e->getMessage()]);
}
?>