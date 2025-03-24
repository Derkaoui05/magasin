<?php
require_once '../models/Cart.php';
require_once '../models/Product.php';
session_start();

$productModel = new Product();

// ✅ Add Product to Cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Check if the product exists
    $product = $productModel->getProductById($productId);
    if ($product && $quantity > 0) {
        Cart::addToCart($productId, $quantity);
        header("Location: ../views/client/cart.php?success=added");
    } else {
        header("Location: ../views/client/cart.php?error=invalid_product");
    }
    exit();
}

// ✅ Remove Product from Cart
if (isset($_GET['remove_id'])) {
    Cart::removeFromCart($_GET['remove_id']);
    header("Location: ../views/client/cart.php?success=removed");
    exit();
}

// ✅ Clear Entire Cart
if (isset($_GET['clear_cart'])) {
    Cart::clearCart();
    header("Location: ../views/client/cart.php?success=cleared");
    exit();
}
?>
