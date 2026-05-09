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

    $categoryId = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : 50;

    $sql = "SELECT p.id, p.name, p.price, p.old_price, p.rating, p.review_count, 
                   p.badge, p.image_url, c.name AS category_name
            FROM products p
            JOIN categories c ON p.category_id = c.id";

    $params = [];

    if ($categoryId) {
        $sql .= " WHERE p.category_id = ?";
        $params[] = $categoryId;
    }

    $sql .= " ORDER BY p.created_at DESC LIMIT ?";
    $params[] = $limit;

    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();

    // Format star rating string
    foreach ($products as &$product) {
        $full = floor($product['rating']);
        $half = ($product['rating'] - $full) >= 0.5 ? 1 : 0;
        $product['stars'] = str_repeat('★', $full) . ($half ? '½' : '');
    }

    echo json_encode($products);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}