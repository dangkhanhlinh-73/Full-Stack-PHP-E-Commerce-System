<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['orderId'])) {
        $orderId = $_POST['orderId'];
        
        if ($_POST['action'] === 'update_status' && isset($_POST['status'])) {
            $status = $conn->real_escape_string($_POST['status']);
            $sql = "UPDATE orders SET status = '$status' WHERE id = $orderId";
            if ($conn->query($sql)) {
                $_SESSION['order_success'] = "Cập nhật trạng thái thành công!";
            } else {
                $_SESSION['order_error'] = "Không thể cập nhật trạng thái!";
            }
        }
    }
    header("Location: ../views/adminorders.php");
    exit;
}

$totalOrders = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];

$pendingOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetch_row()[0];
$completedOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Complete'")->fetch_row()[0];
$cancelledOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Cancelled'")->fetch_row()[0];

$todayOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE DATE(created_at) = CURDATE()")->fetch_row()[0];

$todayRevenue = $conn->query("
    SELECT IFNULL(SUM(od.quantity * od.price), 0)
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    WHERE DATE(o.created_at) = CURDATE()
      AND o.status = 'Complete'
")->fetch_row()[0];

include('../impl/adminOrdersImpl.php');  

include('../views/adminorders.php');     
?>