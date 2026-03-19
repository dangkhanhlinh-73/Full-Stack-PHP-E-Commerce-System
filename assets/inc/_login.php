<?php
@session_start();

// Lấy thông báo lỗi từ session nếu có
$login_err = $_SESSION['login_err'] ?? '';
unset($_SESSION['login_err']);
?>

<section class="login-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-circle fa-4x text-primary mb-3"></i>
                            <h2 class="fw-bold">Đăng Nhập</h2>
                        </div>

                        <!-- thông báo sai thông tin đăng nhập -->
                        <?php if (!empty($login_err)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> <?php echo $login_err; ?>
                            </div>
                        <?php endif; ?>
                        
                        
                        <form method="POST" action="../controller/loginController.php">
                            <div class="mb-3">
                                <label for="emailphone" class="form-label">
                                    <i class="fas fa-envelope"></i> Email/ Số điện thoại
                                </label>
                                <input type="text" class="form-control form-control-lg" id="emailphone" name="emailphone"
                                       placeholder="Nhập email/ số điện thoại" autocomplete="off" value="" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Mật khẩu
                                </label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password"
                                       placeholder="Nhập mật khẩu" autocomplete="new-password" value="" required>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">
                                        Ghi nhớ đăng nhập
                                    </label>
                                </div>
                                <a href="forgot-password.php" class="text-decoration-none">
                                    Quên mật khẩu?
                                </a>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100 mb-3">
                                <i class="fas fa-sign-in-alt"></i> Đăng Nhập
                            </button>

                            <div class="text-center">
                                <span class="text-muted">Chưa có tài khoản? </span>
                                <a href="register.php" class="text-decoration-none fw-bold">
                                    Đăng ký ngay
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
