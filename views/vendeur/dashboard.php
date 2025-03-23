<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'vendeur') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dashboard Vendeur</title>
</head>
<body>
    <h2>Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']) ?> (Vendeur)</h2>

    <nav>
        <ul>
            <li><a href="list_products.php">Gérer les Produits</a></li>
            <li><a href="manage_stock.php">Gérer le Stock</a></li>
            <li><a href="manage_promotions.php">Gérer les Promotions</a></li>
        </ul>
    </nav>

    <a href="../logout.php">Déconnexion</a>
</body>
</html>
