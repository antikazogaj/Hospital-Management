<?php
session_start();

// Hiq të gjitha variablat e sesionit
session_unset();

// Shkatërro sesionin
session_destroy();

// Ridrejto përdoruesin tek faqja e login
header("Location: Login.php");
exit;
?>
