<?php
require_once 'connection.php';

class Product {
    private $pdo;

    public function __construct() {
        $this->pdo = Connection::Connect();
    }

    // Ajouter un produit
    public function addProduct($reference, $designation, $prix, $quantite, $categorie, $date_peremption, $image_url) {
        $sql = "INSERT INTO produits (reference, designation, prix, quantite, categorie, date_peremption, image_url) 
                VALUES (:reference, :designation, :prix, :quantite, :categorie, :date_peremption, :image_url)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'reference' => $reference,
            'designation' => $designation,
            'prix' => $prix,
            'quantite' => $quantite,
            'categorie' => $categorie,
            'date_peremption' => $date_peremption,
            'image_url' => $image_url
        ]);
    }

    // Modifier un produit
    public function updateProduct($id, $reference, $designation, $prix, $quantite, $categorie, $date_peremption, $image_url) {
        $sql = "UPDATE produits SET reference = :reference, designation = :designation, prix = :prix, quantite = :quantite, 
                categorie = :categorie, date_peremption = :date_peremption, image_url = :image_url WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'reference' => $reference,
            'designation' => $designation,
            'prix' => $prix,
            'quantite' => $quantite,
            'categorie' => $categorie,
            'date_peremption' => $date_peremption,
            'image_url' => $image_url
        ]);
    }

    // Supprimer un produit
    public function deleteProduct($id) {
        $sql = "DELETE FROM produits WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    // Récupérer tous les produits
    public function getAllProducts() {
        $sql = "SELECT * FROM produits";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un produit par ID
    public function getProductById($id) {
        $sql = "SELECT * FROM produits WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
