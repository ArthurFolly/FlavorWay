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
            ir.*,
            r.nome as regiao_nome
        FROM ingredientes_regiao ir
        JOIN regioes r ON ir.regiao_id = r.id
        WHERE r.slug = ? AND ir.ativo = 1
        ORDER BY ir.ordem ASC, ir.nome ASC
    ";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$regiao_slug]);
    
    $ingredientes = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $ingrediente = [
            'id' => (int)$row['id'],
            'nome' => $row['nome'],
            'subtitulo' => $row['subtitulo'],
            'descricao' => $row['descricao'],
            'origem' => $row['origem'],
            'usos' => $row['usos'] ? json_decode($row['usos'], true) : [],
            'estados' => $row['estados'] ? json_decode($row['estados'], true) : [],
            'imagem' => $row['imagem'],
            'ordem' => (int)$row['ordem']
        ];
        $ingredientes[] = $ingrediente;
    }
    
    echo json_encode($ingredientes);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar ingredientes: ' . $e->getMessage()]);
}
?>