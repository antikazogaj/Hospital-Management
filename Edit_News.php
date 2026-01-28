<?php
session_start();
require_once "classes/Database.php";

// Vetëm admini ka qasje
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: Login.php");
    exit;
}

$database = new Database();
$db = $database->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']); // sigurohemi që është numër
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content'])); // ✅ RREGULLUAR (ishte $conten)

    $query = "UPDATE news SET title = ?, content = ? WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();

    header("Location: News_Management.php"); // hapësira e shtuar
    exit;
}

// Marrim ID nga URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$query = "SELECT id, title, content FROM news WHERE id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$news = $result->fetch_assoc();

// Nëse nuk ekziston lajmi
if (!$news) {
    echo "News not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit News</title>
</head>
<body>

<h2>Edit News</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $news['id'] ?>">

    <p>
        Title:
        <input type="text" name="title" value="<?= htmlspecialchars($news['title']) ?>" required>
    </p>

    <p>
        Content:<br>
        <textarea name="content" rows="6" cols="50" required><?= htmlspecialchars($news['content']) ?></textarea>
    </p>

    <button type="submit">Save Changes</button>
</form>

</body>
</html>


