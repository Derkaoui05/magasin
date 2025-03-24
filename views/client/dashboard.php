<?php
require_once '../../models/Product.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'client') {
    header("Location: ../auth/login.php");
    exit();
}

$productModel = new Product();
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <?php include '../partials/header.php'; ?>

    <main class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-center my-8">Bienvenue, <?= htmlspecialchars($_SESSION['user']['username']) ?> !</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <a href="list_products.php" class="bg-blue-500 text-white p-6 rounded-lg shadow-md hover:bg-blue-600 transition">
                🛍️ Voir les Produits
            </a>
            <a href="cart.php" class="bg-green-500 text-white p-6 rounded-lg shadow-md hover:bg-green-600 transition">
                🛒 Voir mon Panier
            </a>
            <a href="order_history.php" class="bg-yellow-500 text-white p-6 rounded-lg shadow-md hover:bg-yellow-600 transition">
                📜 Historique des Commandes
            </a>
            <a href="track_order.php" class="bg-purple-500 text-white p-6 rounded-lg shadow-md hover:bg-purple-600 transition">
                🚚 Suivre ma Commande
            </a>
        </div>

        <h3 class="text-2xl font-semibold mt-8">Nos Produits</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4">
            <?php foreach ($products as $product): ?>
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <h3 class="text-xl font-semibold"><?= htmlspecialchars($product['designation']) ?></h3>
                    <p class="text-gray-700"><?= $product['prix'] ?> €</p>
                    <p class="text-gray-500">Stock: <?= $product['quantite'] ?> disponibles</p>

                    <form action="../../controllers/CartController.php" method="POST" class="mt-4">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                        <input type="number" name="quantity" min="1" max="<?= $product['quantite'] ?>" value="1" class="w-full p-2 border rounded-md" required>
                        <button type="submit" name="add_to_cart" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                            Ajouter au Panier
                        </button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <?php include '../partials/footer.php'; ?>

</body>
</html>
