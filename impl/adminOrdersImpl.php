<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

// LẤY FILTER TỪ URL (TẤT CẢ, pending, Complete, Cancelled)
$filter = $_GET['status'] ?? 'all';

$where = "";
$params = [];
$types = "";

if ($filter === 'pending') {
    $where = "WHERE status = ?";
    $params[] = 'pending';
    $types .= 's';
} elseif ($filter === 'Complete') {
    $where = "WHERE status = ?";
    $params[] = 'Complete';
    $types .= 's';
} elseif ($filter === 'Cancelled') {
    $where = "WHERE status = ?";
    $params[] = 'Cancelled';
    $types .= 's';
}

// QUERY LẤY ĐƠN HÀNG THEO FILTER
$sql = "SELECT * FROM orders $where ORDER BY created_at DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$orders = [];

if ($result && $result->num_rows > 0) {
    while ($order = $result->fetch_assoc()) {
        $order_id = $order['id'];
        
        // LẤY CHI TIẾT SẢN PHẨM (GIỮ NGUYÊN CODE CŨ CỦA BẠN)
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

$stmt->close();
?>