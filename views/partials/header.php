

<head>
    <title>Magasin</title>
    <!-- Ajout du CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<header class="bg-green-600 text-white p-4">
    <div class="flex justify-between items-center max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold">Magasin Alimentaire</h1>
        <nav>
            <ul class="flex space-x-6">
                <li><a href="home.php" class="hover:text-yellow-400">Accueil</a></li>
                <li><a href="products.php" class="hover:text-yellow-400">Produits</a></li>
                <li><a href="cart.php" class="hover:text-yellow-400">Panier (3)</a></li>
                <li><a href="orders.php" class="hover:text-yellow-400">Commandes</a></li>
                <?php if (isset($_SESSION['user'])): ?>
                    <li><a href="logout.php" class="hover:text-yellow-400">Déconnexion</a></li>
                <?php else: ?>
                    <li><a href="auth/login.php" class="hover:text-yellow-400">Connexion</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>

