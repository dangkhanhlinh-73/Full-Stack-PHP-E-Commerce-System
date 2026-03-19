<?php
@session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'clear_all') {
            $_SESSION['cart'] = [];
        } elseif ($_POST['action'] === 'delete' && isset($_POST['product_id'])) {
            $product_id = $_POST['product_id'];
            unset($_SESSION['cart'][$product_id]);
        } elseif ($_POST['action'] === 'update' && isset($_POST['product_id']) && isset($_POST['quantity'])) {
            // Cập nhật số lượng
            $product_id = $_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            if ($quantity > 0) {
                $_SESSION['cart'][$product_id]['quantity'] = $quantity;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
}

$cart = $_SESSION['cart'] ?? [];
?>
