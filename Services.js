// Services.js - JavaScript për Services.html

// Funksioni për të shtuar event listener për butonin "Book An Appointment"
function initializeCTAButton() {
    const ctaButton = document.querySelector('.cta-button');
    
    if (ctaButton) {
        ctaButton.addEventListener('click', function(event) {
            event.preventDefault(); // Parandalon ridrejtimin e paracaktuar
            
            // Mund të hapë një modal, alert, ose ridrejtojë në contact.html
            // Për thjeshtësi, hap një alert dhe ridrejton
            alert('Ju lutem na kontaktoni për të rezervuar një takim. Do të ridrejtoheni në faqen e kontaktit.');
            window.location.href = 'contact.html'; // Ridrejtim në contact.html
        });
    }
}

// Funksioni për të bërë navbar sticky kur scroll
function makeNavbarSticky() {
    const navbar = document.querySelector('.navbar');
    const stickyOffset = navbar.offsetTop;
    
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > stickyOffset) {
            navbar.classList.add('sticky');
        } else {
            navbar.classList.remove('sticky');
        }
    });
}

// Funksioni për animacion fade-in për service cards kur scroll
function fadeInOnScroll() {
    const cards = document.querySelectorAll('.service-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in');
            }
        });
    }, { threshold: 0.1 });
    
    cards.forEach(card => {
        observer.observe(card);
    });
}

// Funksioni për të shtuar hover effect për service cards (opsionale, për interaktivitet shtesë)
function addHoverEffects() {
    const cards = document.querySelectorAll('.service-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.05)';
            this.style.transition = 'transform 0.3s ease';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

// Inicializimi i funksioneve kur dokumenti është gati
document.addEventListener('DOMContentLoaded', function() {
    initializeCTAButton();
    makeNavbarSticky();
    fadeInOnScroll();
    addHoverEffects();
});