<?php
require_once 'connection.php';

class Order {
    private $pdo;

    public function __construct() {
        $this->pdo = Connection::Connect();
    }

    // Passer une commande
    public function placeOrder($clientId, $livraison, $dateLivraison) {
        $sql = "INSERT INTO commandes (client_id, date_commande, statut, total, livraison, date_livraison) 
                VALUES (:client_id, NOW(), 'en attente', 0, :livraison, :date_livraison)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'client_id' => $clientId,
            'livraison' => $livraison,
            'date_livraison' => $dateLivraison
        ]);

        return $this->pdo->lastInsertId(); // Retourne l'ID de la commande
    }

    // Ajouter un produit à une commande
    public function addProductToOrder($commandeId, $produitId, $quantite, $prixUnitaire) {
        $sql = "INSERT INTO commandes_produits (commande_id, produit_id, quantite, prix_unitaire) 
                VALUES (:commande_id, :produit_id, :quantite, :prix_unitaire)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'commande_id' => $commandeId,
            'produit_id' => $produitId,
            'quantite' => $quantite,
            'prix_unitaire' => $prixUnitaire
        ]);
    }

    // Mettre à jour le total de la commande
    public function updateOrderTotal($commandeId) {
        $sql = "UPDATE commandes 
                SET total = (SELECT SUM(quantite * prix_unitaire) FROM commandes_produits WHERE commande_id = :commande_id) 
                WHERE id = :commande_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['commande_id' => $commandeId]);
    }

    // Récupérer les commandes d'un client
    public function getOrdersByClient($clientId) {
        $sql = "SELECT * FROM commandes WHERE client_id = :client_id ORDER BY date_commande DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['client_id' => $clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une commande spécifique avec ses produits
    public function getOrderDetails($commandeId) {
        $sql = "SELECT c.*, p.designation, cp.quantite, cp.prix_unitaire
                FROM commandes c
                JOIN commandes_produits cp ON c.id = cp.commande_id
                JOIN produits p ON cp.produit_id = p.id
                WHERE c.id = :commande_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['commande_id' => $commandeId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour le statut d'une commande (Expédiée, Livrée)
    public function updateOrderStatus($commandeId, $statut) {
        $sql = "UPDATE commandes SET statut = :statut WHERE id = :commande_id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            'statut' => $statut,
            'commande_id' => $commandeId
        ]);
    }
}
?>
