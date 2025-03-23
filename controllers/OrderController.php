<?php
require_once '../models/Order.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: ../views/auth/login.php");
    exit();
}

$orderModel = new Order();

// Passer une commande
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    $clientId = $_SESSION['user']['id'];
    $livraison = $_POST['livraison'];
    $dateLivraison = $_POST['date_livraison'];

    $orderModel->placeOrder($clientId, $livraison, $dateLivraison);
    header("Location: ../views/orders/list_orders.php?success=order_placed");
    exit();
}
?>
