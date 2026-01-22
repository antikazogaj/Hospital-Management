<?php
require "classes/Database.php";

$db = (new Database())->connect();

/* HOME CONTENT */
$homeResult = $db->query("SELECT * FROM pages WHERE title='home'");
$home = $homeResult->fetch_assoc();

/* LATEST NEWS */
$newsResult = $db->query("SELECT * FROM news ORDER BY created_at DESC LIMIT 1");
$latestNews = $newsResult->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>NovaHealth Hospital - Home</title>
  <link rel="stylesheet" href="Home.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

<!-- HEADER -->
<header class="navbar">
  <div class="logo">
    <img src="images/hospital-logo.jpg" alt="Hospital Logo" class="logo-img" />
    <div class="logo-text">
      <span>NovaHealth</span><br><small>HOSPITAL</small>
    </div>
  </div>
  <nav>
    <a href="Home.php" class="active">Home</a>
    <a href="About.php">About</a>
    <a href="Services.php">Services</a>
    <a href="News.php">News</a>
    <a href="Contact.php">Contact</a>
    <a href="Login.php" class="btn-login">Login</a>
  </nav>
</header>

<main class="main-container">

<!-- WELCOME SECTION -->
<section class="welcome">
  <div class="welcome-text">
    <h1><?= htmlspecialchars($home['heading']) ?></h1>
    <p><?= htmlspecialchars($home['content']) ?></p>
    <a href="services.php" class="cta-button">Explore Services</a>
  </div>
  <div class="welcome-image">
    <img src="images/hospital.jpg" alt="Hospital Image" />
  </div>
</section>

<!--  STATISTICS -->
<section class="stats" id="stats">
  <h2>Clinical Performance Summary</h2>
  <div class="stat-cards">
    <div class="stat-card">
      <div class="stat-icon">👤</div>
      <p class="number">1200</p>
      <p>Patients</p>
    </div>
    <div class="stat-card">
      <div class="stat-icon">📅</div>
      <p class="number">50</p>
      <p>Appointments</p>
    </div>
    <div class="stat-card">
      <div class="stat-icon">👨‍⚕️</div>
      <p class="number">30</p>
      <p>Doctors</p>
    </div>
    <div class="stat-card">
      <div class="stat-icon">🩺</div>
      <p class="number">10</p>
      <p>Nurses</p>
    </div>
  </div>
</section>

<!-- SERVICES -->
<section class="services">
  <h2>Our Services</h2>
  <div class="service-list">
    <div class="service-item">
      <div class="icon">🔬</div>
      <strong>Shërbime Laboratorike</strong>
      <p>Testime dhe analiza diagnostifikuese nga ekspertë për vlerësim të saktë.</p>
    </div>
    <div class="service-item">
      <div class="icon">➕</div>
      <strong>Shërbime Emergjente</strong>
      <p>Kujdes emergjent 24/7 me trajtim të menjëhershëm.</p>
    </div>
    <div class="service-item">
      <div class="icon">🩺</div>
      <strong>Shërbime Konsultative</strong>
      <p>Këshilla mjekësore nga specialistë me përvojë.</p>
    </div>
    <div class="service-item">
      <div class="icon">🧪</div>
      <strong>Shërbime Ekzaminimi</strong>
      <p>Kontrolle gjithëpërfshirëse për mirëqenie.</p>
    </div>
  </div>
</section>

<!--NEWS + CONTACT -->
<section class="news-contact">

  <article class="news-card">
    <div class="news-header">
      <i class="fas fa-newspaper"></i> Latest News
    </div>
    <div class="news-content">
      <?php if ($latestNews): ?>
        <time><?= date("F d, Y", strtotime($latestNews['created_at'])) ?></time>
        <h4><?= htmlspecialchars($latestNews['title']) ?></h4>
        <p><?= substr(strip_tags($latestNews['content']), 0, 120) ?>...</p>
        <a href="news.php?id=<?= $latestNews['id'] ?>" class="btn-read">Read More</a>
      <?php else: ?>
        <p>No news available.</p>
      <?php endif; ?>
    </div>
  </article>

  <aside class="contact-card">
    <div class="contact-header">
      <i class="fas fa-phone-alt"></i> Contact
    </div>
    <div class="contact-details">
      <p><strong>Phone:</strong> 044-123-456</p>
      <p><strong>Email:</strong> info@hospital.com</p>
      <a href="contact.php" class="btn-contact">Send Message</a>
    </div>
  </aside>

</section>

</main>

<!-- FOOTER -->
<footer>
  <div class="footer-container">

    <div class="footer-section">
      <h3>Contact Us</h3>
      <p>Phone: 044-123-456</p>
      <p>Email: info@hospital.com</p>
      <p>Address: 123 Hospital St</p>
    </div>

    <div class="footer-section">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="about.php">About Us</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="news.php">News</a></li>
        <li><a href="contact.php">Contact</a></li>
      </ul>
    </div>

    <div class="footer-section">
      <h3>Follow Us</h3>
      <div class="social-media">
        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
      </div>
    </div>

  </div>

  <div class="footer-bottom">
    &copy; 2025 NovaHealth Hospital. All Rights Reserved.
  </div>
</footer>

<script src="Home.js"></script>
</body>
</html>
