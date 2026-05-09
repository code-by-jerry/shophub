<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/auth.php';

$categories = [];
try {
    $pdo = Database::getConnection();
    $stmt = $pdo->query("SELECT id, name, emoji FROM categories ORDER BY sort_order ASC");
    $categories = $stmt->fetchAll();
} catch (Exception $e) {
    // DB not available — categories will be empty
}
?>
<!-- Announcement Bar -->
<div class="announcement-bar" role="status" aria-live="polite">
  <div class="announcement-slider">
    <span id="announcement-offer" class="announcement-text">Fast. Fresh. Delivered.</span>
  </div>
</div>

<!-- Navigation Bar -->
<nav class="navbar">
  <div class="nav-container">
    <!-- Logo -->
    <a href="index.php" class="logo-link">
      <svg class="logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
      </svg>
      <span class="logo-text">ShopHub</span>
    </a>

    <!-- Desktop Nav -->
    <div class="nav-menu">
      <a href="index.php" class="nav-link active">Home</a>
      <a href="#" class="nav-link">Shop</a>
      <?php if (isLoggedIn() && isAdmin()): ?>
      <a href="admin/dashboard.php" class="nav-link">Dashboard</a>
      <?php endif; ?>
      <div class="nav-dropdown">
        <button class="nav-link dropdown-toggle">Categories</button>
        <div class="dropdown-menu">
          <?php foreach ($categories as $cat): ?>
          <a href="#" class="dropdown-item"><?= htmlspecialchars($cat['emoji']) ?> <?= htmlspecialchars($cat['name']) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <a href="#" class="nav-link">About</a>
      <a href="#" class="nav-link">Contact</a>
    </div>

    <!-- Search -->
    <div class="nav-search">
      <div class="search-box">
        <input type="text" class="search-input" placeholder="Search products…">
        <button class="search-btn" aria-label="Search">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Actions -->
    <div class="nav-actions">
      <?php if (isLoggedIn()): ?>
      <button class="action-btn" aria-label="Account" title="<?= htmlspecialchars(currentUser()['name']) ?>">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
      </button>
      <a href="logout.php" class="action-btn" aria-label="Logout" style="text-decoration:none">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
        </svg>
      </a>
      <?php else: ?>
      <a href="login.php" class="nav-link" style="font-size:14px">Sign In</a>
      <?php endif; ?>
      <button class="action-btn" aria-label="Wishlist">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
        </svg>
      </button>
      <button class="action-btn cart-btn" aria-label="Cart">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.067 4.5M7 13l1.067 4.5M17 13l1.067 4.5M17 13l-1.067-4.5M7 13l1.067-4.5"></path>
        </svg>
        <span class="cart-count" id="cart-count">0</span>
      </button>
    </div>

    <!-- Mobile Toggle -->
    <button class="mobile-toggle" id="mobile-toggle" aria-label="Menu">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>
  </div>

  <!-- Mobile Menu -->
  <div class="mobile-menu" id="mobile-menu">
    <div class="mobile-menu-inner">
      <a href="index.php" class="mobile-link active">Home</a>
      <a href="#" class="mobile-link">Shop</a>
      <?php if (isLoggedIn() && isAdmin()): ?>
      <a href="admin/dashboard.php" class="mobile-link">Dashboard</a>
      <?php endif; ?>
      <div class="mobile-dropdown">
        <button class="mobile-dropdown-trigger">Categories</button>
        <div class="mobile-dropdown-menu">
          <?php foreach ($categories as $cat): ?>
          <a href="#" class="mobile-dropdown-item"><?= htmlspecialchars($cat['emoji']) ?> <?= htmlspecialchars($cat['name']) ?></a>
          <?php endforeach; ?>
        </div>
      </div>
      <a href="#" class="mobile-link">About</a>
      <a href="#" class="mobile-link">Contact</a>
      <?php if (isLoggedIn()): ?>
      <a href="logout.php" class="mobile-link" style="color:#f87171">Logout</a>
      <?php else: ?>
      <a href="login.php" class="mobile-link">Sign In</a>
      <a href="register.php" class="mobile-link">Register</a>
      <?php endif; ?>
      <div class="mobile-search-box">
        <input type="text" class="mobile-search-input" placeholder="Search products…">
        <button class="mobile-search-btn" aria-label="Search">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</nav>