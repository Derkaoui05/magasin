<?php
require_once '../models/Order.php';
session_start();

// Only admins and vendors can update orders
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'vendeur')) {
    header("Location: ../auth/login.php");
    exit();
}

$commandeModel = new Commande();

// ✅ Update Commande Status
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $commandeId = $_POST['commande_id'];
    $status = $_POST['status'];

    $sql = "UPDATE commandes SET status = :status WHERE id = :id";
    $stmt = $commandeModel->$pdo->prepare($sql);
    if ($stmt->execute(['status' => $status, 'id' => $commandeId])) {
        header("Location: ../views/admin/manage_commandes.php?success=updated");
    } else {
        header("Location: ../views/admin/manage_commandes.php?error=failed");
    }
    exit();
}
?>
