<?php
session_start(); //per me ruajt te dhenat dhe me kalu ne faqe tjera
include_once 'Database.php';
include_once 'User.php';

//Fillojme me variablat superglobale
if($_SERVER['REQUEST_METHOD'] == 'POST') { //kontrollon qe kodet te ekzekutohet atehere kur perdoruesi e shtyp butonin e register
    $db = new Database(); //krijimi i nje instance te klases Database per te krijuar nje lidhje me bazen e te dhenave
    $connection = $db->getConnection();//merr lidhjen me bazen e te dhenave qe eshte krijuar nga objekti DB 
    $user = new User(db: $connection); //krijimi i nje instance te klases User krijon lidhjen me bazen e te dhenave dhe njekohesisht i merr vlerat si nje argument i caktuar

     //me metoden post kontrollhen atributet e regjistrimit 
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    

    if($user->login(email_or_username: $email_or_username, password: $password)) { //pjesa e login te user qe tregon nje login nese o i sukseshem po ose jo
        header("Location: Home.php");
        exit();
    } else {
        echo "Error registering user!";

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
      <form>
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
      <p class="create">New here? <a href="Register.html">Create Account</a></p>
    </div>
  </div>

  <script src="Login.js"></script>
</body>
</html>