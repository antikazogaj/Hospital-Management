<?php
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";

$registerError = '';
$registerSuccess = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    $user->fullname = htmlspecialchars(trim($_POST['fullname'] ?? ''));
    $user->email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';

    if (!$user->email) {
        $registerError = "Email i dhënë nuk është valid.";
    } elseif ($password !== $confirm) {
        $registerError = "Fjalëkalimet nuk përputhen.";
    } else {
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        // Mund të vendosim rolin default "user"
        $user->role = "user";

        if ($user->register()) {
            $registerSuccess = true;
        } else {
            $registerError = "Ka ndodhur një gabim. Emaili mund të ekzistojë.";
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

            <?php if ($registerSuccess): ?>
                <div class="success">Regjistrimi u krye me sukses! <a href="Login.php">Log in</a></div>
            <?php elseif ($registerError): ?>
                <div class="error"><?= $registerError ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="input-group">
                    <i class="icon">👤</i>
                    <input type="text" name="fullname" placeholder="Full Name" required />
                </div>

                <div class="input-group">
                    <i class="icon">📧</i>
                    <input type="email" name="email" placeholder="Email Address" required />
                </div>

                <div class="input-group">
                    <i class="icon">🔒</i>
                    <input type="password" name="password" placeholder="Password" required />
                </div>

                <div class="input-group">
                    <i class="icon">🔒</i>
                    <input type="password" name="confirm" placeholder="Confirm Password" required />
                </div>

                <button type="submit" class="register-btn">Register</button>
            </form>

            <p class="login-link">
                Already have an account? <a href="Login.php">Log In</a>
            </p>
        </div>
    </div>

    <script src="Register.js"></script>
</body>
</html>

