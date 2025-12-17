
// Funksioni per te shtuar event listeners per butonat e kontaktit
function initializeContactButtons() {
    // Merr te gjitha butonat me klasen "btn-team"
    const contactButtons = document.querySelectorAll('.btn-team');
    
    contactButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Gjeni karten prind (team-card)
            const card = this.closest('.team-card');
            
            // Gjeni email-in brenda kartes
            const emailElement = card.querySelector('.desc:nth-of-type(2)'); // Email eshte i dyti .desc
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

// Funksioni per animacione fade-in  dhe per team cards kur bejme  scroll
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

// Inicializimi i funksioneve kur dokumenti eshte gati
document.addEventListener('DOMContentLoaded', function() {
    initializeContactButtons();
    makeNavbarSticky();
    fadeInOnScroll();
});