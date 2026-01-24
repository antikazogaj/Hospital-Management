<?php
session_start();
require_once "classes/Database.php";
require_once "classes/News.php";

$db = (new Database())->connect();
$newsObj = new News($db);

// Merr të gjitha lajmet së bashku me emrin e përdoruesit që i ka shtuar
$newsList = $newsObj->readAll(); // metoda readAll() në News.php duhet të bëjë SELECT * FROM news LEFT JOIN users

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NovaHealth News</title>
<link rel="stylesheet" href="News.css">
</head>
<body>

<header class="navbar">
    <div class="logo">
        <img src="images/hospital-logo.jpg" alt="hospital-logo" class="logo-img">
        <div class="logo-text">
            <span>NovaHealth</span><br>
            <small>HOSPITAL</small>
        </div>
    </div>

    <nav>
        <a href="Home.php">Home</a>
        <a href="About.php">About</a>
        <a href="Services.php">Services</a>
        <a href="News.php" class="active">News</a>
        <a href="Contact.php">Contact</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="logout.php" class="btn-login">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn-login">Login</a>
        <?php endif; ?>
    </nav>
</header>

<main>
    <div class="news-section-wrapper">
        <section class="news-section">
            <h1>Të rejat në NovaHealth Hospital</h1>
            <p>
                NovaHealth Hospital ju prezanton zhvillimet më të fundit në fushën e mjekësisë,
                inovacionet tona klinike dhe iniciativat për përmirësimin e kujdesit ndaj pacientëve.
            </p>
        </section>
    </div>

    <?php if(!empty($newsList)): ?>
        <?php foreach($newsList as $news): ?>
            <section class="news-card">
                <div class="news-card-img">
                    <img 
                        src="uploads/<?= htmlspecialchars($news['image'] ?? 'default.jpg') ?>"
                        alt="<?= htmlspecialchars($news['title']) ?>">
                </div>

                <div class="news-card-content">
                    <time><?= date("F d, Y", strtotime($news['created_at'])) ?></time>
                    <h2><?= htmlspecialchars($news['title']) ?></h2>

                    <p><?= nl2br(htmlspecialchars($news['content'])) ?></p>

                    <p class="news-author">
                        <strong>Added by:</strong> <?= htmlspecialchars($news['author'] ?? 'Admin') ?>
                    </p>

                    <?php if (!empty($news['file'])): ?>
                        <p><a href="uploads/<?= htmlspecialchars($news['file']) ?>" target="_blank">Download PDF</a></p>
                    <?php endif; ?>
                </div>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center;">No news available.</p>
    <?php endif; ?>

    <?php if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <section class="admin-news">
            <h3>Admin Panel - Manage News</h3>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($newsList as $news): ?>
                        <tr>
                            <td><?= htmlspecialchars($news['title']) ?></td>
                            <td><?= htmlspecialchars($news['author'] ?? 'Admin') ?></td>
                            <td><?= htmlspecialchars($news['created_at']) ?></td>
                            <td>
                                <a href="edit_news.php?id=<?= $news['id'] ?>">Edit</a> |
                                <a href="delete_news.php?id=<?= $news['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    <?php endif; ?>

</main>

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
    </div>
</footer>

<script src="News.js"></script>
</body>
</html>
