<?php
require_once '../../models/Order.php';
require_once '../../models/User.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$userModel = new User();
$commandeModel = new Commande();

// Get total users
$totalUsers = $userModel->countUsers();

// Get total commandes (orders)
$totalOrders = $commandeModel->countCommandes();

// Get total revenue
$totalRevenue = $commandeModel->sumTotalRevenue();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <?php include '../partials/header.php'; ?>

    <main class="max-w-7xl mx-auto p-6 mt-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-center mb-6">Tableau de Bord - Admin</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-blue-500 text-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold">👥 Utilisateurs</h3>
                <p class="text-xl mt-2"><?= $totalUsers ?> inscrits</p>
            </div>
            <div class="bg-green-500 text-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold">📦 Commandes</h3>
                <p class="text-xl mt-2"><?= $totalOrders ?> commandes</p>
            </div>
            <div class="bg-yellow-500 text-white p-6 rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold">💰 Revenus</h3>
                <p class="text-xl mt-2"><?= number_format($totalRevenue, 2) ?> €</p>
            </div>
        </div>

        <h3 class="text-2xl font-semibold mt-8">Gestion</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
            <a href="list_users.php" class="bg-blue-500 text-white p-6 rounded-lg shadow-md hover:bg-blue-600 transition">
                🧑‍💼 Gérer les Utilisateurs
            </a>
            <a href="manage_commandes.php" class="bg-green-500 text-white p-6 rounded-lg shadow-md hover:bg-green-600 transition">
                📦 Gérer les Commandes
            </a>
            <a href="sales_report.php" class="bg-yellow-500 text-white p-6 rounded-lg shadow-md hover:bg-yellow-600 transition">
                📊 Rapports de Ventes
            </a>
        </div>
    </main>

    <?php include '../partials/footer.php'; ?>

</body>
</html>
