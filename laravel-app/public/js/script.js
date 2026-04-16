// ══════════════════════════════════
// NAVBAR SCROLL EFFECT
// ══════════════════════════════════
const nav = document.getElementById('mainNav');
const hamburger = document.getElementById('hamburger');
const mobMenu = document.getElementById('mobMenu');

window.addEventListener('scroll', () => {
  if (window.scrollY > 50) {
    nav.classList.add('scrolled');
  } else {
    nav.classList.remove('scrolled');
  }
});

// ══════════════════════════════════
// MOBILE MENU TOGGLE
// ══════════════════════════════════
const mobMenuBackdrop = document.getElementById('mobMenuBackdrop');
const mobMenuClose   = document.getElementById('mobMenuClose');

function openMobMenu() {
  hamburger.classList.add('open');
  mobMenu.classList.add('open');
  if (mobMenuBackdrop) {
    mobMenuBackdrop.style.display = 'block';
    requestAnimationFrame(() => mobMenuBackdrop.classList.add('open'));
  }
  document.body.style.overflow = 'hidden';
}

function closeMobMenu() {
  hamburger.classList.remove('open');
  mobMenu.classList.remove('open');
  if (mobMenuBackdrop) {
    mobMenuBackdrop.classList.remove('open');
    setTimeout(() => { mobMenuBackdrop.style.display = 'none'; }, 350);
  }
  document.body.style.overflow = '';
}

if (hamburger) {
  hamburger.addEventListener('click', () => {
    mobMenu.classList.contains('open') ? closeMobMenu() : openMobMenu();
  });
}

// Close via X button
if (mobMenuClose) {
  mobMenuClose.addEventListener('click', closeMobMenu);
}

// Close via backdrop click
if (mobMenuBackdrop) {
  mobMenuBackdrop.addEventListener('click', closeMobMenu);
}

// Close via Escape key
document.addEventListener('keydown', (e) => {
  if (e.key === 'Escape' && mobMenu && mobMenu.classList.contains('open')) {
    closeMobMenu();
  }
});

// Close mobile menu when a nav link is clicked
if (mobMenu) {
  const mobLinks = mobMenu.querySelectorAll('a');
  mobLinks.forEach(link => {
    link.addEventListener('click', closeMobMenu);
  });
}

// ══════════════════════════════════
// SCROLL REVEAL ANIMATION
// ══════════════════════════════════
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

window.attachRevealAnimations = function(root = document) {
  const revealElements = root.querySelectorAll('.reveal, .reveal-left, .reveal-right');

  revealElements.forEach(el => {
    if (el.dataset.revealBound === 'true') {
      return;
    }

    el.dataset.revealBound = 'true';
    observer.observe(el);
  });
};

window.attachRevealAnimations();

// ══════════════════════════════════
// CURSOR GLOW EFFECT
// ══════════════════════════════════
const cursorGlow = document.getElementById('cursorGlow');

if (cursorGlow) {
  document.addEventListener('mousemove', (e) => {
    cursorGlow.style.left = e.clientX + 'px';
    cursorGlow.style.top = e.clientY + 'px';
  });
}

// ══════════════════════════════════
// SMOOTH SCROLL FOR ANCHOR LINKS
// ══════════════════════════════════
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    if (href !== '#') {
      e.preventDefault();
      const target = document.querySelector(href);
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    }
  });
});

// ══════════════════════════════════
// FORM VALIDATION & SUBMISSION
// ══════════════════════════════════
const contactForm = document.querySelector('form');

if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    // Let Laravel handle it naturally
  });
}

// ══════════════════════════════════
// ACTIVE NAV LINK HIGHLIGHTING
// ══════════════════════════════════
function updateActiveLink() {
  const navLinks = document.querySelectorAll('.nav-links a');
  navLinks.forEach(link => {
    link.classList.remove('active');
    const href = link.getAttribute('href');
    if (window.location.pathname === href || 
        window.location.pathname.includes(href.replace('/', ''))) {
      link.classList.add('active');
    }
  });
}

// Update on page load
updateActiveLink();

// ══════════════════════════════════
// BUTTON RIPPLE EFFECT
// ══════════════════════════════════
const buttons = document.querySelectorAll('.btn-primary, .btn-white, .btn-outline, .sub-btn');

buttons.forEach(button => {
  button.addEventListener('click', function(e) {
    const ripple = document.createElement('span');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;

    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    ripple.classList.add('ripple');

    this.appendChild(ripple);

    setTimeout(() => {
      ripple.remove();
    }, 600);
  });
});

// ══════════════════════════════════
// LAZY LOAD HANDLER
// ══════════════════════════════════
if ('IntersectionObserver' in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        img.src = img.dataset.src;
        img.classList.add('loaded');
        observer.unobserve(img);
      }
    });
  });

  document.querySelectorAll('img[data-src]').forEach(img => {
    imageObserver.observe(img);
  });
}

// ══════════════════════════════════
// HERO BANNER SLIDER
// ══════════════════════════════════
(function() {
  const slider = document.getElementById('bannerSlider');
  if (!slider) return;

  const slides = slider.querySelectorAll('.banner-slide');
  const dots   = slider.querySelectorAll('.banner-dot');
  const prev   = document.getElementById('bannerPrev');
  const next   = document.getElementById('bannerNext');
  if (slides.length < 2) return;

  let current = 0;
  let autoTimer;

  function goTo(index) {
    slides[current].classList.remove('is-active');
    if (dots[current]) dots[current].classList.remove('is-active');
    current = (index + slides.length) % slides.length;
    slides[current].classList.add('is-active');
    if (dots[current]) dots[current].classList.add('is-active');
  }

  function startAuto() {
    autoTimer = setInterval(function() { goTo(current + 1); }, 5000);
  }
  function resetAuto() {
    clearInterval(autoTimer);
    startAuto();
  }

  if (prev) prev.addEventListener('click', function() { goTo(current - 1); resetAuto(); });
  if (next) next.addEventListener('click', function() { goTo(current + 1); resetAuto(); });
  dots.forEach(function(dot) {
    dot.addEventListener('click', function() { goTo(parseInt(this.dataset.index)); resetAuto(); });
  });

  startAuto();
})();

console.log('Jiva Birth and Beyond website loaded successfully!');
