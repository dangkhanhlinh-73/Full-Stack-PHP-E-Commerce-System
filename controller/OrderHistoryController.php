<?php
@session_start();
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cancel') {
    $orderId = $_POST['orderId'] ?? 0;
    $sql = "UPDATE orders SET status = 'cancelled' WHERE id = $orderId";
    if ($conn->query($sql)) {
        $_SESSION['order_success'] = "Đơn hàng đã được hủy thành công!";
    } else {
        $_SESSION['order_error'] = "Không thể hủy đơn hàng!";
    }
}

header("Location: ../views/order-history.php");
exit;
?>
