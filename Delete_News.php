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

// Merr ID dhe sigurohu që është numër
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid news ID.");
}

// Kontrollo nëse lajmi ekziston
$stmt = $db->prepare("SELECT id FROM news WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("News not found.");
}

// Fshije lajmin
$stmt = $db->prepare("DELETE FROM news WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

// Kthehu te menaxhimi i lajmeve
header("Location: News_Management.php");
exit;
?>
