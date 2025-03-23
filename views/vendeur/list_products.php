<?php
require_once '../../models/Product.php';
session_start();

// Vérifier si l'utilisateur est un vendeur ou un admin
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'vendeur' && $_SESSION['user']['role'] !== 'admin')) {
    header("Location: ../auth/login.php");
    exit();
}

$productModel = new Product();
$products = $productModel->getAllProducts();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gérer les Produits</title>
</head>
<body>
    <h2>Liste des Produits</h2>
    <a href="add_product.php">Ajouter un Produit</a>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Référence</th>
            <th>Désignation</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['reference'] ?></td>
            <td><?= htmlspecialchars($product['designation']) ?></td>
            <td><?= $product['prix'] ?> €</td>
            <td><?= $product['quantite'] ?></td>
            <td><?= $product['categorie'] ?></td>
            <td>
                <a href="edit_product.php?id=<?= $product['id'] ?>">Modifier</a>
                <a href="../../controllers/ProductController.php?delete_id=<?= $product['id'] ?>" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
