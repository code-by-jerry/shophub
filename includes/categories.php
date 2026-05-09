<?php
require_once __DIR__ . '/../config/database.php';

$categories = [];
try {
    $pdo = Database::getConnection();
    $stmt = $pdo->query("SELECT name, emoji FROM categories ORDER BY sort_order ASC");
    $categories = $stmt->fetchAll();
} catch (Exception $e) {
    // DB not available
}
?>
<section class="categories" aria-label="Shop by category">
  <div class="categories-track">
    <?php foreach ($categories as $cat): ?>
    <a href="#" class="category-bubble">
      <div class="category-icon"><?= htmlspecialchars($cat['emoji']) ?></div>
      <span class="category-label"><?= htmlspecialchars($cat['name']) ?></span>
    </a>
    <?php endforeach; ?>
  </div>
</section>