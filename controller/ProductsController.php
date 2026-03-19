<?php
@session_start();
require_once '../db.php';
require_once '../model/Category.php';

$user = $_SESSION['user'] ?? null;


$categoryObj = new Category($conn);
$listCategory = $categoryObj->getAllCategories();


function getAllProducts($conn) {
    $sql = "SELECT * FROM products ORDER BY id";
    $result = $conn->query($sql);
    $products = [];
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    return $products;
}

function getProductsByCategory($conn, $category_id) {
    $sql = "SELECT * FROM products WHERE id_category = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    $stmt->close();
    return $products;
}

function searchProducts($conn, $search) {
    $sql = "SELECT * FROM products WHERE name LIKE ? ORDER BY id";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$search%";
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    $stmt->close();
    return $products;
}

$category_id = $_GET['category'] ?? null;
$search = $_GET['search'] ?? null;

if ($search) {
    $listProduct = searchProducts($conn, $search);
} elseif ($category_id) {
    $listProduct = getProductsByCategory($conn, $category_id);
} else {
    $listProduct = getAllProducts($conn);
}

include('../views/products.php');
?>