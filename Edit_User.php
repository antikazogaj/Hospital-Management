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

/* ================= UPDATE USER ROLE ================= */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sigurohemi që ID është numër
    $id = intval($_POST['id']);
    $role = $_POST['role'];

    // Lejojmë vetëm role valide
    $allowed_roles = ['user', 'admin'];
    if (!in_array($role, $allowed_roles)) {
        die("Invalid role selected.");
    }

    $query = "UPDATE users SET role=? WHERE id=?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $role, $id);
    $stmt->execute();

    header("Location: admin_dashboard.php");
    exit;
}

/* ================= GET USER DATA ================= */
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT id, name, email, role FROM users WHERE id=?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found.");
}

$user = $result->fetch_assoc();
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

        <p><strong>Emri:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>

        <label>Roli:
            <select name="role">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </label>

        <br><br>
        <button type="submit">Ruaj Ndryshimet</button>
    </form>
</body>
</html>

