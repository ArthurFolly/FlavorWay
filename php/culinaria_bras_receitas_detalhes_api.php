<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
include('/FlavorWayV2/php/culinaria_bras_receitas_api.php');
include('/FlavorWayV2/php/config_database.php');
include('/FlavorWayV2/php/admin_add_receitas.php');
include('/FlavorWayV2/php/db_schema.sql');
include('culinariabrasileira.html');
require_once '../config/database.php';

if (!isset($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'ID da receita é obrigatório']);
    exit;
}

$receita_id = (int)$_GET['id'];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    
    // Buscar detalhes da receita
    $stmt = $pdo->prepare("
        SELECT * FROM receitas_detalhes 
        WHERE receita_id = ?
    ");
    $stmt->execute([$receita_id]);
    $detalhes = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$detalhes) {
        http_response_code(404);
        echo json_encode(['error' => 'Receita não encontrada']);
        exit;
    }
    
    // Buscar ingredientes
    $stmt = $pdo->prepare("
        SELECT i.item, i.quantidade, i.categoria
        FROM ingredientes i
        WHERE i.receita_id = ?
        ORDER BY i.categoria, i.ordem
    ");
    $stmt->execute([$receita_id]);
    $ingredientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Buscar passos do preparo
    $stmt = $pdo->prepare("
        SELECT p.passo, p.ordem
        FROM preparo p
        WHERE p.receita_id = ?
        ORDER BY p.ordem
    ");
    $stmt->execute([$receita_id]);
    $preparo = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Buscar dicas
    $stmt = $pdo->prepare("
        SELECT d.dica
        FROM dicas d
        WHERE d.receita_id = ?
        ORDER BY d.ordem
    ");
    $stmt->execute([$receita_id]);
    $dicas = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    // Montar resposta
    $response = [
        'tempo_preparo' => $detalhes['tempo_preparo'],
        'tempo_cozimento' => $detalhes['tempo_cozimento'],
        'rendimento' => $detalhes['rendimento'],
        'nutricao' => [
            'calorias' => $detalhes['calorias'],
            'proteinas' => $detalhes['proteinas'],
            'carboidratos' => $detalhes['carboidratos'],
            'gorduras' => $detalhes['gorduras']
        ],
        'ingredientes' => $ingredientes,
        'preparo' => $preparo,
        'dicas' => $dicas
    ];
    
    echo json_encode($response);
    
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao buscar detalhes da receita: ' . $e->getMessage()]);
}
?>