<?php
@session_start();

$order_success = $_SESSION['order_success'] ?? null;

if ($order_success) {
    $order_code = $order_success['order_code'];
    $order_date = $order_success['order_date'];
    $customer_name = $order_success['customer_name'];
    $email = $order_success['email'];
    $phone = $order_success['phone'];
    $address = $order_success['address'];
    $notes = $order_success['notes'];
    $shipping_method = $order_success['shipping_method'];
    $payment_method = $order_success['payment_method'];
    $total_amount = $order_success['total_amount'];
    $order_items = $order_success['order_items'];
    $order_status = 'Đang xử lý';
    $shipping_fee = 0;
    
    unset($_SESSION['order_success']);
}
?>
