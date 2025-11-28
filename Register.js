document.addEventListener("DOMContentLoaded", function () {
  const loginBox = document.getElementById("loginBox");
  const registerBox = document.getElementById("registerBox");
  const successMsg = document.getElementById("successMsg");

  // Shfaq register form kur klikohet "Create Account"
  document.getElementById("showRegister").addEventListener("click", function(e){
    e.preventDefault();
    loginBox.style.display = "none";
    registerBox.style.display = "block";
  });

  // Rikthe login nga register form
  document.getElementById("backToLogin").addEventListener("click", function(e){
    e.preventDefault();
    registerBox.style.display = "none";
    loginBox.style.display = "block";
    successMsg.textContent = "";
  });

  // Submit register form
  const registerForm = document.getElementById("registerForm");
  registerForm.addEventListener("submit", function(e){
    e.preventDefault();
    const fullname = registerForm.fullname.value.trim();
    const email = registerForm.email.value.trim();
    const password = registerForm.password.value.trim();
    const confirm = registerForm.confirm.value.trim();

    // Validimi
    if(!fullname || !email || !password){
      successMsg.style.color = "red";
      successMsg.textContent = "All fields are required!";
      return;
    }

    if(password.length < 6){
      successMsg.style.color = "red";
      successMsg.textContent = "Password must be at least 6 characters.";
      return;
    }

    if(password !== confirm){
      successMsg.style.color = "red";
      successMsg.textContent = "Passwords do not match.";
      return;
    }

    // Ruaj userin në localStorage
    const newUser = { fullname, email, password };
    localStorage.setItem("registeredUser", JSON.stringify(newUser));

    // Mesazh suksesi
    successMsg.style.color = "green";
    successMsg.textContent = "Account created successfully!";

    // Opsional: rikthe login pas disa sekondash
    setTimeout(() => {
      registerBox.style.display = "none";
      loginBox.style.display = "block";
      successMsg.textContent = "";
    }, 1500);
  });
});
