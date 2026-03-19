<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

$sql = "SELECT * FROM categories ORDER BY name";
$result = $conn->query($sql);
$categories = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

include('../views/add-products.php');
?>