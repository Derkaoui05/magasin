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
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Ajout de FontAwesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <?php include '../partials/header.php'; ?>

    <main class="max-w-7xl mx-auto p-6">
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']) ?> (Vendeur)</h2>
            <p class="text-gray-600 mt-2">Gérez vos produits, stock et promotions ci-dessous.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-blue-50 p-6 rounded-lg shadow hover:bg-blue-100 transition duration-300">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-cogs text-blue-600 text-3xl"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-blue-600">Gérer les Produits</h3>
                        <p class="text-gray-600 mt-2">Ajoutez, modifiez ou supprimez vos produits.</p>
                    </div>
                </div>
                <a href="list_products.php" class="text-blue-500 mt-4 inline-block">Voir les Produits</a>
            </div>

            <div class="bg-green-50 p-6 rounded-lg shadow hover:bg-green-100 transition duration-300">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-boxes text-green-600 text-3xl"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-green-600">Gérer le Stock</h3>
                        <p class="text-gray-600 mt-2">Suivez et gérez votre inventaire.</p>
                    </div>
                </div>
                <a href="manage_stock.php" class="text-green-500 mt-4 inline-block">Gérer le Stock</a>
            </div>

            <div class="bg-yellow-50 p-6 rounded-lg shadow hover:bg-yellow-100 transition duration-300">
                <div class="flex items-center space-x-4">
                    <i class="fas fa-tag text-yellow-600 text-3xl"></i>
                    <div>
                        <h3 class="text-lg font-semibold text-yellow-600">Gérer les Promotions</h3>
                        <p class="text-gray-600 mt-2">Créez et gérez vos offres spéciales.</p>
                    </div>
                </div>
                <a href="manage_promotions.php" class="text-yellow-500 mt-4 inline-block">Gérer les Promotions</a>
            </div>
        </div>

        <div class="mt-6">
            <a href="../logout.php" class="text-red-500 text-sm">Déconnexion</a>
        </div>
    </main>

    <?php include '../partials/footer.php'; ?>
</body>
</html>
