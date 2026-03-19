<?php 
@session_start();
?>

<div class="logo-fixed">
    <img src="../assets/images/logo_hapas.png" alt="HAPAS" class="fixed-logo-img">
</div>

<!-- Header -->
<header class="header-top text-white py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <small><i class="fas fa-phone"></i> Hotline: 1900-1234</small>
                <small class="ms-3"><i class="fas fa-envelope"></i> bag@hapas.com</small>
            </div>
            <div class="col-md-6 text-end">
                <small><i class="fas fa-truck"></i> Miễn phí vận chuyển đơn từ 500k</small>
            </div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="fas fa-shopping-bag"></i> HAPAS
        </a>

        <input type="checkbox" id="navbar-toggle" class="navbar-toggle-checkbox">
        <label for="navbar-toggle" class="navbar-toggler">
            <span class="navbar-toggler-icon"></span>
        </label>

        <div class="navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="../views/home.php">Trang Chủ</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../controller/ProductsController.php">Sản Phẩm</a>
                </li>

                <?php if (!empty($_SESSION['user'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                Hi, Admin
                            <?php else: ?>
                                Hi, <?= $_SESSION['user']['name'] ?>
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="../views/admindashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                <li><a class="dropdown-item" href="../controller/AdminProfileController.php"><i class="fas fa-user"></i> Profile</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="../controller/UserProfileController.php"><i class="fas fa-user"></i> Profile</a></li>
                            <?php endif; ?>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="../controller/logoutController.php"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a></li>
                        </ul>
                    </li>

                <?php else: ?>

                    <li class="nav-item">
                        <a class="nav-link" href="../views/register.php">Đăng Ký</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../views/login.php">Đăng Nhập</a>
                    </li>

                <?php endif; ?>

            </ul>

            <!-- Search products-->
            <div class="d-flex align-items-center">
                <form class="d-flex me-3" method="GET" action="../controller/ProductsController.php">
                    <input class="form-control me-2" type="search" name="search" 
                           placeholder="Tìm kiếm túi xách..."
                           value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>

                <!-- Cart -->
                <a href="../views/cart.php" class="btn btn-primary position-relative">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?= !empty($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>
