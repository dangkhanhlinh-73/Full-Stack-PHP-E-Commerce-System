<?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'add') {
        $name = trim($_POST['name']);
        
        if (!empty($name)) {
            // Kiểm tra danh mục đã tồn tại chưa
            $checkSql = "SELECT id FROM categories WHERE name = ?";
            $checkStmt = $conn->prepare($checkSql);
            $checkStmt->bind_param("s", $name);
            $checkStmt->execute();
            $result = $checkStmt->get_result();
            
            if ($result->num_rows > 0) {
                $_SESSION['error'] = "Danh mục này đã tồn tại!";
            } else {
                // Thêm danh mục mới
                $sql = "INSERT INTO categories (name) VALUES (?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $name);
                
                if ($stmt->execute()) {
                    $_SESSION['success'] = "Thêm danh mục thành công!";
                } else {
                    $_SESSION['error'] = "Có lỗi xảy ra khi thêm danh mục!";
                }
                $stmt->close();
            }
            $checkStmt->close();
        } else {
            $_SESSION['error'] = "Tên danh mục không được để trống!";
        }
    }
    
    elseif ($_POST['action'] === 'edit') {
        $id = (int)$_POST['id'];
        $name = trim($_POST['name']);
        
        if (!empty($name) && $id > 0) {
            $sql = "UPDATE categories SET name = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("si", $name, $id);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Cập nhật danh mục thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi cập nhật danh mục!";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Dữ liệu không hợp lệ!";
        }
    }
    
    elseif ($_POST['action'] === 'delete') {
        $id = (int)$_POST['id'];
        
        if ($id > 0) {
            $sql = "DELETE FROM categories WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            
            if ($stmt->execute()) {
                $_SESSION['success'] = "Xóa danh mục thành công!";
            } else {
                $_SESSION['error'] = "Có lỗi xảy ra khi xóa danh mục!";
            }
            $stmt->close();
        }
    }
}

header("Location: ../controller/AdminCategoryController.php");
exit;
?>