<form action="../../controllers/UserController.php" method="POST">
    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" required>

    <label>Mot de passe :</label>
    <input type="password" name="password" required>

    <label>Rôle :</label>
    <select name="role">
        <option value="vendeur">Vendeur</option>
        <option value="admin">Administrateur</option>
    </select>

    <button type="submit" name="add_user">Ajouter</button>
</form>
