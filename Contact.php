<?php
require_once "config/Database.php";
require_once "classes/Contact.php";

$success = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $database = new Database();
    $db = $database->connect();

    $contact = new Contact($db);

    $contact->name = htmlspecialchars(trim($_POST['name']));
    $contact->email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $contact->subject = htmlspecialchars(trim($_POST['subject']));
    $contact->message = htmlspecialchars(trim($_POST['message']));

    if ($contact->email && $contact->create()) {
        $success = true;
    } else {
        $error = true;
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

<script src="Contact.js"></script>

<main class="contact-section">
    <div class="container">

        <!-- Contact info -->
        <section class="contact-info">
            <h3>Contact us</h3>
            <ul class="info-list">
                <li class="info-item"><strong>ADDRESS:</strong> 123 Hospital St</li>
                <li class="info-item"><strong>PHONE:</strong> 044-123-456</li>
                <li class="info-item"><strong>EMAIL:</strong> info@hospital.com</li>
                <li class="info-item"><strong>WEBSITE:</strong> NovaHealth-Hospital.com</li>
            </ul>
        </section>

        <!-- Contact form -->
        <aside class="contact-card">
            <h3 class="card-title">Get in touch</h3>

            <?php if ($success): ?>
                <div class="success">Your message was sent successfully!</div>
            <?php elseif ($error): ?>
                <div class="error">Something went wrong. Please try again.</div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="field">
                    <input name="name" type="text" placeholder="Name" required>
                </div>

                <div class="field">
                    <input name="email" type="email" placeholder="Email" required>
                </div>

                <div class="field">
                    <input name="subject" type="text" placeholder="Subject" required>
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
