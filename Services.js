// Funksioni për të shtuar event listener per butonin "Book An Appointment"
function initializeCTAButton() {
    const ctaButton = document.querySelector('.cta-button');
    
    if (ctaButton) {
        ctaButton.addEventListener('click', function(event) {
            event.preventDefault(); // Parandalon ridrejtimin e paracaktuar
            
            // Mund te ridrejtoje ne contact.html
            // Per thjeshtesi, hap nje alert dhe ridrejton
            alert('Ju lutem na kontaktoni për të rezervuar një takim. Do të ridrejtoheni në faqen e kontaktit.');
            window.location.href = 'contact.html'; // Ridrejtim në contact.html
        });
    }
}

// Funksioni per te bere navbar sticky kur scroll
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

// Funksioni per animacion fade-in per service cards kur scroll
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

// Funksioni per te shtuar hover effect per service cards
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

// Inicializimi i funksioneve kur dokumenti eshte gati
document.addEventListener('DOMContentLoaded', function() {
    initializeCTAButton();
    makeNavbarSticky();
    fadeInOnScroll();
    addHoverEffects();
});