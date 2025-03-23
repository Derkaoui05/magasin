<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'client') {
    header("Location: ../auth/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mon Panier</title>
</head>
<body>
    <h2>Panier</h2>
    <form action="../../controllers/OrderController.php" method="POST">
        <label>Type de livraison :</label>
        <select name="livraison">
            <option value="domicile">À domicile</option>
            <option value="magasin">Retrait en magasin</option>
        </select>
        <label>Date de livraison :</label>
        <input type="date" name="date_livraison" required>
        <button type="submit" name="place_order">Passer Commande</button>
    </form>
</body>
</html>
