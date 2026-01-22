<?php
// Nis sesionin per t kontrolluar nese ka login me vone
session_start();

require_once "classes/Database.php";

$db = new Database();

// Marrim përmbajtjen e faqes About nga databaza (opsionale)
$about = $db->getPageContent('about'); // funksion që kthen title + content
$team = $db->getTeam(); // funksion që kthen të gjithë stafin nga tabela "team"

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="About.css">
</head>
<body>
  <header class="navbar">
    <div class="logo">
      <img src="images/hospital-logo.jpg" alt="Logo e spitalit NovaHealth" class="logo-img">
      <div class="logo-text">
        <span>NovaHealth</span><br><small>HOSPITAL</small>
      </div>
    </div>
    <nav>
        <a href="Home.php">Home</a>
        <a href="About.php" class="active">About</a>
        <a href="Services.php">Services</a>
        <a href="News.php">News</a>
        <a href="Contact.php">Contact</a>
        <a href="Login.php" class="btn-login">Login</a>
    </nav>
  </header>

<main>
  <div class="about-section-wrapper">
    <section class="about-section">
      <h1><?php echo $about['title']; ?></h1>
      <p><?php echo $about['content']; ?></p>
    </section>
  </div>

  <section class="team-section">
    <h2 class="team-title">Staff</h2>
    <p class="team-subtitle">Ekspertë të fushave të ndryshme për kujdesin më të mirë shëndetësor.</p>

    <div class="team-grid">
      <?php foreach($team as $member): ?>
        <div class="team-card">
          <img src="uploads/<?php echo $member['photo']; ?>" alt="<?php echo $member['name']; ?>" />
          <h3><?php echo $member['name']; ?></h3>
          <p class="role"><?php echo $member['role']; ?></p>
          <p class="desc"><?php echo $member['specialty']; ?></p>
          <p class="desc">Email: <?php echo $member['email']; ?></p>
          <p class="desc">Tel: <?php echo $member['phone']; ?></p>
          <button class="btn-team">Contact</button>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <footer class="footer">
    <div class="footer-bottom">
      &copy; 2025 NovaHealth Hospital. All Rights Reserved.
    </div>
  </footer>
</main>

<script src="About.js"></script>
</body>
</html>
