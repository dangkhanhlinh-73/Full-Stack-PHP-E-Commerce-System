<?php
@session_start();
require_once __DIR__ . '/../../db.php';

// Kiểm tra quyền admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

// Thống kê đơn hàng
$totalOrders     = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];

$pendingOrders   = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetch_row()[0];
$completedOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Complete'")->fetch_row()[0];
$cancelledOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Cancelled'")->fetch_row()[0];

$todayOrders     = $conn->query("SELECT COUNT(*) FROM orders WHERE DATE(created_at) = CURDATE()")->fetch_row()[0];

$todayRevenue = $conn->query("
    SELECT IFNULL(SUM(od.quantity * od.price), 0)
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    WHERE DATE(o.created_at) = CURDATE()
      AND o.status = 'Complete'
")->fetch_row()[0];

function renderCard($icon, $title, $text, $link)
{
    echo '
    <div class="col-lg-3 col-md-6">
        <div class="card admin-card h-100">
            <div class="card-body text-center p-5">

                <div class="card-icon mb-4"
                    style="
                        width: 80px; height: 80px; border-radius: 50%;
                        background: linear-gradient(45deg, #e91e63, #ad1457);
                        display: flex; align-items: center; justify-content: center;
                        color: white; font-size: 2.5rem; margin: 0 auto;">
                    <i class="' . $icon . '"></i>
                </div>

                <h4 class="card-title" style="color: #ad1457;">' . $title . '</h4>
                <p class="card-text text-muted">' . $text . '</p>

                <a href="' . $link . '" 
                   class="btn btn-primary truycap-btn w-100">
                    Truy Cập
                </a>

            </div>
        </div>
    </div>';
}
?>

<style>
    .admin-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .admin-card .card-body {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .truycap-btn {
        margin-top: auto !important;
        max-width: 150px;
        margin-left: auto !important;
        margin-right: auto !important;
        display: block;
    }

    .admin-card {
        min-height: 480px;
        border-radius: 20px;
        border: 1px solid #f3c0d1;
        transition: 0.25s;
    }

    .admin-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    /* THỐNG KÊ TRONG CARD ĐƠN HÀNG - THẲNG HÀNG ĐẸP */
    .stat-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid #f0d0e0;
    }

    .stat-row:last-child {
        border-bottom: none;
    }

    .stat-label {
        font-weight: 600;
        color: #6c757d;
        font-size: 1.1rem;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
    }

    .stat-badge {
        font-size: 1.8rem !important;
        font-weight: 700 !important;
        padding: 0.5rem 1.2rem !important;
        border-radius: 50px;
        min-width: 80px;
    }
</style>

<section class="py-5" style="background: white; min-height: 80vh;">
    <div class="container">

        <div class="row justify-content-center mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold" style="color: #ad1457;">Admin Dashboard</h1>
                <p class="lead" style="color: #880e4f;">Quản lý hệ thống thương hiệu HAPAS</p>
            </div>
        </div>

        <div class="row justify-content-center g-4">

            <?php 
                renderCard("fas fa-users", "Quản Lý Người Dùng", "Quản lý thông tin khách hàng, tài khoản và phân quyền hệ thống", "../controller/AdminUserController.php");
                renderCard("fas fa-tags", "Quản Lý Danh Mục", "Tạo, chỉnh sửa và quản lý danh mục sản phẩm", "../controller/AdminCategoryController.php");
                renderCard("fas fa-shopping-bag", "Quản Lý Sản Phẩm", "Thêm, sửa, xóa sản phẩm và quản lý kho hàng", "../controller/AdminProductsController.php");
            ?>

            <!-- CARD ĐƠN HÀNG - THỐNG KÊ THẲNG HÀNG ĐẸP -->
            <div class="col-lg-3 col-md-6">
                <div class="card admin-card h-100">
                    <div class="card-body text-center p-5">

                        <div class="card-icon mb-4"
                            style="
                                width: 80px; height: 80px; border-radius: 50%;
                                background: linear-gradient(45deg, #e91e63, #ad1457);
                                display: flex; align-items: center; justify-content: center;
                                color: white; font-size: 2.5rem; margin: 0 auto;">
                            <i class="fas fa-receipt"></i>
                        </div>

                        <h4 class="card-title" style="color: #ad1457;">Quản Lý Đơn Hàng</h4>
                        <p class="card-text text-muted mb-4">Theo dõi, xử lý và cập nhật đơn hàng</p>

                        <!-- Thống kê thẳng hàng đẹp -->
                        <div class="bg-white rounded-3 p-4 mb-4 border">
                            <div class="stat-row">
                                <span class="stat-label">Tổng đơn</span>
                                <span class="stat-value text-danger"><?= number_format($totalOrders) ?></span>
                            </div>

                            <div class="stat-row">
                                <span class="stat-label">Đơn hôm nay</span>
                                <span class="stat-value text-primary"><?= number_format($todayOrders) ?></span>
                            </div>

                            <div class="stat-row">
                                <span class="stat-label">Đang chờ</span>
                                <div class="badge bg-warning text-dark stat-badge"><?= $pendingOrders ?></div>
                            </div>

                            <div class="stat-row">
                                <span class="stat-label">Hoàn thành</span>
                                <div class="badge bg-success stat-badge"><?= $completedOrders ?></div>
                            </div>

                            <div class="stat-row">
                                <span class="stat-label">Đã huỷ</span>
                                <div class="badge bg-danger stat-badge"><?= $cancelledOrders ?></div>
                            </div>

                            <hr class="my-4">

                            <div class="stat-row">
                                <span class="stat-label">Doanh thu hôm nay</span>
                                <span class="stat-value text-success"><?= number_format($todayRevenue) ?> đ</span>
                            </div>
                        </div>

                        <a href="../controller/AdminOrdersController.php"
                           class="btn btn-primary truycap-btn w-100">
                            Truy Cập
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>