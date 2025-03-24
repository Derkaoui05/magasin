<form action="../../controllers/OrderController.php" method="POST">
    <input type="hidden" name="commande_id" value="<?= $commande['id'] ?>">
    <select name="status">
        <option value="En attente" <?= ($commande['status'] == 'En attente') ? 'selected' : '' ?>>En attente</option>
        <option value="Expédiée" <?= ($commande['status'] == 'Expédiée') ? 'selected' : '' ?>>Expédiée</option>
        <option value="Livrée" <?= ($commande['status'] == 'Livrée') ? 'selected' : '' ?>>Livrée</option>
    </select>
    <button type="submit" name="update_status" class="bg-blue-500 text-white px-3 py-1 rounded">Mettre à jour</button>
</form>
