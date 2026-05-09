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
});