<?php
class User {
    private $conn;
    private $table = "users"; // emri i tabelës në DB

    // Atributet e përdoruesit
    public $id;
    public $name;
    public $email;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // CREATE - Regjistrim përdoruesi
    public function create() {
        $query = "INSERT INTO {$this->table} (name, email, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if(!$stmt) return false;

        // Hash password
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt->bind_param("ssss", $this->name, $this->email, $hashedPassword, $this->role);
        return $stmt->execute();
    }

    // READ - Merr të dhënat e përdoruesit sipas ID
    public function read() {
        $query = "SELECT id, name, email, role FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // UPDATE - Përditësim përdoruesi
    public function update() {
        $query = "UPDATE {$this->table} SET name=?, email=?, password=?, role=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $stmt->bind_param("ssssi", $this->name, $this->email, $hashedPassword, $this->role, $this->id);
        return $stmt->execute();
    }

    // DELETE - Fshirje përdoruesi
    public function delete() {
        $query = "DELETE FROM {$this->table} WHERE id=?";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("i", $this->id);
        return $stmt->execute();
    }

    // LOGIN - Kontroll email/password dhe session
    public function login() {
        $query = "SELECT id, name, email, password, role FROM {$this->table} WHERE email = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        if(!$stmt) return false;

        $stmt->bind_param("s", $this->email);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();

        if($result && password_verify($this->password, $result['password'])) {
            // Start session dhe vendos variabla
            session_start();
            $_SESSION['user'] = [
                'id' => $result['id'],
                'name' => $result['name'],
                'email' => $result['email'],
                'role' => $result['role']
            ];
            return true;
        } else {
            return false;
        }
    }

    // CHECK ROLE
    public function isAdmin() {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }
}
?>

