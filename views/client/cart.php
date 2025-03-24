<?php
require_once '../../models/Cart.php';
require_once '../../models/Product.php';
session_start();

$productModel = new Product();
$cartItems = Cart::getCartItems();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Panier</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <?php include '../partials/header.php'; ?>

    <main class="max-w-4xl mx-auto p-6 mt-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Votre Panier</h2>

        <?php if (empty($cartItems)): ?>
            <p class="text-center text-gray-600">Votre panier est vide.</p>
        <?php else: ?>
            <table class="w-full border-collapse">
                <tr class="bg-gray-200">
                    <th class="p-2">Produit</th>
                    <th class="p-2">Quantité</th>
                    <th class="p-2">Prix</th>
                    <th class="p-2">Actions</th>
                </tr>
                <?php 
                $total = 0;
                foreach ($cartItems as $productId => $quantity): 
                    $product = $productModel->getProductById($productId);
                    if ($product):
                        $subtotal = $product['prix'] * $quantity;
                        $total += $subtotal;
                ?>
                <tr class="border-b">
                    <td class="p-2"><?= htmlspecialchars($product['designation']) ?></td>
                    <td class="p-2"><?= $quantity ?></td>
                    <td class="p-2"><?= number_format($subtotal, 2) ?> €</td>
                    <td class="p-2">
                        <a href="../../controllers/CartController.php?remove_id=<?= $productId ?>" class="text-red-500">Retirer</a>
                    </td>
                </tr>
                <?php endif; endforeach; ?>
            </table>

            <p class="text-right font-semibold mt-4">Total : <?= number_format($total, 2) ?> €</p>

            <div class="mt-6 flex justify-between">
                <a href="../../controllers/CartController.php?clear_cart=true" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Vider le Panier</a>
                <a href="checkout.php" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Passer la Commande</a>
            </div>
        <?php endif; ?>
    </main>

    <?php include '../partials/footer.php'; ?>

</body>
</html>
