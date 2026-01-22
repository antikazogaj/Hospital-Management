<?php
session_start();
require_once "classes/Database.php";

$db = new Database();

$query = "SELECT * FROM services ORDER BY created_at DESC";
$result = $db->query($query);

$services = [];
if($result) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang= "en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Our Services</title>
        <link rel ="stylesheet" href="Services.css">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <img src="images/hospital-logo.jpg" alt="Hospital Logo" class="logo-img">
        <div class="logo-text">
            <span>NovaHealth</span><br /><small>HOSPITAL</small>
</div>
</div>
<nav>
    <a href="Home.php">Home</a>
    <a href="About.php">About</a>
    <a href="Services.php" class="active">Services</a>
    <a href="News.php">News</a>
    <a href="Conract.php">Contact</a>
    <a href="Login.php" class="btn-login">Login</a>
  </nav>
</header>

<?php if(isset($_SESSION['user'])): ?>
    <a href= "logout.php" class="btn-login">Logout</a>
    <?php else: ?>
        <a href="login.php" class="btn-login">Login</a>
        <?php endif; ?>
    </nav>
    </header>

    <main>
        <div class="services-section-wrapper">
            <section class="services-section">
                <h1>Our Services</h1>
                <p>
                     “Në Spitalin NovaHealth, ne ofrojmë shërbime të avancuara mjekësore me profesionalizëm,
                dhembshuri dhe përkushtim, duke garantuar që çdo pacient të marrë kujdes të besueshëm
                dhe të përshtatur sipas nevojave të tij.”
            </p>
            <a href="#" class="cta-button">Book An Appointment</a>
    </section>
    </div>
    </main>
    <section class="services-container">

    <?php if(!empty($services)): ?>
        <?php foreach($services as $services): ?>
            <div class="service-card">
               <img src="uploads/<?= htmlspecialchars($service['image']) ?>" 
              alt="<?= htmlspecialchars($service['title']) ?>" 
              class="service-img"
            
            >
            <h3><?= htmlspecialchars($service['title']) ?></h3>
            <p><?= htmlspecialchars($service['description']) ?></p>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">No services available at the moment.</p>
<?php endif; ?>

</section>

<footer class="footer">
    <div class="footer-bottom">
        &copy; 2025 NovaHealth Hospital. All Rights Reserved.
    </div>
</footer>

<script src="Services.js"></script>
</body>
</html>