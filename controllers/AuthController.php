<?php
require_once '../models/User.php';
session_start();

// Enable error reporting for debugging (Remove this in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$userModel = new User();

// ✅ Handle User Registration
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = 'client'; // Clients register themselves, admins add vendors

    if (!empty($username) && !empty($password)) {
        if ($userModel->register($username, $password, $role)) {
            header("Location: ../views/auth/login.php?success=registered");
            exit();
        } else {
            header("Location: ../views/auth/register.php?error=failed");
            exit();
        }
    } else {
        header("Location: ../views/auth/register.php?error=empty_fields");
        exit();
    }
}

// ✅ Handle User Login
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

            // Redirect user based on their role
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

// ✅ Handle User Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../views/auth/login.php");
    exit();
}
?>
