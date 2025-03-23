<?php
require_once '../models/Product.php';
$productModel = new Product();
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Magasin Alimentaire</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <?php include 'partials/header.php'; ?>

    <!-- Main Section -->
    <main class="max-w-7xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-center my-8 text-gray-800">Nos Produits</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php foreach ($products as $product): ?>
                <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-xl transition-shadow">
                    <img src="path_to_image/<?= $product['image_url'] ?>" alt="<?= htmlspecialchars($product['designation']) ?>" class="w-full h-40 object-cover rounded-lg">
                    <h3 class="text-xl font-semibold mt-4"><?= htmlspecialchars($product['designation']) ?></h3>
                    <p class="text-gray-700"><?= $product['prix'] ?> €</p>
                    <p class="text-gray-500">Catégorie : <?= htmlspecialchars($product['categorie']) ?></p>
                    <p class="text-gray-500">Stock : <?= $product['quantite'] ?> disponibles</p>

                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'client'): ?>
                        <form action="../controllers/CartController.php" method="POST" class="mt-4">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            <label for="quantity" class="block text-sm text-gray-700">Quantité</label>
                            <input type="number" name="quantity" min="1" max="<?= $product['quantite'] ?>" value="1" class="w-full p-2 border border-gray-300 rounded-md mt-1" required>
                            <button type="submit" name="add_to_cart" class="mt-2 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors">Ajouter au Panier</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include 'partials/footer.php'; ?>

</body>
</html>
