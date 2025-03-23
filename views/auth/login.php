<?php
session_start();
if (isset($_SESSION['user'])) {
    // Redirige vers le bon dashboard selon le rôle
    $role = $_SESSION['user']['role'];
    if ($role === 'admin') {
        header("Location: ../admin/dashboard.php");
    } elseif ($role === 'vendeur') {
        header("Location: ../vendeur/dashboard.php");
    } elseif ($role === 'client') {
        header("Location: ../client/dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>

    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;">
            <?php
            if ($_GET['error'] === 'invalid') echo "Nom d'utilisateur ou mot de passe incorrect.";
            elseif ($_GET['error'] === 'empty_fields') echo "Veuillez remplir tous les champs.";
            ?>
        </p>
    <?php endif; ?>

    <form action="../../controllers/AuthController.php" method="POST">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required>

        <label>Mot de passe :</label>
        <input type="password" name="password" required>

        <button type="submit" name="login">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
</body>
</html>
