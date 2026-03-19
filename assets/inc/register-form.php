<section class="register-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-user-plus"></i> Đăng Ký Tài Khoản
                        </h3>
                    </div>
                    <div class="card-body p-4">
                        <!-- Thông báo đăng ký thành công -->
                        <?php if (!empty($_SESSION['register_success'])) : ?>
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle"></i> <?= $_SESSION['register_success'] ?>
                            </div>
                            <?php unset($_SESSION['register_success']); ?>
                        <?php endif; ?>
                        
                        <!-- Thông báo người dùng đã tồn tại -->
                        <?php if (!empty($exist_user)) : ?>
                            <div class="alert alert-danger" role="alert">
                                <i class="fas fa-exclamation-triangle"></i> <?= $exist_user ?>
                            </div>
                        <?php endif; ?>

                        <form action="../controller/registerController.php" method="post">
                            <div class="mb-3">
                                <label for="fullName" class="form-label">
                                    <i class="fas fa-user"></i> Họ và tên *
                                </label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập họ và tên" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i> Email *
                                </label>
                                <input type="text" class="form-control" name="email" placeholder="Nhập email" required>
                                <?php if (!empty($err_email)) : ?>
                                    <span style="color: red;"><?= $err_email ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">
                                    <i class="fas fa-phone"></i> Số điện thoại *
                                </label>
                                <input type="text" class="form-control" name="phone" placeholder="Nhập số điện thoại" required>
                                <?php if (!empty($err_phone)) : ?>
                                    <span style="color: red;"><?= $err_phone ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i> Mật khẩu *
                                </label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" required>
                            </div>

                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">
                                    <i class="fas fa-lock"></i> Xác nhận mật khẩu *
                                </label>
                                <input type="password" class="form-control" name="repassword" placeholder="Nhập lại mật khẩu" required>
                                <?php if (!empty($err_repassword)) : ?>
                                    <span style="color: red;"><?= $err_repassword ?></span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        Tôi đồng ý với <a href="#" class="text-primary">Điều khoản sử dụng</a> và 
                                        <a href="#" class="text-primary">Chính sách bảo mật</a>
                                    </label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter">
                                    <label class="form-check-label" for="newsletter">
                                        Đăng ký nhận thông tin khuyến mãi qua email
                                    </label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-user-plus"></i> Đăng Ký
                            </button>
                        </form>

                        <div class="text-center mt-4">
                            <p class="mb-0">Đã có tài khoản? <a href="login.php" class="text-primary">Đăng nhập ngay</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
