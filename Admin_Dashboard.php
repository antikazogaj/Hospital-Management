 <?php 
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";

// Vetëm admini ka qasje
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: Login.php");
    exit();
}

$database = new Database();
$db = $database->connect();

$query = "SELECT id, name, email, role FROM users ORDER BY id DESC";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - NovaHealth Hospital</title>
    <link rel="stylesheet" href="Admin_Dashboard.css">
</head>
<body>

<h1>Admin Dashboard</h1>

<p>
    Mirësevini, <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>! 
    <a href="Logout.php">Logout</a>
</p>

<h2>Menaxhimi i Përdoruesve</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th> 
        <th>Emri</th> 
        <th>Email</th>
        <th>Roli</th>
        <th>Veprime</th>
    </tr>

    <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td> 
            <td><?= htmlspecialchars($row['name']) ?></td> 
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['role']) ?></td>
            <td>
                <a href="Edit_User.php?id=<?= $row['id'] ?>">Ndrysho</a> | 
                <a href="Delete_User.php?id=<?= $row['id'] ?>" onclick="return confirm('A jeni i sigurt që doni ta fshini këtë përdorues?')">Fshi</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<br><br>

<a href="News_Management.php">📰 Menaxho Lajmet</a>

</body>
</html>
