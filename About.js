// About.js - JavaScript për About.html

// Funksioni për të shtuar event listeners për butonat e kontaktit
function initializeContactButtons() {
    // Merr të gjitha butonat me klasën "btn-team"
    const contactButtons = document.querySelectorAll('.btn-team');
    
    contactButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Gjeni kartën prind (team-card)
            const card = this.closest('.team-card');
            
            // Gjeni email-in brenda kartës
            const emailElement = card.querySelector('.desc:nth-of-type(2)'); // Email është i dyti .desc
            if (emailElement) {
                const emailText = emailElement.textContent.replace('Email: ', '').trim();
                
                // Hap email client me mailto
                window.location.href = `mailto:${emailText}`;
            } else {
                alert('Email nuk u gjet.');
            }
        });
    });
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

// Funksioni për animacion fade-in për team cards kur scroll
function fadeInOnScroll() {
    const cards = document.querySelectorAll('.team-card');
    
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

// Inicializimi i funksioneve kur dokumenti është gati
document.addEventListener('DOMContentLoaded', function() {
    initializeContactButtons();
    makeNavbarSticky();
    fadeInOnScroll();
});