<?php
require_once '../../models/User.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

$userModel = new User();
$users = $userModel->getAllUsers();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Gestion des Utilisateurs</title>
</head>

<body>
    <h2>Liste des Utilisateurs</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['id'] ?></td>
                <td><?= htmlspecialchars($user['username']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td>
                    <a href="../../controllers/UserController.php?delete_id=<?= $user['id'] ?>" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a> ||
                    <a href="add_user.php">Ajouter</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>