<?php
require_once 'connection.php';

class User {
    private $pdo;

    public function __construct() {
        $this->pdo = Connection::Connect();
    }

    // ✅ Register a new user
    public function register($username, $password, $role) {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'username' => $username,
            'password' => $hashed_password,
            'role' => $role
        ]);
    }

    // ✅ Authenticate user (login)
    public function login($username, $password) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user; // Return user details if password matches
        }
        return false;
    }

    // ✅ Count total users
    public function countUsers() {
        $sql = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }


    // ✅ Get all users (for admin panel)
    public function getAllUsers() {
        $sql = "SELECT id, username, role FROM users ORDER BY role ASC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Get user by ID
    public function getUserById($id) {
        $sql = "SELECT id, username, role FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Update user details
    public function updateUser($id, $username, $role) {
        $sql = "UPDATE users SET username = :username, role = :role WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'username' => $username,
            'role' => $role
        ]);
    }

    // ✅ Delete user by ID
    public function deleteUser($id) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
?>
