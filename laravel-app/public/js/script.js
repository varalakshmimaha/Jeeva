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
if (hamburger) {
  hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobMenu.classList.toggle('open');
  });
}

// Close mobile menu when a link is clicked
if (mobMenu) {
  const mobLinks = mobMenu.querySelectorAll('a');
  mobLinks.forEach(link => {
    link.addEventListener('click', () => {
      hamburger.classList.remove('open');
      mobMenu.classList.remove('open');
    });
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

console.log('✨ Western Dental website loaded successfully!');
