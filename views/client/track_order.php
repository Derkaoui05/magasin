<?php
require_once '../../models/Order.php';
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'client') {
    header("Location: ../auth/login.php");
    exit();
}

$orderModel = new Order();
$orders = $orderModel->getOrdersByClient($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Suivi des Commandes</title>
</head>
<body>
    <h2>Suivi des Commandes</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Statut</th>
            <th>Total</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['date_commande'] ?></td>
            <td><?= $order['statut'] ?></td>
            <td><?= $order['total'] ?> €</td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
