<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'client') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dashboard Client</title>
</head>
<body>
    <h2>Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']) ?> (Client)</h2>

    <nav>
        <ul>
            <li><a href="list_products.php">Voir les Produits</a></li>
            <li><a href="cart.php">Mon Panier</a></li>
            <li><a href="track_order.php">Suivi des Commandes</a></li>
            <li><a href="order_history.php">Historique d'Achat</a></li>
        </ul>
    </nav>

    <a href="../logout.php">Déconnexion</a>
</body>
</html>
