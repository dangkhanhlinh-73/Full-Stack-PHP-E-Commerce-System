<?php
@session_start();
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $customer_name = $_POST['customer_name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    $city = $_POST['city'] ?? '';
    $ward = $_POST['ward'] ?? '';
    $notes = $_POST['notes'] ?? '';
    $shipping = $_POST['shipping'] ?? 'standard';
    $payment = $_POST['payment'] ?? 'cod';
    
    $fullAddress = $address . ', ' . $ward . ', ' . $city;
    
    $cart = $_SESSION['cart'] ?? [];
    
    if (empty($cart)) {
        $_SESSION['checkout_error'] = "Giỏ hàng trống!";
        header("Location: ../views/checkout.php");
        exit;
    }
    
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    
    // Tạo mã đơn hàng
    $order_code = 'DH' . date('YmdHis') . rand(100, 999);
    
    $sql = "INSERT INTO orders (order_code, customer_name, email, phone, address, total_amount, payment_method, status, created_at) 
            VALUES ('$order_code', '$customer_name', '$email', '$phone', '$fullAddress', $total, '$payment', 'pending', NOW())";
    
    if ($conn->query($sql)) {
        $order_id = $conn->insert_id;
        
        // Lưu chi tiết đơn hàng
        foreach ($cart as $item) {
            $product_id = $item['id'];
            $quantity = $item['quantity'];
            $price = $item['price'];
            $subtotal = $price * $quantity;
            
            $sql_detail = "INSERT INTO order_details (order_id, product_id, quantity, price, subtotal) 
                          VALUES ($order_id, $product_id, $quantity, $price, $subtotal)";
            $conn->query($sql_detail);
        }
        
        // Lưu thông tin cho trang order success
        $_SESSION['order_success'] = [
            'order_code' => $order_code,
            'order_date' => date('d/m/Y H:i'),
            'customer_name' => $customer_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $fullAddress,
            'notes' => $notes,
            'shipping_method' => $shipping,
            'payment_method' => $payment,
            'total_amount' => $total,
            'order_items' => $cart
        ];
        
        unset($_SESSION['cart']);
        
        header("Location: ../views/ordersuccess.php");
        exit;
    } else {
        $_SESSION['checkout_error'] = "Có lỗi xảy ra khi tạo đơn hàng!";
        header("Location: ../views/checkout.php");
        exit;
    }
} else {
    header("Location: ../views/checkout.php");
    exit;
}
?>