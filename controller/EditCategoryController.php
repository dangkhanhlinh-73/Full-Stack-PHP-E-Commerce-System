<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "ID danh mục không hợp lệ!";
    header("Location: ../controller/AdminCategoryController.php");
    exit;
}

$id = (int)$_GET['id'];

$sql = "SELECT * FROM categories WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error'] = "Danh mục không tồn tại!";
    header("Location: ../controller/AdminCategoryController.php");
    exit;
}

$category = $result->fetch_assoc();
$stmt->close();

include('../views/edit-category.php');
?>