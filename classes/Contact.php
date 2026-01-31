<?php
session_start();
require_once "classes/Database.php";
require_once "classes/Contact.php";
require_once "classes/User.php";

$database = new Database();
$db = $database->connect();
$contact = new Contact($db);

$success = false;
$error = false;
$errorMsg = '';

// Procesimi i formës
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $contact->name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $contact->email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $contact->subject = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $contact->message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Validimet
    if (empty($contact->name) || empty($contact->subject) || empty($contact->message)) {
        $error = true;
        $errorMsg = "Ju lutemi plotësoni të gjitha fushat.";
    } elseif (!$contact->email) {
        $error = true;
        $errorMsg = "Email-i nuk është valid.";
    } elseif ($contact->create()) {
        $success = true;
    } else {
        $error = true;
        $errorMsg = "Diçka shkoi gabim. Provoni përsëri.";
    }
}

// Nëse admin, merr të gjitha mesazhet
$allContacts = [];
if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin') {
    $allContacts = $contact->readAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us</title>
<link rel="stylesheet" href="Contact.css">
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
        <a href="Services.php">Services</a>
        <a href="News.php">News</a>
        <a href="Contact.php" class="active">Contact</a>
        <?php if(isset($_SESSION['user'])): ?>
            <a href="logout.php" class="btn-login">Logout</a>
        <?php else: ?>
            <a href="login.php" class="btn-login">Login</a>
        <?php endif; ?>
    </nav>
</header>

<main class="contact-section">
    <div class="container">
        <!-- Forme kontakti -->
        <aside class="contact-card">
            <h3 class="card-title">Get in touch</h3>

            <?php if ($success): ?>
                <div class="success">Mesazhi u dërgua me sukses!</div>
            <?php elseif ($error): ?>
                <div class="error"><?= htmlspecialchars($errorMsg) ?></div>
            <?php endif; ?>

            <form method="POST" novalidate>
                <div class="field">
                    <input name="name" type="text" placeholder="Name" required value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>
                <div class="field">
                    <input name="email" type="email" placeholder="Email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>
                <div class="field">
                    <input name="subject" type="text" placeholder="Subject" required value="<?= htmlspecialchars($_POST['subject'] ?? '') ?>">
                </div>
                <div class="field">
                    <textarea name="message" placeholder="Message" required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                </div>
                <button type="submit" class="btn">Send Message</button>
            </form>
        </aside>

        <!-- Pamja për admin -->
        <?php if (!empty($allContacts)): ?>
            <section class="admin-contacts">
                <h3>All Contact Messages (Admin View)</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Sent At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($allContacts as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['name']) ?></td>
                                <td><?= htmlspecialchars($c['email']) ?></td>
                                <td><?= htmlspecialchars($c['subject']) ?></td>
                                <td><?= nl2br(htmlspecialchars($c['message'])) ?></td>
                                <td><?= htmlspecialchars($c['created_at']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        <?php endif; ?>
    </div>
</main>

</body>
</html>
