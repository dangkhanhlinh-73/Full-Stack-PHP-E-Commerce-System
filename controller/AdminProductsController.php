<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'add') {
        $name       = trim($_POST['name']);
        $price      = (float)$_POST['price'];
        $quantity   = (int)$_POST['quantity'];
        $categoryId = (int)$_POST['categoryId'];
        $image      = $_POST['image'] ?? 'no-image.jpg'; 

        if (!empty($name) && $price > 0 && $quantity >= 0 && $categoryId > 0) {
            $sql = "INSERT INTO products (name, price, quantity, id_category, image) 
                    VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdiis", $name, $price, $quantity, $categoryId, $image);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Thêm sản phẩm '{$name}' thành công!";
            } else {
                $_SESSION['error'] = "Lỗi khi thêm sản phẩm!";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Vui lòng điền đầy đủ và hợp lệ!";
        }
    }
    
    elseif ($_POST['action'] === 'edit') {
        $id         = (int)$_POST['id'];
        $name       = trim($_POST['name']);
        $price      = (float)$_POST['price'];
        $quantity   = (int)$_POST['quantity'];
        $categoryId = (int)$_POST['categoryId'];
        // Giữ ảnh cũ nếu không chọn ảnh mới
        $image = !empty($_POST['image']) ? $_POST['image'] : (
            $conn->query("SELECT image FROM products WHERE id = $id")->fetch_assoc()['image'] ?? 'no-image.jpg'
        );

        if (!empty($name) && $price > 0 && $quantity >= 0 && $categoryId > 0 && $id > 0) {
            $sql = "UPDATE products 
                    SET name = ?, price = ?, quantity = ?, id_category = ?, image = ? 
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sdiisi", $name, $price, $quantity, $categoryId, $image, $id);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Cập nhật sản phẩm '{$name}' thành công!";
            } else {
                $_SESSION['error'] = "Lỗi khi cập nhật sản phẩm!";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Dữ liệu không hợp lệ!";
        }
    }
    
    elseif ($_POST['action'] === 'delete') {
        $id = (int)$_POST['id'];
        if ($id > 0) {
            // Optional: Xóa ảnh cũ nếu cần
            // $old = $conn->query("SELECT image FROM products WHERE id=$id")->fetch_assoc();
            // if ($old && file_exists("../assets/images/".$old['image'])) unlink(...);

            $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            $_SESSION['success'] = "Xóa sản phẩm thành công!";
        }
    }
    
    header("Location: AdminProductsController.php");
    exit;
}


$sql = "SELECT * FROM products ORDER BY id DESC";
$result = $conn->query($sql);
$listProduct = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$sql = "SELECT * FROM categories ORDER BY name";
$result = $conn->query($sql);
$listCategory = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$totalProducts = count($listProduct);
$totalCategories = count($listCategory);

$_SESSION['stats'] = $_SESSION['stats'] ?? [];
$_SESSION['stats']['products'] = $totalProducts;
$_SESSION['stats']['categories'] = $totalCategories;

include('../views/adminproducts.php');
?>