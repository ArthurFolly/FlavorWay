<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
include('culinaria_bras_receitas_detalhes_api.php');
include('config_database.php');
include('admin_add_receitas.php');
include('db_schema.sql');
include('culinariabrasileira.html');
require_once '../config/database.php';

try {
    $pdo = new PDO($dsn, $username, $password, $options);
    
    $stmt = $pdo->query("
        SELECT 
            r.*,
            GROUP_CONCAT(t.nome) as tags
        FROM receitas r
        LEFT JOIN receita_tags rt ON r.id = rt.receita_id
        LEFT JOIN tags t ON rt.tag_id = t.id
        GROUP BY r.id
        ORDER BY r.destaque DESC, r.rating DESC
    ");
    
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