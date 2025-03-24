<?php
require_once 'connection.php';

class Commande
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::Connect();
    }

    // Get all orders (commandes) for a specific client
    public function getClientCommandes($clientId)
    {
        $sql = "SELECT * FROM commandes WHERE client_id = :client_id ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['client_id' => $clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Count total commandes (orders)
    public function countCommandes()
    {
        $sql = "SELECT COUNT(*) as total FROM commandes";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Calculate total revenue from all commandes
    public function sumTotalRevenue()
    {
        $sql = "SELECT SUM(total) FROM commandes";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
