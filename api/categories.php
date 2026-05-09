<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

require_once __DIR__ . '/../config/database.php';

try {
    $pdo = Database::getConnection();
    if (!$pdo) {
        http_response_code(500);
        echo json_encode(['error' => 'Database not initialized. Run setup.php first.']);
        exit;
    }

    $stmt = $pdo->query("SELECT id, name, emoji, sort_order FROM categories ORDER BY sort_order ASC");
    $categories = $stmt->fetchAll();

    echo json_encode($categories);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}