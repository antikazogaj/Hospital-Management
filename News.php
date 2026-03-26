<?php
include_once 'Database.php';


$db = new Database();
$connection = $db->getConnection();
$newsObj = new NewsClass($connection);
$newsList = $newsObj->getAllNews();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaHealth Hospital News</title>
    <link rel="stylesheet" href="News.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <img src="images/hospital-logo.jpg" alt="hospital-logo" class="logo-img" />
            <div class="logo-text">
                <span>NovaHealth</span><br /><small>HOSPITAL</small>
            </div>
        </div>
        <nav>
            <a href="Home.html">Home</a>
            <a href="About.html">About</a>
            <a href="Services.html">Services</a>
            <a href="News.php" class="active">News</a>
            <a href="Contact.html">Contact</a>
            <a href="Login.html" class="btn-login">Login</a>
        </nav>
    </header>
   
    <main>
        <div class="news-section-wrapper">
            <section class="news-section">
                <h1>Të rejat në NovaHealth Hospital</h1>
                <p>NovaHealth Hospital ju prezanton zhvillimet më të fundit në fushën e mjekësisë, inovacionet tona klinike dhe iniciativat e vazhdueshme për përmirësimin e kujdesit ndaj pacientëve.</p>
                <p>Qëndroni të informuar me njoftimet tona më të rëndësishme dhe zhvillimet që e bëjnë NovaHealth një hap përpara në çdo drejtim.</p>
            </section>
        </div>
    </main>

    <!-- Krahu pediatrik News -->
    <section class="news-card" id="pediatric">
        <div class="news-card-img">
            <img src="pediatric-wing.jpg" alt="Pediatric Wings">
        </div>
        <div class="news-card-content">
            <time datetime="2024-05-19">May 19, 2024</time>
            <h2>Hapet Krahu i Ri Pediatrik në NovaHealth Hospital</h2>
            <p>NovaHealth Hospital ka hapur krahun e ri pediatrik, të krijuar për të ofruar trajtim të specializuar dhe një përvojë më të sigurt e më komode për fëmijët. Me teknologji moderne dhe ambiente miqësore për fëmijët, ky hap i ri forcon misionin tonë për kujdes cilësor dhe të personalizuar.</p>
            <ul>
                <li>Njësi të avancuara të kujdesit pediatrik</li>
                <li>Dhoma të dizajnuara posaçërisht për fëmijë dhe hapësira lojërash</li>
                <li>Specialistë pediatrikë me përvojë të lartë</li>
                <li>Siguri dhe rehati të përmirësuar</li>
            </ul>
            <p><strong>Nga Dr. Vlora Jaha Ismaili:</strong> "Krahu i ri pediatrik është një dëshmi e përkushtimit tonë për të ofruar kujdesin më të mirë për fëmijët."-thekson dr. Jaha Ismaili.</p>
        </div>
    </section>

    <!-- Telemedicine News -->
    <section class="news-card" id="telemedicine">
        <div class="news-card-img">
            <img src="images/telemedicine.jpg" alt="Telemedicine Services">
        </div>
        <div class="news-card-content">
            <time datetime="2025-11-28">Nov 28, 2025</time>
            <h2>Shërbimet e Telemjekësisë Tani në Dispozicion</h2>
            <p><strong>Kujdes shëndetësor nga shtëpia juaj – shpejt, lehtë dhe i sigurt</strong></p>
            <p>NovaHealth Hospital prezanton shërbimet e reja të telemjekësisë, duke ju mundësuar konsultime online me mjekët tanë specialistë pa pasur nevojë të udhëtoni. Tani, kujdesi mjekësor është vetëm një klikim larg.</p>
            <ul>
                <li>Konsultime online me specialistë</li>
                <li>Dërgim të recetave direkt në adresën tuaj</li>
                <li>Platformë mjekësore e sigurt dhe plotësisht konfidenciale</li>
                <li>Planifikim i lehtë i kontrolleve të radhës</li>
            </ul>
            <p><strong>Nga Dr. Liridon Hoxha:</strong> “Shërbimet tona të telemjekësisë e bëjnë kujdesin shëndetësor më të qasshëm dhe më të përshtatshëm për çdo pacient,”-thekson Dr. Liridon Hoxha.</p>
        </div>
    </section>

    <!-- Qendra e Kardiologjise Expansion -->
    <section class="news-card" id="cardiology">
        <div class="news-card-img">
            <img src="cardiology-center.jpg" alt="Cardiology Center Expansion">
        </div>
        <div class="news-card-content">
            <time datetime="2025-12-05">Dec 5, 2025</time>
            <h2>Qendra e Kardiologjisë tani ofron më shumë kujdes të avancuar për zemrën</h2>
            <p><strong>Kujdes kardiak më i avancuar për ju</strong></p>
            <p>NovaHealth Hospital ka përfunduar zgjerimin e Qendrës së Kardiologjisë, duke ofruar shërbime të avancuara për kujdesin e zemrës. Krahu i ri përfshin dhoma shtesë për procedura dhe pajisje diagnostikuese të fundit, duke përmirësuar trajtimin dhe rehati për pacientët.</p>
            <ul>
                <li>Pajisje diagnostikuese të avancuara për zemrën</li>
                <li>Dhoma të zgjeruara për konsultime dhe rikuperim</li>
                <li>Ekipë të specializuar për kujdes kardiak</li>
                <li>Siguri dhe rehati të përmirësuar për pacientët</li>
            </ul>
            <p><strong>Nga Dr. Amir Iljazi:</strong> “Qendra jonë e zgjeruar e Kardiologjisë na lejon të ofrojmë kujdes kardiak me standarde botërore për më shumë pacientë.”-thekson Dr. Amir Iljazi.</p>
        </div>
    </section>

    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-phone"></i> Phone:044-123-456</p>
                <p><i class="fas fa-envelope"></i> Email: <a href="mailto:info@hospital.com">info@hospital.com</a></p>
                <p><i class="fas fa-map-marker-alt"></i> Address: 123 Hospital St, City, Country</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="Home.html">Home</a></li>
                    <li><a href="About.html">About</a></li>
                    <li><a href="Services.html">Services</a></li>
                    <li><a href="news.php">News</a></li>
                    <li><a href="Contact.html">Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Follow Us</h3>
                <div class="social-media">
                    <a href="https://www.facebook.com/" class="social-icon facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/" class="social-icon instagram"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/" class="social-icon twitter"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 NovaHealth Hospital. All Rights Reserved.
        </div>
    </footer>

    <script src="News.js"></script>
</body>
</html>