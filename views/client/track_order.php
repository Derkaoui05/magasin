<?php
require_once '../../models/Commande.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'client') {
    header("Location: ../auth/login.php");
    exit();
}

$commandeModel = new Commande();
$commandes = $commandeModel->getClientCommandes($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Suivi de Commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <?php include '../partials/header.php'; ?>

    <main class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-6">
        <h2 class="text-3xl font-semibold text-center mb-6">Suivi de vos Commandes</h2>

        <?php if (empty($commandes)): ?>
            <p class="text-center text-gray-600">Vous n'avez pas encore de commande.</p>
        <?php else: ?>
            <table class="w-full border-collapse">
                <tr class="bg-gray-200">
                    <th class="p-3">Numéro de Commande</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Montant (€)</th>
                </tr>
                <?php foreach ($commandes as $commande): ?>
                <tr class="border-b">
                    <td class="p-3"><?= $commande['id'] ?></td>
                    <td class="p-3"><?= date("d/m/Y", strtotime($commande['created_at'])) ?></td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-lg text-white 
                            <?php if ($commande['status'] == 'En attente') echo 'bg-yellow-500';
                                  elseif ($commande['status'] == 'Expédiée') echo 'bg-blue-500';
                                  elseif ($commande['status'] == 'Livrée') echo 'bg-green-500'; ?>">
                            <?= htmlspecialchars($commande['status']) ?>
                        </span>
                    </td>
                    <td class="p-3"><?= number_format($commande['total_price'], 2) ?> €</td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </main>

    <?php include '../partials/footer.php'; ?>

</body>
</html>
