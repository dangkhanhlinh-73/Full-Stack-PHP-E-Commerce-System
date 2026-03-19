<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

$sql = "SELECT * FROM categories ORDER BY id";
$result = $conn->query($sql);
$listCategory = [];

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $listCategory[] = $row;
    }
}

include('../views/admincategory.php');
?>