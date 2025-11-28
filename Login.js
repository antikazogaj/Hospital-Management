// Login.js - JavaScript për Login.html

// Funksioni për validimin e formës
function validateForm(email, password) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Regex bazë për email
    let isValid = true;
    let errors = [];

    if (!email) {
        errors.push('Email or Username is required.');
        isValid = false;
    } else if (!emailRegex.test(email) && !email.includes('@')) {
        // Lejon username pa @, por kontrollon email-in
        if (!emailRegex.test(email)) {
            errors.push('Please enter a valid email.');
            isValid = false;
        }
    }

    if (!password) {
        errors.push('Password is required.');
        isValid = false;
    } else if (password.length < 6) {
        errors.push('Password must be at least 6 characters.');
        isValid = false;
    }

    return { isValid, errors };
}

// Funksioni për trajtimin e submit-it të formës
function handleFormSubmit(event) {
    event.preventDefault(); // Parandalon dërgimin e paracaktuar

    const form = event.target;
    const email = form.email.value.trim();
    const password = form.password.value.trim();
    const remember = form.remember.checked;

    // Validimi
    const validation = validateForm(email, password);
    if (!validation.isValid) {
        alert('Validation Errors:\n' + validation.errors.join('\n'));
        return;
    }

    // Simulim i login-it (në një aplikacion real, do të dërgohej në server)
    // Për shembull, kontrollo kundër të dhënave të simuluar
    const validCredentials = { email: 'admin@hospital.com', password: 'password123' };
    if (email === validCredentials.email && password === validCredentials.password) {
        alert('Login successful! Redirecting to dashboard...');
        // Ruaj në localStorage nëse "Remember me" është zgjedhur
        if (remember) {
            localStorage.setItem('loggedIn', 'true');
            localStorage.setItem('userEmail', email);
        }
        // Ridrejtim (p.sh., në Home.html ose dashboard)
        window.location.href = 'Home.html';
    } else {
        alert('Invalid email or password. Please try again.');
    }
}

// Funksioni për trajtimin e butonave të social login
function handleSocialLogin(platform) {
    // Simulim: Hap URL-të përkatëse (në realitet, do të integrohesh me API-të e tyre)
    const urls = {
        google: 'https://accounts.google.com/signin',
        facebook: 'https://www.facebook.com/login',
        twitter: 'https://twitter.com/login'
    };
    if (urls[platform]) {
        window.open(urls[platform], '_blank');
    } else {
        alert(`Social login for ${platform} is not implemented yet.`);
    }
}

// Funksioni për trajtimin e "Forgot Password?"
function handleForgotPassword() {
    // Mund të hapë një modal ose ridrejtojë
    const email = prompt('Enter your email to reset password:');
    if (email) {
        alert(`Password reset link sent to ${email}. (This is a simulation.)`);
    }
}

// Funksioni për trajtimin e "Create Account"
function handleCreateAccount() {
    window.location.href = 'Register.html'; 
}


// Inicializimi i event listeners kur dokumenti është gati
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const socialButtons = document.querySelectorAll('.social-login button');
    const forgotLink = document.querySelector('.forgot');
    const createLink = document.querySelector('.create a');

    // Event listener për form submit
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }

    // Event listeners për social login buttons
    socialButtons.forEach(button => {
        button.addEventListener('click', function() {
            const platform = this.className; // google, facebook, twitter
            handleSocialLogin(platform);
        });
    });

    // Event listener për "Forgot Password?"
    if (forgotLink) {
        forgotLink.addEventListener('click', function(event) {
            event.preventDefault();
            handleForgotPassword();
        });
    }

    // Event listener për "Create Account"
    if (createLink) {
        createLink.addEventListener('click', function(event) {
            event.preventDefault();
            handleCreateAccount();
        });
    }

    // Kontrollo nëse përdoruesi është i loguar (nga localStorage)
    if (localStorage.getItem('loggedIn') === 'true') {
        alert('You are already logged in. Redirecting...');
        window.location.href = 'Home.html';
    }
});
