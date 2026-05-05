<?php

include_once 'Database.php';
include_once 'ContactClass.php';

// Kontrollojme nese forma u dorezua me POST
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Krijojme lidhjen me databazen
    $db = new Database();
    $connection = $db->getConnection();

    // Krijojme objektin ContactClass per te perdorur funksionet e tij
    $contact = new ContactClass($connection);

    // Marrim te dhenat nga forma
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Shtojmë mesazhin ne databaze dhe ruajme rezultatin
    $resultMessage = '';
    if($contact->addMessage($name, $email, $subject, $message)) {
        $resultMessage = "<div class='success-msg'>Your message was sent successfully. Thank you!</div>";
    } else {
        $resultMessage = "<div class='error-msg'>Error sending message! Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="Contact.css" />
</head>
<body>

<header class="navbar">
    <div class="logo">
        <img src="images/hospital-logo.jpg" alt="Hospital Logo" class="logo-img" />
        <div class="logo-text">
            <span>NovaHealth</span><br /><small>HOSPITAL</small>
        </div>
    </div>

    <nav>
        <a href="Home.php">Home</a>
        <a href="About.php">About</a>
        <a href="Services.php">Services</a>
        <a href="News.php">News</a>
        <a href="Contact.php" class="active">Contact</a>
        <a href="Login.php" class="btn-login">Login</a>
    </nav>
</header>

<main class="contact-section">
<div class="container">

    <!-- Kolona e majte: info kontakti -->
    <section class="contact-info">
        <h3>Contact us</h3>
        <ul class="info-list">
            <li class="info-item"><div class="meta"><strong>ADDRESS:</strong> 123 Hospital St, City, Country</div></li>
            <li class="info-item"><div class="meta"><strong>PHONE:</strong> 044-123-456</div></li>
            <li class="info-item"><div class="meta"><strong>EMAIL:</strong> info@hospital.com</div></li>
            <li class="info-item"><div class="meta"><strong>WEBSITE:</strong> NovaHealth-Hospital.com</div></li>
        </ul>
    </section>

    <!-- Kolona e djathte: forma e kontaktit -->
    <aside class="contact-card">
        <h3 class="card-title">Get in touch</h3>

        <!-- Forma POST per PHP -->
        <form action="Contact.php" method="POST">
            <div class="field">
                <input type="text" name="name" placeholder="Name" required>
            </div>
            <div class="field">
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="field">
                <input type="text" name="subject" placeholder="Subject" required>
            </div>
            <div class="field">
                <textarea name="message" placeholder="Message" required></textarea>
            </div>

            <!-- Butoni per dorezim -->
            <button type="submit" class="btn">Send Message</button>
        </form>

        <!-- Ketu shfaqet mesazhi i suksesit ose gabimit -->
        <?php
        if(isset($resultMessage)){
            echo $resultMessage;
        }
        ?>

    </aside>

</div>
</main>

</body>
</html>