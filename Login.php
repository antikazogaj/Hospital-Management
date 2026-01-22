<?php
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";

$loginError = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $database = new Database();
    $db = $database->connect();

    $user = new User($db);
    $user->email = $_POST['email'] ?? '';
    $user->password = $_POST['password'] ?? '';

    if ($user->login()) {
        // Redirect tek faqja kryesore pas login
        header("Location: Home.php");
        exit;
    } else {
        $loginError = "Email ose fjalëkalimi i gabuar!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link rel="stylesheet" href="Login.css" />
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Welcome Back</h2>
      <p class="subtitle">Sign in to continue</p>

      <?php if($loginError): ?>
          <div class="error"><?= $loginError ?></div>
      <?php endif; ?>

      <form method="POST">
        <div class="input-group">
          <i class="icon">👤</i>
          <input type="text" name="email" placeholder="Email or Username" required />
        </div>
        <div class="input-group">
          <i class="icon">🔒</i>
          <input type="password" name="password" placeholder="Password" required />
        </div>
        <div class="options">
          <label><input type="checkbox" name="remember" /> Remember me</label>
          <a href="#" class="forgot">Forgot Password?</a>
        </div>
        <button class="login-btn" type="submit">Log In</button>
      </form>

      <div class="divider"><span>or</span></div>
      <div class="social-login">
        <button class="google">Google</button>
        <button class="facebook">Facebook</button>
        <button class="twitter">Twitter</button>
      </div>
      <p class="create">New here? <a href="Register.php">Create Account</a></p>
    </div>
  </div>

  <script src="Login.js"></script>
</body>
</html>
