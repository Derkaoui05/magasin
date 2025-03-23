<?php
require_once '../models/User.php';
session_start();

// Vérifier si l'utilisateur est un administrateur
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/auth/login.php");
    exit();
}

$userModel = new User();

// Ajouter un utilisateur (seul l'ADMIN peut ajouter des vendeurs et d'autres admins)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    // Vérifier que seul un admin peut ajouter un autre admin ou un vendeur
    if (!empty($username) && !empty($password) && ($role === 'vendeur' || $role === 'admin')) {
        if ($userModel->register($username, $password, $role)) {
            header("Location: ../views/admin/list_users.php?success=added");
            exit();
        } else {
            header("Location: ../views/admin/add_user.php?error=failed");
            exit();
        }
    } else {
        header("Location: ../views/admin/add_user.php?error=invalid_role");
        exit();
    }
}
?>
