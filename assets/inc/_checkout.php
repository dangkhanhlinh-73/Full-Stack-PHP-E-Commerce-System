<section class="checkout-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form method="POST" action="../controller/CheckoutController.php">

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-user"></i> Thông Tin Khách Hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label">Họ tên *</label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Nhập họ tên" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Số điện thoại *</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-map-marker-alt"></i> Địa Chỉ Giao Hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="address" class="form-label">Địa chỉ *</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Số nhà, tên đường" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="city" class="form-label">Tỉnh/Thành phố *</label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="Nhập tỉnh/thành phố" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="ward" class="form-label">Phường/Xã *</label>
                                    <input type="text" class="form-control" id="ward" name="ward" placeholder="Nhập phường/xã" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="notes" class="form-label">Ghi chú giao hàng</label>
                                <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Ghi chú thêm cho người giao túi xách..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-shipping-fast"></i> Phương Thức Giao Hàng
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="shipping" id="standard" value="standard" checked>
                                <label class="form-check-label" for="standard">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>Giao hàng tiêu chuẩn</strong>
                                            <br><small class="text-muted">3-5 ngày làm việc</small>
                                        </div>
                                        <span class="text-success ms-4">Miễn phí</span>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-credit-card"></i> Phương Thức Thanh Toán
                            </h5>
                        </div>
                        <div class="card-body">
                            <?php 
                            $payments = [
                                ['id' => 'cod', 'icon' => 'fa-money-bill-wave', 'label' => 'Thanh toán khi nhận hàng (COD)', 'desc' => 'Thanh toán bằng tiền mặt khi nhận túi xách'],
                                ['id' => 'bank-transfer', 'icon' => 'fa-university', 'label' => 'Chuyển khoản ngân hàng', 'desc' => 'Chuyển khoản qua ATM/Internet Banking'],
                            ];
                            foreach ($payments as $i => $pay): ?>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="payment" id="<?= $pay['id'] ?>" value="<?= $pay['id'] ?>" <?= $i === 0 ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="<?= $pay['id'] ?>">
                                        <i class="fas <?= $pay['icon'] ?> me-2"></i>
                                        <strong><?= $pay['label'] ?></strong>
                                        <br><small class="text-muted"><?= $pay['desc'] ?></small>
                                    </label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="cart" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-arrow-left"></i> Quay Lại Giỏ Hàng
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-shopping-cart"></i> Đặt Hàng
                        </button>
                    </div>

                    <div class="text-center mt-3">
                        <small class="text-muted">
                            <i class="fas fa-shield-alt text-success"></i>
                            Thông tin của bạn được bảo mật 100%
                        </small>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
