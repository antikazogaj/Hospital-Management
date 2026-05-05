<?php
include_once 'Database.php';
include_once 'User.php';

//Fillojme me variablat superglobale
if($_SERVER['REQUEST_METHOD'] == 'POST') { //kontrollon qe kodet te ekzekutohet atehere kur perdoruesi e shtyp butonin e register
    $db = new Database(); //krijimi i nje instance te klases Database per te krijuar nje lidhje me bazen e te dhenave
    $connection = $db->getConnection();//merr lidhjen me bazen e te dhenave qe eshte krijuar nga objekti DB 
      $user = new User($connection); //krijimi i nje instance te klases User krijon lidhjen me bazen e te dhenave dhe njekohesisht i merr vlerat si nje argument i caktuar

    $name = $_POST['name']; //me metoden post kontrollhen atributet e regjistrimit 
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if($user->register(name: $name, email: $email, password: $password, confirm_password: $confirm_password)) { //pjesa e reghistrimit te user qe tregon nje registrimi nese o i sukseshem po ose jo
        header("Location: Login.php");
        exit();
    } else {
        echo "Invalid login credentials!";

    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Register.css">
  <title>Create Account</title>
</head>
<body>
<div class="container">
  <div class="register-box">
    <h2>Create Account</h2>
    <p class="subtitle">Join our hospital system</p>

    <form action="Register.php" method="POST">
      <div class="input-group">
        <i class="icon">👤</i>
        <input type="text" name="name" placeholder="Full Name" required>
      </div>
      <div class="input-group">
        <i class="icon">📧</i>
        <input type="email" name="email" placeholder="Email Address" required>
      </div>
      <div class="input-group">
        <i class="icon">🔒</i>
        <input type="password" name="password" placeholder="Password" required>
      </div>
      <div class="input-group">
        <i class="icon">🔒</i>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      </div>
      <button type="submit" class="register-btn" name="register">Register</button>
    </form>

    <p class="login-link">Already have an account? <a href="Login.php">Log In</a></p>
  </div>
</div>
</body>
</html>