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

// ID e userit që do fshihet
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// ID e adminit që është i kyçur
$currentAdminId = $_SESSION['user']['id'];

// Mos lejo adminin me fshi veten
if ($id === $currentAdminId) {
    die("You cannot delete your own account.");
}

// Kontrollo nëse user ekziston
$stmt = $db->prepare("SELECT id FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

// Fshije userin
$stmt = $db->prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Kthehu te dashboard
header("Location: admin_dashboard.php");
exit;
?>

