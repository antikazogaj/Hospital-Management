<?php
session_start();
require_once "classes/Database.php";

// Vetëm admini ka qasje
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->connect();

// Merr ID nga URL
$id = $_GET['id'] ?? 0;

// Kontrollo që ID është valid
if ($id > 0) {
    $stmt = $db->prepare("DELETE FROM news WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

// Kthehu tek faqja e lajmeve pas fshirjes
header("Location: News.php");
exit;
?>
