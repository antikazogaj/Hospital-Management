
// Funksioni per validimin e formes
function validateForm(email, password) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
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

// Funksioni per trajtimin e submit-it te formes
function handleFormSubmit(event) {
    event.preventDefault(); // Parandalon dergimin e paracaktuar

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

    // Simulim i login-it 
    // Per shembull, kontrollo kunder te dhenave te simuluara
    const validCredentials = { email: 'admin@hospital.com', password: 'password123' };
    if (email === validCredentials.email && password === validCredentials.password) {
        alert('Login successful! Redirecting to dashboard...');
        // Ruaj ne localStorage nese "Remember me" eshte zgjedhur
        if (remember) {
            localStorage.setItem('loggedIn', 'true');
            localStorage.setItem('userEmail', email);
        }
        // Ridrejtim (p.sh ne Home.html ose dashboard)
        window.location.href = 'Home.html';
    } else {
        alert('Invalid email or password. Please try again.');
    }
}

// Funksioni per trajtimin e butonave te social login
function handleSocialLogin(platform) {
    // Simulim: Hap URL-te perkatese 
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

// Funksioni per trajtimin e "Forgot Password?"
function handleForgotPassword() {
    // Mund te ridrejtojë
    const email = prompt('Enter your email to reset password:');
    if (email) {
        alert(`Password reset link sent to ${email}. (This is a simulation.)`);
    }
}

// Funksioni per trajtimin e "Create Account"
function handleCreateAccount() {
    window.location.href = 'Register.html'; 
}


// Inicializimi i event listeners kur dokumenti eshte gati
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const socialButtons = document.querySelectorAll('.social-login button');
    const forgotLink = document.querySelector('.forgot');
    const createLink = document.querySelector('.create a');

    // Event listener per form submit
    if (form) {
        form.addEventListener('submit', handleFormSubmit);
    }

    // Event listeners per social login buttons
    socialButtons.forEach(button => {
        button.addEventListener('click', function() {
            const platform = this.className; // google, facebook, twitter
            handleSocialLogin(platform);
        });
    });

    // Event listener per "Forgot Password?"
    if (forgotLink) {
        forgotLink.addEventListener('click', function(event) {
            event.preventDefault();
            handleForgotPassword();
        });
    }

    // Event listener per "Create Account"
    if (createLink) {
        createLink.addEventListener('click', function(event) {
            event.preventDefault();
            handleCreateAccount();
        });
    }

    // Kontrollo nese perdoruesi eshte i loguar
    if (localStorage.getItem('loggedIn') === 'true') {
        alert('You are already logged in. Redirecting...');
        window.location.href = 'Home.html';
    }
});
