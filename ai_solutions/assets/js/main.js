// ============================================================
//  AI-Solutions — Main JavaScript
//  assets/js/main.js
// ============================================================

// ── Mobile hamburger menu ──────────────────────────────────
const hamburger = document.getElementById('hamburger');
const navLinks  = document.getElementById('nav-links');
if (hamburger) {
    hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
}


// ── Smooth scroll for anchor links ────────────────────────
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) { e.preventDefault(); target.scrollIntoView({ behavior: 'smooth' }); }
    });
});

// ── Contact form client-side validation ───────────────────
const contactForm = document.getElementById('contact-form');
if (contactForm) {
    contactForm.addEventListener('submit', function (e) {
        const fields = ['full_name','email','phone','company','country','job_title','job_details'];
        let valid = true;
        fields.forEach(id => {
            const el = document.getElementById(id);
            if (el && !el.value.trim()) {
                el.style.borderColor = '#dc2626';
                valid = false;
            } else if (el) {
                el.style.borderColor = '';
            }
        });
        // Basic email check
        const email = document.getElementById('email');
        if (email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
            email.style.borderColor = '#dc2626';
            valid = false;
        }
        if (!valid) {
            e.preventDefault();
            const alert = document.getElementById('form-alert');
            if (alert) {
                alert.className = 'alert alert-error';
                alert.textContent = 'Please fill in all fields correctly.';
                alert.style.display = 'block';
            }
        }
    });
}
