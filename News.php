<?php
session_start();
require_once "classes/Database.php";

$db =(new Database())->connect();

$query = "SELECT n.*, u.name AS author FROM news n LEFT JOIN users u ON n.created_by = u.id ORDER BY n.created_at DESC";
$result = $db->query($query);

$newsList = [];
if($result) {
    while($row = $result->fetch_assoc()) {
        $newsList[] = $row;

    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        meta name="viewport" content="width=devices-width, initial-scale=1.0">
        <title>NovaHealth News</title>
        <link rel="stylesheet" href="News.css">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <img src="images/hospital-logo.jpg" alt="hospital-logo" class="logo-img">
        <div class="logo-text">
            <span>NovaHealth</span><br /><small>HOSPITAL</small>
</div>
</div>
<nav>
    <a href="Home.php">Home</a>
    <a href="About.php">About</a>
    <a href="Services.php">Services</a>
    <a href="News.php" class="active">News</a>
    <a href="Contact.php">Contact</a>
    <a href="Login.php" class="btn-login">Login</a>

    <?php if(isset($_SESSION['user'])): ?>
        <a href="logout.php" class="btn-login">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn-login">Login</a>
            <?php endif; ?>
        </nav>
        </header>

        <main>
            <div class="news-section-wrapper">
                <section class="news-section">
                    <h1><h1>Të rejat në NovaHealth Hospital</h1>
            <p>
                NovaHealth Hospital ju prezanton zhvillimet më të fundit në fushën e mjekësisë,
                inovacionet tona klinike dhe iniciativat për përmirësimin e kujdesit ndaj pacientëve.
            </p>
            <p>
                Qëndroni të informuar me njoftimet tona më të rëndësishme dhe zhvillimet që e bëjnë
                NovaHealth një hap përpara.
            </p>
        </section>
    </div>
</main>

<?php if(!empty($newsList)): ?>
    <?php foreach($newsList as $news): ?>
        <section class="news-card">
            <div class="news-card-img">
                <img src="uploads/<?= htmlspecialchars($news['image']) ?>" 
                     alt="<?= htmlspecialchars($news['title']) ?>">
            </div>

            <div class="news-card-content">
                <time><?= date("F d, Y", strtotime($news['created_at'])) ?></time>
                <h2><?= htmlspecialchars($news['title']) ?></h2>

                <p><?= nl2br(htmlspecialchars($news['content'])) ?></p>

                <p class="news-author">
                    <strong>Added by:</strong> <?= htmlspecialchars($news['author'] ?? 'Admin') ?>
                </p>
            </div>
        </section>
    <?php endforeach; ?>
<?php else: ?>
    <p style="text-align:center;">No news available.</p>
<?php endif; ?>

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
        <li><a href="Home.php">Home</a></li>
        <li><a href="About.php">About</a></li>
        <li><a href="Services.php">Services</a></li>
        <li><a href="News.php">News</a></li>
        <li><a href="Contact.php">Contact</a></li>
</ul>
</div>

<div class="footer-section">
    <h3>Follow Us</h3>
    <div class="social-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
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