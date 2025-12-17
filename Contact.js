 (function(){
      const form = document.getElementById('contactForm');
      const success = document.getElementById('successMsg');
      const sendBtn = document.getElementById('sendBtn');

      function validateEmail(email){
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
      }

      form.addEventListener('submit', function(e){
        e.preventDefault();
        success.style.display = 'none';

        const name = form.name.value.trim();
        const email = form.email.value.trim();
        const subject = form.subject.value.trim();
        const message = form.message.value.trim();

        if(!name || !email || !subject || !message){
          alert('Ju lutem plotësoni të gjitha fushat.');
          return;
        }
        if(!validateEmail(email)){
          alert('Vendosni një email të vlefshëm.');
          return;
        }

        // Simulimi i  dergimin
        sendBtn.disabled = true;
        sendBtn.textContent = 'Sending...';

        setTimeout(() => {
          sendBtn.disabled = false;
          sendBtn.textContent = 'Send Message';
          form.reset();
          success.style.display = 'block';
        }, 900); // simulimi i nje kerkese
      });
    })();