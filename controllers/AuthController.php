<?php
require_once '../models/User.php';
session_start();

$userModel = new User();

// Connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        $user = $userModel->login($username, $password);
        if ($user) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role']
            ];

            // Rediriger selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: ../views/admin/dashboard.php");
            } elseif ($user['role'] === 'vendeur') {
                header("Location: ../views/vendeur/dashboard.php");
            } elseif ($user['role'] === 'client') {
                header("Location: ../views/client/dashboard.php");
            }
            exit();
        } else {
            header("Location: ../views/auth/login.php?error=invalid");
            exit();
        }
    } else {
        header("Location: ../views/auth/login.php?error=empty_fields");
        exit();
    }
}
?>
