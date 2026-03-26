<?php
include_once 'Database.php';
include_once 'ContactClass.php';

//Fillojme me variablat superglobale
if($_SERVER['REQUEST_METHOD'] == 'POST') {  //kontrollon qe kodi te ekzekutohet vetem kur perdoruesi shtyp butonin Send Message

   $db = new Database();  //krijojme nje instance te klases Database per me kriju lidhjen me databazen
   $connection = $db->getConnection();  //marrim lidhjen me databazen qe eshte kriju nga objekti db
   $contact = new Contact(db: $connection);  //krijojme nje instance te klases ContactClass dhe ia japim lidhjen me databazen

   //Marrim te dhenat nga forma e kontaktit me ane te metodes POST dhe i ruajme ne variabla
   $name = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject'];
   $message = $_POST['message'];

   //Thirrim funksionin addMessage qe e ruan mesazhin ne databaze
   if($contact->addMessage(name: $name, email: $email, subject: $subject, message: $message)) { ////nese mesazhi ruhet me sukses
   echo "Message sent successfully!";
   } else {
    echo "Error sending message!";
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

<!-- Info kontakt -->
<section class="contact-info">
    <h3>Contact us</h3>

    <ul class="info-list">

        <li class="info-item">
            <div class="meta">
                <strong>ADDRESS:</strong>
                123 Hospital St, City, Country
            </div>
        </li>

        <li class="info-item">
            <div class="meta">
                <strong>PHONE:</strong>
                044-123-456
            </div>
        </li>

        <li class="info-item">
            <div class="meta">
                <strong>EMAIL:</strong>
                info@hospital.com
            </div>
        </li>

        <li class="info-item">
            <div class="meta">
                <strong>WEBSITE:</strong>
                NovaHealth-Hospital.com
            </div>
        </li>

    </ul>
</section>

<!-- Forma -->
<aside class="contact-card">
    <h3 class="card-title">Get in touch</h3>

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

        <button type="submit" class="btn">Send Message</button>

    </form>

</aside>

</div>
</main>

</body>
</html>