/* ═══════════════════════════════════════
   API Fetch Helpers
   ═══════════════════════════════════════ */
const API_BASE = '/api';

async function fetchJSON(url) {
  const res = await fetch(url);
  if (!res.ok) throw new Error(`HTTP ${res.status}`);
  return res.json();
}

/* ═══════════════════════════════════════
   Load Categories from API
   ═══════════════════════════════════════ */
async function loadCategories() {
  try {
    const categories = await fetchJSON(`${API_BASE}/categories.php`);

    const track = document.getElementById('categories-track');
    const dropdown = document.getElementById('dropdown-menu');
    const mobileDropdown = document.getElementById('mobile-dropdown-menu');

    if (track) {
      track.innerHTML = categories.map(cat => `
        <a href="#" class="category-bubble">
          <div class="category-icon">${cat.emoji}</div>
          <span class="category-label">${cat.name}</span>
        </a>
      `).join('');
    }

    if (dropdown) {
      dropdown.innerHTML = categories.map(cat => `
        <a href="#" class="dropdown-item">${cat.emoji} ${cat.name}</a>
      `).join('');
    }

    if (mobileDropdown) {
      mobileDropdown.innerHTML = categories.map(cat => `
        <a href="#" class="mobile-dropdown-item">${cat.emoji} ${cat.name}</a>
      `).join('');
    }
  } catch (e) {
    console.warn('Failed to load categories:', e.message);
  }
}

/* ═══════════════════════════════════════
   Load Products from API
   ═══════════════════════════════════════ */
async function loadProducts() {
  try {
    const products = await fetchJSON(`${API_BASE}/products.php?limit=12`);

    const track = document.getElementById('products-track');
    if (!track) return;

    track.innerHTML = products.map(p => `
      <a href="#" class="product-card">
        <div class="product-image">
          <img src="${p.image_url || 'https://images.unsplash.com/photo-1505740420928-6e560c06d30e?w=300&h=300&fit=crop'}" alt="${p.name}" loading="lazy">
          ${p.badge ? `<span class="product-badge">${p.badge}</span>` : ''}
        </div>
        <div class="product-info">
          <span class="product-category">${p.category_name}</span>
          <h3 class="product-name">${p.name}</h3>
          <div class="product-rating">
            <span class="stars">${p.stars || '★★★★★'}</span>
            <span class="rating-count">(${p.review_count})</span>
          </div>
          <div class="product-price">
            <span class="price-current">$${parseFloat(p.price).toFixed(2)}</span>
            ${p.old_price ? `<span class="price-old">$${parseFloat(p.old_price).toFixed(2)}</span>` : ''}
          </div>
        </div>
      </a>
    `).join('');
  } catch (e) {
    console.warn('Failed to load products:', e.message);
  }
}

/* ═══════════════════════════════════════
   Announcement Bar — Rotating Offers
   ═══════════════════════════════════════ */
const offers = [
  'Fast. Fresh. Delivered.',
  'Limited-time deal — don\'t miss out!',
  'Upgrade your day with our best picks.',
  'New drops just landed — shop now!',
  'Free shipping today (while it lasts).'
];

function startAnnouncementRotation() {
  const el = document.getElementById('announcement-offer');
  if (!el) return;

  let currentOffer = 0;
  const intervalMs = 4000;

  el.textContent = offers[currentOffer];

  setInterval(() => {
    el.classList.add('fade-out');
    setTimeout(() => {
      currentOffer = (currentOffer + 1) % offers.length;
      el.textContent = offers[currentOffer];
      el.classList.remove('fade-out');
    }, 400);
  }, intervalMs);
}

/* ═══════════════════════════════════════
   Mobile Menu
   ═══════════════════════════════════════ */
function initMobileMenu() {
  const toggle = document.getElementById('mobile-toggle');
  const menu = document.getElementById('mobile-menu');
  const dropdowns = document.querySelectorAll('.mobile-dropdown');

  if (!toggle || !menu) return;

  toggle.addEventListener('click', () => {
    menu.classList.toggle('open');
    toggle.classList.toggle('active');
  });

  document.addEventListener('click', (e) => {
    if (!menu.contains(e.target) && !toggle.contains(e.target)) {
      menu.classList.remove('open');
      toggle.classList.remove('active');
    }
  });

  dropdowns.forEach(dropdown => {
    const trigger = dropdown.querySelector('.mobile-dropdown-trigger');
    if (trigger) {
      trigger.addEventListener('click', () => {
        dropdown.classList.toggle('open');
      });
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
      menu.classList.remove('open');
      toggle.classList.remove('active');
      dropdowns.forEach(d => d.classList.remove('open'));
    }
  });
}

/* ═══════════════════════════════════════
   Hero Carousel
   ═══════════════════════════════════════ */
function initHeroCarousel() {
  const slider = document.getElementById('hero-slider');
  const prevBtn = document.getElementById('hero-prev');
  const nextBtn = document.getElementById('hero-next');
  const dots = document.querySelectorAll('.hero-dot');
  if (!slider) return;

  const slides = slider.querySelectorAll('.hero-slide');
  let current = 0;
  const total = slides.length;

  function goTo(index) {
    slides.forEach(s => s.classList.remove('active'));
    dots.forEach(d => d.classList.remove('active'));
    current = (index + total) % total;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
  }

  function next() { goTo(current + 1); }
  function prev() { goTo(current - 1); }

  if (nextBtn) nextBtn.addEventListener('click', next);
  if (prevBtn) prevBtn.addEventListener('click', prev);

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      goTo(parseInt(dot.dataset.index, 10));
    });
  });

  let interval = setInterval(next, 5000);
  slider.addEventListener('mouseenter', () => clearInterval(interval));
  slider.addEventListener('mouseleave', () => {
    interval = setInterval(next, 5000);
  });
}

document.addEventListener('DOMContentLoaded', () => {
  startAnnouncementRotation();
  initMobileMenu();
  initHeroCarousel();
  loadCategories();
  loadProducts();
});