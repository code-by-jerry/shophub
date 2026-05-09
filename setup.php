<?php
require_once __DIR__ . '/config/database.php';

header('Content-Type: text/plain; charset=utf-8');

echo "Setting up ShopHub database...\n\n";

try {
    $pdo = Database::setupDatabase();
    echo "✓ Database 'shophub' created (if not existed)\n";
    echo "✓ Tables 'users', 'categories' and 'products' created (if not existed)\n\n";

    // Check if data already exists
    $count = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
    if ($count > 0) {
        echo "Data already exists ($count categories). Skipping seed.\n";
        exit;
    }

    // Seed users
    $users = [
        ['Admin', 'admin@shophub.com', 'admin123', 'admin'],
        ['Customer', 'customer@shophub.com', 'customer123', 'customer'],
    ];

    $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    foreach ($users as $u) {
        $stmt->execute([$u[0], $u[1], password_hash($u[2], PASSWORD_BCRYPT), $u[3]]);
    }
    echo "✓ Seeded " . count($users) . " users (admin + customer)\n";

    // Seed categories
    $categories = [
        ['Electronics', '📱', 1],
        ['Fashion', '👗', 2],
        ['Home', '🏠', 3],
        ['Sports', '⚽', 4],
        ['Books', '📚', 5],
        ['Gaming', '🎮', 6],
        ['Beauty', '💄', 7],
        ['Auto', '🚗', 8],
        ['Music', '🎵', 9],
        ['Accessories', '⌚', 10],
        ['Laptops', '💻', 11],
        ['Cameras', '📷', 12],
        ['Garden', '🪴', 13],
        ['Pets', '🐾', 14],
        ['Kitchen', '🍳', 15],
        ['Toys', '🧸', 16],
        ['Jewelry', '💎', 17],
        ['Furniture', '🛏️', 18],
        ['Office', '⌨️', 19],
        ['Travel', '🧳', 20],
    ];

    $stmt = $pdo->prepare("INSERT INTO categories (name, emoji, sort_order) VALUES (?, ?, ?)");
    foreach ($categories as $cat) {
        $stmt->execute($cat);
    }
    echo "✓ Seeded " . count($categories) . " categories\n";

    // Seed products
    $products = [
        ['Wireless Headphones Pro', 1, 79.99, 129.99, 5.0, 128, 'Best Seller', 'https://images.unsplash.com/photo-1505740420928-6e560c06d30e?w=300&h=300&fit=crop'],
        ['Slim Fit Cotton Tee', 2, 24.99, 35.99, 4.0, 84, '-30%', 'https://images.unsplash.com/photo-1576566588028-4147f3842f27?w=300&h=300&fit=crop'],
        ['Smart LED Desk Lamp', 3, 49.99, null, 5.0, 215, 'New', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=300&fit=crop'],
        ['Leather Watch Classic', 10, 149.99, 199.99, 4.0, 56, 'Sale', 'https://images.unsplash.com/photo-1524592094714-0f0654e20314?w=300&h=300&fit=crop'],
        ['Natural Skincare Set', 7, 39.99, 54.99, 5.0, 342, 'Best Seller', 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?w=300&h=300&fit=crop'],
        ['Running Shoes Ultra', 4, 89.99, 149.99, 4.0, 93, '-40%', 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=300&h=300&fit=crop'],
        ['Mechanical Keyboard RGB', 6, 69.99, 89.99, 5.0, 167, 'New', 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=300&h=300&fit=crop'],
        ['Weekender Duffle Bag', 20, 59.99, 79.99, 4.0, 74, 'Sale', 'https://images.unsplash.com/photo-1553062407-98eeb64c6a62?w=300&h=300&fit=crop'],
    ];

    $stmt = $pdo->prepare("INSERT INTO products (name, category_id, price, old_price, rating, review_count, badge, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    foreach ($products as $p) {
        $stmt->execute($p);
    }
    echo "✓ Seeded " . count($products) . " products\n\n";
    echo "All done! You can now open http://localhost:8000\n";

} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    exit(1);
}