 <?php
@session_start();
require_once '../db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: ../views/login.php");
    exit;
}

// XỬ LÝ CẬP NHẬT TRẠNG THÁI
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && isset($_POST['orderId'])) {
        $orderId = (int)$_POST['orderId'];
        if ($_POST['action'] === 'update_status' && isset($_POST['status'])) {
            $status = $conn->real_escape_string($_POST['status']);
            $sql = "UPDATE orders SET status = '$status' WHERE id = $orderId";
            if ($conn->query($sql)) {
                $_SESSION['order_success'] = "Cập nhật trạng thái thành công!";
            } else {
                $_SESSION['order_error'] = "Không thể cập nhật trạng thái!";
            }
        }
    }
    header("Location: ../views/adminorders.php");
    exit;
}

/* ================= THỐNG KÊ CƠ BẢN ================= */
$totalOrders = $conn->query("SELECT COUNT(*) FROM orders")->fetch_row()[0];

$pendingOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetch_row()[0];
$completedOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Complete'")->fetch_row()[0];
$cancelledOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE status = 'Cancelled'")->fetch_row()[0];

$todayOrders = $conn->query("SELECT COUNT(*) FROM orders WHERE DATE(created_at) = CURDATE()")->fetch_row()[0];

$todayRevenue = $conn->query("
    SELECT IFNULL(SUM(od.quantity * od.price), 0)
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    WHERE DATE(o.created_at) = CURDATE() AND o.status = 'Complete'
")->fetch_row()[0];

/* ================= TỔNG DOANH THU TẤT CẢ THỜI GIAN ================= */
$totalAllTimeRevenue = $conn->query("
    SELECT IFNULL(SUM(od.quantity * od.price), 0)
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    WHERE o.status = 'Complete'
")->fetch_row()[0];

/* ================= DOANH THU THÁNG NÀY ================= */
$monthRevenue = $conn->query("
    SELECT IFNULL(SUM(od.quantity * od.price), 0)
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    WHERE YEAR(o.created_at) = YEAR(CURDATE())
      AND MONTH(o.created_at) = MONTH(CURDATE())
      AND o.status = 'Complete'
")->fetch_row()[0];

/* ================= DOANH THU 7 NGÀY GẦN NHẤT ================= */
$revenue7DaysQuery = $conn->query("
    SELECT DATE(o.created_at) AS order_date,
           IFNULL(SUM(od.quantity * od.price), 0) AS revenue
    FROM orders o
    LEFT JOIN order_details od ON o.id = od.order_id
    WHERE o.created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
      AND o.status = 'Complete'
    GROUP BY DATE(o.created_at)
    ORDER BY order_date ASC
");

$revenueData = [];
$maxRevenue = 1;
while ($row = $revenue7DaysQuery->fetch_assoc()) {
    $revenueData[$row['order_date']] = $row['revenue'];
    $maxRevenue = max($maxRevenue, $row['revenue']);
}

$revenue7Days = [];
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days"));
    $label = date('d/m', strtotime("-$i days"));
    $revenue = $revenueData[$date] ?? 0;
    $height = $maxRevenue > 0 ? ($revenue / $maxRevenue * 100) : 0;

    $revenue7Days[] = [
        'label'   => $label,
        'revenue' => $revenue,
        'height'  => $height
    ];
}

/* ================= LẤY DANH SÁCH ĐƠN HÀNG ================= */
include('../impl/adminOrdersImpl.php');
?>

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-5 text-center fw-bold" style="color: #ad1457;">
                <i class="fas fa-receipt me-3"></i>Quản Lý Đơn Hàng
            </h2>

            <!-- PHẦN THỐNG KÊ CƠ BẢN -->
            <div class="row g-4 mb-5">
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #fdf6f9, #fff);">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-clipboard-list fa-2x text-danger mb-3"></i>
                            <p class="text-muted fw-bold mb-1">Tổng đơn hàng</p>
                            <h3 class="fw-bold text-danger"><?= number_format($totalOrders) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #e3f2fd, #fff);">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-calendar-day fa-2x text-primary mb-3"></i>
                            <p class="text-muted fw-bold mb-1">Đơn hôm nay</p>
                            <h3 class="fw-bold text-primary"><?= number_format($todayOrders) ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #fff3cd, #fff);">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-hourglass-half fa-2x text-warning mb-3"></i>
                            <p class="text-muted fw-bold mb-1">Đang chờ</p>
                            <h3 class="fw-bold text-warning"><?= $pendingOrders ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #d1e7dd, #fff);">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-check-double fa-2x text-success mb-3"></i>
                            <p class="text-muted fw-bold mb-1">Hoàn thành</p>
                            <h3 class="fw-bold text-success"><?= $completedOrders ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #f8d7da, #fff);">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-ban fa-2x text-danger mb-3"></i>
                            <p class="text-muted fw-bold mb-1">Đã huỷ</p>
                            <h3 class="fw-bold text-danger"><?= $cancelledOrders ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-6">
                    <div class="card border-0 shadow-sm h-100 rounded-4" style="background: linear-gradient(135deg, #ca1874ff, #fff);">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-money-bill-wave fa-2x text-success mb-3"></i>
                            <p class="text-muted fw-bold mb-1">Doanh thu hôm nay</p>
                            <h3 class="fw-bold text-success"><?= number_format($todayRevenue) ?> đ</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TỔNG DOANH THU & BIỂU ĐỒ 7 NGÀY --->
            <div class="row mb-5">
                <div class="col-md-5">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="card border-0 shadow-lg text-white h-100 rounded-4" style="background: linear-gradient(135deg, #e91e63, #ad1457);">
                                <div class="card-body text-center p-5">
                                    <i class="fas fa-trophy fa-4x mb-4 opacity-75"></i>
                                    <h4 class="fw-bold mb-3">Tổng doanh thu tất cả thời gian</h4>
                                    <h2 class="display-4 fw-bold"><?= number_format($totalAllTimeRevenue) ?> đ</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card border-0 shadow-lg text-white h-100 rounded-4" style="background: linear-gradient(135deg, #ad1457, #c2185b);">
                                <div class="card-body text-center p-5">
                                    <i class="fas fa-calendar-alt fa-4x mb-4 opacity-75"></i>
                                    <h4 class="fw-bold mb-3">Doanh thu tháng <?= date('m/Y') ?></h4>
                                    <h2 class="display-4 fw-bold"><?= number_format($monthRevenue) ?> đ</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card border-0 shadow-lg h-100 rounded-4" style="background: linear-gradient(135deg, #ec3081ff, #fff);">
                        <div class="card-body p-5">
                            <h4 class="fw-bold text-primary text-center mb-5">Doanh thu 7 ngày gần nhất</h4>
                            <div class="d-flex justify-content-around align-items-end h-100 pb-4">
                                <?php foreach ($revenue7Days as $day): ?>
                                    <div class="text-center position-relative flex-fill">
                                        <div class="position-relative d-inline-block mx-auto">
                                            <div class="rounded-pill shadow-lg"
                                                 style="width: 80px; height: <?= $day['height'] ?>%; min-height: 70px; background: linear-gradient(to top, #ad1457, #e91e63); transition: all 0.5s ease; box-shadow: 0 10px 25px rgba(0,0,0,0.15);"
                                                 onmouseover="this.style.transform='scale(1.2)'; this.style.boxShadow='0 25px 50px rgba(233,30,99,0.5)'"
                                                 onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.15)'">
                                            </div>
                                            <?php if ($day['revenue'] > 0): ?>
                                                <span class="position-absolute text-white fw-bold"
                                                      style="top: -40px; left: 50%; transform: translateX(-50%); font-size: 1.1rem; text-shadow: 2px 2px 5px rgba(0,0,0,0.6); white-space: nowrap;">
                                                    <?= number_format($day['revenue']) ?> đ
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <p class="mt-5 mb-0 fw-bold text-success fs-4"><?= number_format($day['revenue']) ?> đ</p>
                                        <p class="text-muted fw-bold"><?= $day['label'] ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NÚT LỌC TRẠNG THÁI - ĐẸP HƠN -->
            <div class="text-center mb-5">
                <div class="btn-group shadow-lg rounded-pill overflow-hidden" role="group">
                    <a href="../views/adminorders.php?status=all" class="btn btn-lg px-5 py-3 <?= ($_GET['status'] ?? 'all') === 'all' ? 'btn-primary' : 'btn-outline-primary' ?>">Tất cả</a>
                    <a href="../views/adminorders.php?status=pending" class="btn btn-lg px-5 py-3 <?= ($_GET['status'] ?? '') === 'pending' ? 'btn-warning text-dark' : 'btn-outline-warning' ?>">Pending</a>
                    <a href="../views/adminorders.php?status=Complete" class="btn btn-lg px-5 py-3 <?= ($_GET['status'] ?? '') === 'Complete' ? 'btn-success' : 'btn-outline-success' ?>">Complete</a>
                    <a href="../views/adminorders.php?status=Cancelled" class="btn btn-lg px-5 py-3 <?= ($_GET['status'] ?? '') === 'Cancelled' ? 'btn-danger' : 'btn-outline-danger' ?>">Cancelled</a>
                </div>
            </div>

            <!-- Alert thông báo -->
            <?php if (!empty($_SESSION['order_success'])): ?>
                <div class="alert alert-success alert-dismissible fade show shadow-sm mb-4">
                    <i class="fas fa-check-circle me-2"></i><?= $_SESSION['order_success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['order_success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['order_error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show shadow-sm mb-4">
                    <i class="fas fa-exclamation-triangle me-2"></i><?= $_SESSION['order_error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['order_error']); ?>
            <?php endif; ?>

            <!-- Danh sách đơn hàng -->
            <?php if (empty($orders)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-shopping-bag text-muted" style="font-size: 5rem;"></i>
                    <h4 class="text-muted mt-4">Chưa có đơn hàng nào</h4>
                </div>
            <?php endif; ?>

            <?php foreach ($orders as $order): ?>
                <div class="card mb-4 shadow-sm border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(45deg, #e91e63, #ad1457); color: white; border-radius: 20px 20px 0 0;">
                        <div>
                            <h5 class="mb-0">Đơn hàng #<?= $order['id'] ?></h5>
                            <small><?= date("d/m/Y H:i", strtotime($order['createdAt'])) ?></small>
                        </div>
                        <span class="badge fs-6 px-4 py-2 rounded-pill" style="
                            background: <?= ($order['status'] === 'pending') ? '#ffc107' : (($order['status'] === 'Complete') ? '#28a745' : '#dc3545') ?>;
                            color: <?= ($order['status'] === 'pending') ? '#212529' : 'white' ?>;
                        ">
                            <?= ucfirst($order['status']) ?>
                        </span>
                    </div>
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="text-primary fw-bold mb-3">Sản phẩm:</h6>
                                <?php foreach ($order['orderItems'] as $item): ?>
                                    <div class="d-flex align-items-center mb-3 p-3 bg-light rounded">
                                        <img src="../assets/images/<?= $item['product']['image'] ?>" class="rounded me-4" width="80" height="80" style="object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-bold"><?= htmlspecialchars($item['product']['name']) ?></h6>
                                            <small class="text-muted">
                                                Số lượng: <?= $item['quantity'] ?> × <?= number_format($item['price'], 0, ',', '.') ?> ₫
                                            </small>
                                        </div>
                                        <div class="text-end fw-bold text-primary fs-5">
                                            <?= number_format($item['subtotal'], 0, ',', '.') ?> ₫
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="col-md-4">
                                <div class="p-4 bg-light rounded-3 border">
                                    <h6 class="text-primary fw-bold mb-3">Thông tin giao hàng</h6>
                                    <p class="mb-2"><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['shippingAddress']) ?></p>
                                    <p class="mb-2"><strong>SĐT:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                                    <p class="mb-3"><strong>Thanh toán:</strong> <?= ucfirst($order['paymentMethod']) ?></p>
                                    <hr>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Phí ship:</span>
                                        <span><?= number_format($order['shippingFee'], 0, ',', '.') ?> ₫</span>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold fs-4 text-primary">
                                        <span>Tổng cộng:</span>
                                        <span><?= number_format($order['totalAmount'], 0, ',', '.') ?> ₫</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="text-center mt-5">
                <a href="../views/admindashboard.php" class="btn btn-lg px-5 shadow rounded-pill" style="background: linear-gradient(45deg, #e91e63, #ad1457); border: none;">
                    <i class="fas fa-arrow-left me-2"></i> Quay Lại Dashboard
                </a>
            </div>
        </div>
    </div>
</div>