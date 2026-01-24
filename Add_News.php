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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $author_id = $_SESSION['user']['id'];

    // Upload image (opsionale)
    $image = null;
    if (!empty($_FILES['image']['name'])) {
        $image = basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    }

    // Upload file (opsionale PDF)
    $file = null;
    if (!empty($_FILES['file']['name'])) {
        $file = basename($_FILES['file']['name']);
        move_uploaded_file($_FILES['file']['tmp_name'], "uploads/" . $file);
    }

    $query = "INSERT INTO news (title, content, image, file, created_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ssssi", $title, $content, $image, $file, $author_id);
    $stmt->execute();

    header("Location: News.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add News</title>
</head>
<body>
    <h2>Add News</h2>
    <form method="POST" enctype="multipart/form-data">
        <p>Title: <input type="text" name="title" required></p>
        <p>Content:<br>
            <textarea name="content" rows="6" cols="50" required></textarea>
        </p>
        <p>Image: <input type="file" name="image"></p>
        <p>PDF File: <input type="file" name="file"></p>
        <button type="submit">Add News</button>
    </form>
</body>
</html>
