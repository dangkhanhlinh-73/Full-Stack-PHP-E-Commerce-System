<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "ID sản phẩm không hợp lệ!";
    header("Location: ../controller/AdminProductsController.php");
    exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Sản phẩm không tồn tại!";
    header("Location: ../controller/AdminProductsController.php");
    exit;
}

$product = $result->fetch_assoc();
$stmt->close();

$sql = "SELECT * FROM categories ORDER BY name";
$result = $conn->query($sql);
$categories = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

include('../views/edit_products.php');
?>