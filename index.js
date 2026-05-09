const offers = [
  'Fast. Fresh. Delivered.',
  'Limited-time deal—don’t miss out!',
  'Upgrade your day with our best picks.',
  'New drops just landed—shop now!',
  'Free shipping today (while it lasts).'
];

function startAnnouncementRotation() {
  const el = document.getElementById('announcement-offer');
  if (!el) return;

  let currentOffer = 0;
  const intervalMs = 4000;

  // Ensure initial text matches the first offer.
  el.textContent = offers[currentOffer];

  setInterval(() => {
    currentOffer = (currentOffer + 1) % offers.length;
    el.textContent = offers[currentOffer];
  }, intervalMs);
}

// Mobile Menu Functionality
function initMobileMenu() {
  const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  const mobileDropdowns = document.querySelectorAll('.mobile-dropdown');

  // Toggle mobile menu
  if (mobileMenuToggle && mobileMenu) {
    mobileMenuToggle.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
      mobileMenuToggle.classList.toggle('active');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
      if (!mobileMenu.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
        mobileMenu.classList.remove('open');
        mobileMenuToggle.classList.remove('active');
      }
    });
  }

  // Mobile dropdown functionality
  mobileDropdowns.forEach(dropdown => {
    const toggle = dropdown.querySelector('.mobile-dropdown-toggle');
    if (toggle) {
      toggle.addEventListener('click', () => {
        dropdown.classList.toggle('open');
      });
    }
  });

  // Close mobile menu on window resize (for desktop view)
  window.addEventListener('resize', () => {
    if (window.innerWidth >= 768) {
      mobileMenu.classList.remove('open');
      mobileMenuToggle.classList.remove('active');
      mobileDropdowns.forEach(dropdown => dropdown.classList.remove('open'));
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  startAnnouncementRotation();
  initMobileMenu();
});

