<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un Produit</title>
</head>
<body>
    <h2>Ajouter un Produit</h2>

    <form action="../../controllers/ProductController.php" method="POST" enctype="multipart/form-data">
        <label>Référence :</label>
        <input type="text" name="reference" required>

        <label>Désignation :</label>
        <input type="text" name="designation" required>

        <label>Prix :</label>
        <input type="number" step="0.01" name="prix" required>

        <label>Quantité :</label>
        <input type="number" name="quantite" required>

        <label>Catégorie :</label>
        <input type="text" name="categorie" required>

        <label>Date de Péremption :</label>
        <input type="date" name="date_peremption">

        <label>Image du Produit :</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" name="add_product">Ajouter</button>
    </form>

    <a href="list_products.php">Retour à la liste</a>
</body>
</html>
