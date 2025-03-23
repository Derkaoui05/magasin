<?php
require_once '../../models/Product.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: ../auth/login.php");
    exit();
}

$productModel = new Product();
$products = $productModel->getAllProducts();
$userRole = $_SESSION['user']['role'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Produits</title>
</head>
<body>
    <h2>Liste des Produits</h2>

    <?php if ($userRole === 'admin'): ?>
        <a href="add_products.php">Ajouter un Produit</a>
    <?php endif; ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Référence</th>
            <th>Désignation</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Catégorie</th>
            <th>Date de Péremption</th>
            <?php if ($userRole === 'admin'): ?>
                <th>Actions</th>
            <?php endif; ?>
        </tr>
        <?php foreach ($products as $product): ?>
        <tr>
            <td><?= $product['id'] ?></td>
            <td><?= $product['reference'] ?></td>
            <td><?= $product['designation'] ?></td>
            <td><?= $product['prix'] ?> €</td>
            <td><?= $product['quantite'] ?></td>
            <td><?= $product['categorie'] ?></td>
            <td><?= $product['date_peremption'] ?></td>
            <?php if ($userRole === 'admin'): ?>
                <td>
                    <a href="edit_products.php?id=<?= $product['id'] ?>">Modifier</a>
                    <a href="../../controllers/ProductController.php?delete_id=<?= $product['id'] ?>" onclick="return confirm('Supprimer ce produit ?');">Supprimer</a>
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
