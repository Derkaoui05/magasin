<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h2>Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']) ?> (Administrateur)</h2>

    <nav>
        <ul>
            <li><a href="list_users.php">Gérer les Utilisateurs</a></li>
            <li><a href="sales_report.php">Rapports de Vente</a></li>
        </ul>
    </nav>

    <a href="../logout.php">Déconnexion</a>
</body>
</html>
