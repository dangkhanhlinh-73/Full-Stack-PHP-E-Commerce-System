<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user_email = $conn->real_escape_string($_SESSION['user']['email']);
$user_phone = $conn->real_escape_string($_SESSION['user']['phone']);

$orders = [];
$sql = "SELECT * FROM orders WHERE email = '$user_email' OR phone = '$user_phone' ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        $order_id = $order['id'];
        $sql_details = "SELECT od.*, p.name, p.image FROM order_details od 
                       JOIN products p ON od.product_id = p.id 
                       WHERE od.order_id = $order_id";
        $details_result = $conn->query($sql_details);
        
        $orderItems = [];
        if ($details_result && $details_result->num_rows > 0) {
            while ($item = $details_result->fetch_assoc()) {
                $orderItems[] = [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                    'product' => [
                        'name' => $item['name'],
                        'image' => $item['image']
                    ]
                ];
            }
        }
        
        $orders[] = [
            'id' => $order['id'],
            'createdAt' => $order['created_at'],
            'status' => $order['status'],
            'shippingAddress' => $order['address'],
            'phone' => $order['phone'],
            'paymentMethod' => $order['payment_method'],
            'shippingFee' => 0,
            'totalAmount' => $order['total_amount'],
            'orderItems' => $orderItems
        ];
    }
}
?>
