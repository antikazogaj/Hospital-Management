 <?php 
session_start();
require_once "classes/Database.php";
require_once "classes/User.php";

if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: Login.php");
    exit();
}

$database = new Database();
$db = $database->connect();

$query = "SELECT id, name, email, role FROM users";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset = UTF-8>
        <title>Admin Dashboard - NovaHealth Hospital</title>
        <link rel = "stylesheet" href = "Admin_Dashboard.css">
        </head>
         <body>
             <h1>Admin Dashboard</h1>
             <p>
                  Mirësevini, <?= htmlspecialchars($_SESSION['user']['name']) ?>! 
                 <a href="Logout.php">Logout</a>
                       </p>
                      <table border="1" cellpadding="10"> <tr>
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
                              <td><?= $row['role'] ?></td>
                               <td> <a href="Edit_User.php?id=<?= $row['id'] ?>">Ndrysho</a> |
                                <a href="Delete_User.php?id=<?= $row['id'] ?>" onclick="return confirm('A jeni i sigurt?')">Fshi</a>
                             </td>
                             </tr>
                              <?php endwhile; ?>
                             </table>
                             </body>
                             </html>