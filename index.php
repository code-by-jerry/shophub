<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
  <title>ShopHub</title>
</head>
<body>
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
      <a href="#" class="logo-link">
        <svg class="logo-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
        </svg>
        <span class="logo-text">ShopHub</span>
      </a>

      <!-- Desktop Nav -->
      <div class="nav-menu">
        <a href="#" class="nav-link active">Home</a>
        <a href="#" class="nav-link">Shop</a>
        <div class="nav-dropdown">
          <button class="nav-link dropdown-toggle">Categories</button>
          <div class="dropdown-menu" id="dropdown-menu">
            <!-- Populated by JS from API -->
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
        <button class="action-btn" aria-label="Account">
          <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
          </svg>
        </button>
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
        <a href="#" class="mobile-link active">Home</a>
        <a href="#" class="mobile-link">Shop</a>
        <div class="mobile-dropdown">
          <button class="mobile-dropdown-trigger">Categories</button>
          <div class="mobile-dropdown-menu" id="mobile-dropdown-menu">
            <!-- Populated by JS from API -->
          </div>
        </div>
        <a href="#" class="mobile-link">About</a>
        <a href="#" class="mobile-link">Contact</a>
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

  <main>
    <!-- Hero Carousel -->
    <section class="hero" aria-label="Featured promotions">
      <div class="hero-slider" id="hero-slider">
        <div class="hero-slide active" data-index="0">
          <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1600&h=800&fit=crop" alt="" class="hero-bg" loading="lazy">
          <div class="hero-overlay"></div>
          <div class="hero-content">
            <span class="hero-badge">New Season</span>
            <h1 class="hero-title">Summer Collection</h1>
            <p class="hero-desc">Discover the latest trends with up to 40% off on select styles.</p>
            <a href="#" class="hero-cta">Shop Now →</a>
          </div>
        </div>
        <div class="hero-slide" data-index="1">
          <img src="https://images.unsplash.com/photo-1468495244123-6c6c332eeece?w=1600&h=800&fit=crop" alt="" class="hero-bg" loading="lazy">
          <div class="hero-overlay"></div>
          <div class="hero-content">
            <span class="hero-badge">Flash Sale</span>
            <h1 class="hero-title">Tech Deals</h1>
            <p class="hero-desc">Save big on headphones, smartwatches, and accessories.</p>
            <a href="#" class="hero-cta">Browse Deals →</a>
          </div>
        </div>
        <div class="hero-slide" data-index="2">
          <img src="https://images.unsplash.com/photo-1607082350899-7e105aa886ae?w=1600&h=800&fit=crop" alt="" class="hero-bg" loading="lazy">
          <div class="hero-overlay"></div>
          <div class="hero-content">
            <span class="hero-badge">Free Shipping</span>
            <h1 class="hero-title">Weekend Special</h1>
            <p class="hero-desc">Free delivery on all orders over $50. This weekend only!</p>
            <a href="#" class="hero-cta">Get Started →</a>
          </div>
        </div>
      </div>

      <button class="hero-arrow hero-arrow--prev" id="hero-prev" aria-label="Previous slide">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>
      <button class="hero-arrow hero-arrow--next" id="hero-next" aria-label="Next slide">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

      <div class="hero-dots" id="hero-dots">
        <button class="hero-dot active" data-index="0" aria-label="Slide 1"></button>
        <button class="hero-dot" data-index="1" aria-label="Slide 2"></button>
        <button class="hero-dot" data-index="2" aria-label="Slide 3"></button>
      </div>
    </section>

    <!-- Categories -->
    <section class="categories" aria-label="Shop by category">
      <div class="categories-track" id="categories-track">
        <!-- Populated by JS from API -->
      </div>
    </section>

    <!-- Promotion Banners -->
    <section class="promo-banners" aria-label="Promotions">
      <div class="promo-grid">
        <a href="#" class="promo-card">
          <img src="https://images.unsplash.com/photo-1550009158-fad5e52e4c1b?w=640&h=360&fit=crop" alt="" class="promo-bg" loading="lazy">
          <div class="promo-overlay"></div>
          <div class="promo-content">
            <span class="promo-tag">Up to 50% Off</span>
            <h2 class="promo-title">Electronics Sale</h2>
            <p class="promo-desc">Gadgets, headphones & more at unbeatable prices.</p>
            <span class="promo-link">Shop Electronics →</span>
          </div>
        </a>
        <a href="#" class="promo-card">
          <img src="https://images.unsplash.com/photo-1469334031218-e382a71b716b?w=640&h=360&fit=crop" alt="" class="promo-bg" loading="lazy">
          <div class="promo-overlay"></div>
          <div class="promo-content">
            <span class="promo-tag">New Arrivals</span>
            <h2 class="promo-title">Summer Fashion</h2>
            <p class="promo-desc">Fresh styles for the season. Light, bright & on-trend.</p>
            <span class="promo-link">Explore Fashion →</span>
          </div>
        </a>
      </div>
    </section>

    <!-- Products -->
    <section class="products" aria-label="Featured products">
      <div class="products-header">
        <h2 class="products-heading">Best Sellers</h2>
        <a href="#" class="products-view-all">View All →</a>
      </div>
      <div class="products-track" id="products-track">
        <!-- Populated by JS from API -->
      </div>
    </section>
  </main>

  <script src="index.js" defer></script>
</body>
</html>