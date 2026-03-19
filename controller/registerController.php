<?php
session_start();
require_once '../db.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $title = "Register Page";
    header("Location: ../views/register.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $password = $_POST['password'] ?? '';
    $repassword = $_POST['repassword'] ?? '';

    $err = false;

    // Regex check email
    $Email_Regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (!preg_match($Email_Regex, $email)) {
        $_SESSION['err_email'] = "Email không hợp lệ!!!";
        $err = true;
    } else {
        unset($_SESSION['err_email']);
    }

    // Regex check phone 
    $Phone_Regex = '/^\d{10}$/';
    if (!preg_match($Phone_Regex, $phone)) {
        $_SESSION['err_phone'] = "Số điện thoại không hợp lệ!!!";
        $err = true;
    } else {
        unset($_SESSION['err_phone']);
    }

    //Check repassword
    if ($password !== $repassword) {
        $_SESSION['err_repassword'] = "Mật khẩu không trùng khớp!!!";
        $err = true;
    } else {
        unset($_SESSION['err_repassword']);
    }

    if ($err) {
        header("Location: ../views/register.php");
        exit;
    }

    //Check user đã tồn tại chưa
    $sql = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone' LIMIT 1";
    $result = $conn->query($sql);
    $existingUser = $result->fetch_assoc();

    if ($existingUser) {
        $_SESSION['exist_user'] = "Người dùng đã tồn tại!!!";
        header("Location: ../views/register.php");
        exit;
    } else {
        $passwordMd5 = md5($password);
        $sql = "INSERT INTO users (name, email, phone, password, role) VALUES ('$name', '$email', '$phone', '$passwordMd5', 'user')";
        $conn->query($sql);

        $_SESSION['register_success'] = "Bạn đã đăng ký tài khoản thành công!";
        unset($_SESSION['exist_user']);

        header("Location: ../views/register.php");
        exit;
    }
}
?>
