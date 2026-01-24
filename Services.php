<?php
session_start();
require_once "classes/Database.php";
require_once "classes/Service.php";

$db = (new Database())->connect();

// Merr të gjitha shërbimet së bashku me emrin e përdoruesit që e shtoi
$query = "
    SELECT s.*, u.name AS author
    FROM services s
    LEFT JOIN users u ON s.created_by = u.id
    ORDER BY s.created_at DESC
";
$result = $db->query($query);

$services = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Our Services</title>
<link rel="stylesheet" href="Services.css">
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
        <a href="Contact.php">Contact</a>

        <?php if(isset($_SESSION['user'])): ?>
            <a href="logout.php" class="btn-login">Logout</a>
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
                Në Spitalin NovaHealth, ne ofrojmë shërbime të avancuara mjekësore me profesionalizëm,
                dhembshuri dhe përkushtim, duke garantuar që çdo pacient të marrë kujdes të besueshëm
                dhe të përshtatur sipas nevojave të tij.
            </p>
            <a href="#" class="cta-button">Book An Appointment</a>
        </section>
    </div>

    <section class="services-container">
        <?php if(!empty($services)): ?>
            <?php foreach($services as $service): ?>
                <div class="service-card">
                    <img src="uploads/<?= htmlspecialchars($service['image'] ?? 'default.jpg') ?>" 
                         alt="<?= htmlspecialchars($service['title']) ?>" class="service-img">
                    <h3><?= htmlspecialchars($service['title']) ?></h3>
                    <p><?= htmlspecialchars($service['description']) ?></p>
                    <p><strong>Added by:</strong> <?= htmlspecialchars($service['author'] ?? 'Admin') ?></p>
                    <?php if (!empty($service['file'])): ?>
                        <p><a href="uploads/<?= htmlspecialchars($service['file']) ?>" target="_blank">Download PDF</a></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align:center;">No services available at the moment.</p>
        <?php endif; ?>
    </section>
</main>

<footer class="footer">
    <div class="footer-bottom">
        &copy; 2025 NovaHealth Hospital. All Rights Reserved.
    </div>
</footer>
</body>
</html>
