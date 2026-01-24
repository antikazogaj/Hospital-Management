<?php
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";

$registerError = '';
$registerSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Lidhja me DB
    $database = new Database();
    $db = $database->connect();

    $user = new User($db);

    // Marrja dhe pastrimi i inputeve
    $user->name = htmlspecialchars(trim($_POST['fullname'] ?? ''));
    $user->email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm  = $_POST['confirm'] ?? '';

    // Validimet
    if (empty($user->name)) {
        $registerError = "Emri nuk mund të jetë bosh.";
    } elseif (!$user->email) {
        $registerError = "Email i dhënë nuk është valid.";
    } elseif (strlen($password) < 6) {
        $registerError = "Fjalëkalimi duhet të ketë së paku 6 karaktere.";
    } elseif ($password !== $confirm) {
        $registerError = "Fjalëkalimet nuk përputhen.";
    } else {

        // Vendos password (hash bëhet në User.php)
        $user->password = $password;

        // Roli default
        $user->role = "user";

        // Regjistrimi
        if ($user->create()) {
            $registerSuccess = true;
            header("Location: login.php?registered=1"); // redirect tek login me mesazh sukses
            exit;
        } else {
            $registerError = "Ky email ekziston ose ka ndodhur një gabim.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Create Account</title>
    <link rel="stylesheet" href="Register.css" />
</head>
<body>

<div class="container">
    <div class="register-box">
        <h2>Create Account</h2>
        <p class="subtitle">Join our hospital system</p>

        <?php if ($registerError): ?>
            <div class="error"><?= htmlspecialchars($registerError) ?></div>
        <?php endif; ?>

        <form method="POST">
            <!-- FULL NAME -->
            <div class="input-group">
                <i class="icon">👤</i>
                <input type="text" name="fullname" placeholder="Full Name" required>
            </div>

            <!-- EMAIL -->
            <div class="input-group">
                <i class="icon">📧</i>
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <!-- PASSWORD -->
            <div class="input-group">
                <i class="icon">🔒</i>
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="input-group">
                <i class="icon">🔒</i>
                <input type="password" name="confirm" placeholder="Confirm Password" required>
            </div>

            <button type="submit" class="register-btn">Register</button>
        </form>

        <p class="login-link">
            Already have an account? <a href="Login.php">Log In</a>
        </p>
    </div>
</div>

</body>
</html>
