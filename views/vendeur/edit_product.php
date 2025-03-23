<?php
require_once '../../models/Product.php';
session_start();

// Vérifier si l'utilisateur est un admin ou un vendeur
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'vendeur')) {
    header("Location: ../auth/login.php");
    exit();
}

$productModel = new Product();

// Vérifier si un ID de produit est passé en paramètre
if (!isset($_GET['id'])) {
    header("Location: list_products.php?error=missing_id");
    exit();
}

// Récupérer le produit depuis la base de données
$product = $productModel->getProductById($_GET['id']);
if (!$product) {
    header("Location: list_products.php?error=not_found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier un Produit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Header -->
    <?php include '../partials/header.php'; ?>

    <div class="max-w-4xl mx-auto p-6 mt-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Modifier le Produit</h2>

        <!-- Formulaire de modification de produit -->
        <form action="../../controllers/ProductController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">

            <div class="mb-4">
                <label for="reference" class="block text-sm font-medium text-gray-700">Référence :</label>
                <input type="text" id="reference" name="reference" value="<?= htmlspecialchars($product['reference']) ?>" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="designation" class="block text-sm font-medium text-gray-700">Désignation :</label>
                <input type="text" id="designation" name="designation" value="<?= htmlspecialchars($product['designation']) ?>" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="prix" class="block text-sm font-medium text-gray-700">Prix (€) :</label>
                <input type="number" id="prix" name="prix" value="<?= $product['prix'] ?>" step="0.01" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité :</label>
                <input type="number" id="quantite" name="quantite" value="<?= $product['quantite'] ?>" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie :</label>
                <input type="text" id="categorie" name="categorie" value="<?= htmlspecialchars($product['categorie']) ?>" class="w-full p-2 border border-gray-300 rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="date_peremption" class="block text-sm font-medium text-gray-700">Date de Péremption :</label>
                <input type="date" id="date_peremption" name="date_peremption" value="<?= $product['date_peremption'] ?>" class="w-full p-2 border border-gray-300 rounded-md">
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Image du Produit :</label>
                <input type="file" id="image" name="image" accept="image/*" class="w-full p-2 border border-gray-300 rounded-md">
                <?php if ($product['image_url']): ?>
                    <img src="../<?= $product['image_url'] ?>" alt="Image du produit" class="mt-2 w-32 h-32 object-cover">
                <?php endif; ?>
            </div>

            <button type="submit" name="edit_product" class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Mettre à jour le produit</button>
        </form>
    </div>

    <!-- Footer -->
    <?php include '../partials/footer.php'; ?>

</body>
</html>
