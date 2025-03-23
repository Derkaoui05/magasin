<?php
require_once '../models/Product.php';
session_start();

// Vérifier si l'utilisateur est un admin ou un vendeur
if (!isset($_SESSION['user']) || ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['role'] !== 'vendeur')) {
    header("Location: ../views/auth/login.php");
    exit();
}

$productModel = new Product();

// Ajouter un produit (Admin et Vendeur)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $reference = trim($_POST['reference']);
    $designation = trim($_POST['designation']);
    $prix = trim($_POST['prix']);
    $quantite = trim($_POST['quantite']);
    $categorie = trim($_POST['categorie']);
    $date_peremption = trim($_POST['date_peremption']);

    // Gérer l'upload de l'image
    $image_url = ''; // Valeur par défaut si aucune image n'est téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Dossier de destination pour les images
        $target_dir = "../images/";  
        $target_file = $target_dir . basename($_FILES['image']['name']);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Vérifier si le fichier est une image réelle
        if (getimagesize($_FILES['image']['tmp_name']) === false) {
            echo "Le fichier n'est pas une image.";
            exit();
        }

        // Vérifier l'extension de l'image
        $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Seuls les fichiers JPG, PNG, JPEG, et GIF sont autorisés.";
            exit();
        }

        // Déplacer le fichier vers le dossier d'images
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image_url = 'images/' . basename($_FILES['image']['name']);  // Enregistrer le chemin relatif
        } else {
            echo "Erreur lors de l'upload de l'image.";
            exit();
        }
    }

    // Ajouter le produit dans la base de données
    if (!empty($reference) && !empty($designation) && !empty($prix) && !empty($quantite) && !empty($categorie)) {
        $productModel->addProduct($reference, $designation, $prix, $quantite, $categorie, $date_peremption, $image_url);
        header("Location: ../views/vendeur/list_products.php?success=added");
        exit();
    } else {
        header("Location: ../views/vendeur/add_product.php?error=empty_fields");
        exit();
    }
}
?>
