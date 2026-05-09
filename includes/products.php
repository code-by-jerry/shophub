<?php
require_once __DIR__ . '/../config/database.php';

$products = [];
try {
    $pdo = Database::getConnection();
    $limit = isset($limit) ? (int)$limit : 8;
    $stmt = $pdo->prepare(
        "SELECT p.id, p.name, p.price, p.old_price, p.rating, p.review_count,
                p.badge, p.image_url, c.name AS category_name
         FROM products p
         JOIN categories c ON p.category_id = c.id
         ORDER BY p.created_at DESC
         LIMIT ?"
    );
    $stmt->execute([$limit]);
    $products = $stmt->fetchAll();
} catch (Exception $e) {
    // DB not available
}

function renderStars(float $rating): string {
    $full = floor($rating);
    $half = ($rating - $full) >= 0.5 ? 1 : 0;
    return str_repeat('★', $full) . ($half ? '½' : '');
}
?>
<section class="products" aria-label="Featured products">
  <div class="products-header">
    <h2 class="products-heading">Best Sellers</h2>
    <a href="#" class="products-view-all">View All →</a>
  </div>
  <div class="products-track">
    <?php if (empty($products)): ?>
    <p style="color: var(--color-text-muted); padding: 40px 0; text-align: center; width: 100%;">
      No products yet. Run <code>php setup.php</code> to seed the database.
    </p>
    <?php else: ?>
      <?php foreach ($products as $p): ?>
      <a href="#" class="product-card">
        <div class="product-image">
          <img src="<?= htmlspecialchars($p['image_url'] ?? 'https://images.unsplash.com/photo-1505740420928-6e560c06d30e?w=300&h=300&fit=crop') ?>" alt="<?= htmlspecialchars($p['name']) ?>" loading="lazy">
          <?php if ($p['badge']): ?>
          <span class="product-badge"><?= htmlspecialchars($p['badge']) ?></span>
          <?php endif; ?>
        </div>
        <div class="product-info">
          <span class="product-category"><?= htmlspecialchars($p['category_name']) ?></span>
          <h3 class="product-name"><?= htmlspecialchars($p['name']) ?></h3>
          <div class="product-rating">
            <span class="stars"><?= renderStars((float)$p['rating']) ?></span>
            <span class="rating-count">(<?= (int)$p['review_count'] ?>)</span>
          </div>
          <div class="product-price">
            <span class="price-current">$<?= number_format((float)$p['price'], 2) ?></span>
            <?php if ($p['old_price']): ?>
            <span class="price-old">$<?= number_format((float)$p['old_price'], 2) ?></span>
            <?php endif; ?>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</section>