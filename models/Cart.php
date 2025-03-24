<?php
class Cart {
    public static function addToCart($productId, $quantity) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] += $quantity; // Increase quantity if item already exists
        } else {
            $_SESSION['cart'][$productId] = $quantity;
        }
    }

    public static function removeFromCart($productId) {
        if (isset($_SESSION['cart'][$productId])) {
            unset($_SESSION['cart'][$productId]);
        }
    }

    public static function clearCart() {
        unset($_SESSION['cart']);
    }

    public static function getCartItems() {
        return $_SESSION['cart'] ?? [];
    }
}
?>
