<?php
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $role = $_POST['role'];

    $query = "UPDATE users SET role=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $role, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit;
}

$id = $_GET['id'];
$query = "SELECT id, name, email, role FROM users WHERE id=?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User Role</h2>
    <form method="POST">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <p>Emri: <?= htmlspecialchars($user['name']) ?></p>
        <p>Email: <?= htmlspecialchars($user['email']) ?></p>
        <label>Roli:
            <select name="role">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </label>
        <button type="submit">Ruaj</button>
    </form>
</body>
</html>
