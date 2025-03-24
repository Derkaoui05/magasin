<?php
require_once '../../models/Cart.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'client') {
    header("Location: ../auth/login.php");
    exit();
}

$cartItems = Cart::getCartItems();
if (empty($cartItems)) {
    header("Location: cart.php?error=empty");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Validation de la Commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <?php include '../partials/header.php'; ?>

    <main class="max-w-4xl mx-auto p-6 mt-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Validation de la Commande</h2>

        <form action="../../controllers/OrderController.php" method="POST">
            <label>Adresse de Livraison :</label>
            <input type="text" name="address" class="w-full p-2 border rounded-md" required>

            <label>Mode de Paiement :</label>
            <select name="payment" class="w-full p-2 border rounded-md">
                <option value="cash">Paiement à la livraison</option>
                <option value="card">Carte Bancaire</option>
            </select>

            <button type="submit" name="place_order" class="mt-4 w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">Confirmer la Commande</button>
        </form>
    </main>

    <?php include '../partials/footer.php'; ?>

</body>
</html>
