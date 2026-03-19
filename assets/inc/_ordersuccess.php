<section class="success-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-body text-center p-5">

                        <div class="mb-4">
                            <i class="fas fa-check-circle fa-5x text-success"></i>
                        </div>

                        <h2 class="text-success fw-bold mb-3">Đặt Hàng Thành Công!</h2>

                        <p class="lead mb-4" style="white-space: nowrap;">
                                Cảm ơn bạn đã mua hàng tại HAPAS. Đơn hàng của bạn đã được tiếp nhận và đang được xử lý.
                        </p>

                        <div class="row text-start mt-4">

                            <div class="col-md-6 mb-3">
                                <div class="p-4 border rounded shadow-sm h-100">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-receipt me-2"></i>Thông tin đơn hàng
                                    </h5>
                                    <p class="mb-2"><strong>Mã đơn hàng:</strong> <?= $order_code ?? '' ?></p>
                                    <p class="mb-2"><strong>Ngày đặt:</strong> <?= $order_date ?? '' ?></p>
                                    <p class="mb-0"><strong>Trạng thái:</strong> <?= $order_status ?? 'Đang xử lý' ?></p>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="p-4 border rounded shadow-sm h-100">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-user me-2"></i>Thông tin khách hàng
                                    </h5>
                                    <p class="mb-2"><strong>Họ tên:</strong> <?= $customer_name ?? '' ?></p>
                                    <p class="mb-2"><strong>Email:</strong> <?= $email ?? '' ?></p>
                                    <p class="mb-0"><strong>Số điện thoại:</strong> <?= $phone ?? '' ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="row text-start mt-3">
                            <div class="col-md-6 mb-3">
                                <div class="p-4 border rounded shadow-sm h-100">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-map-marker-alt me-2"></i>Địa chỉ giao hàng
                                    </h5>
                                    <p class="mb-2"><strong>Địa chỉ:</strong> <?= $address ?? '' ?></p>
                                    <?php if (!empty($notes)): ?>
                                    <p class="mb-0"><strong>Ghi chú:</strong> <?= $notes ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <div class="p-4 border rounded shadow-sm h-100">
                                    <h5 class="fw-bold mb-3">
                                        <i class="fas fa-credit-card me-2"></i>Phương thức
                                    </h5>
                                    <p class="mb-2"><strong>Giao hàng:</strong> <?= ($shipping_method ?? 'standard') == 'standard' ? 'Giao hàng tiêu chuẩn' : ($shipping_method ?? '') ?></p>
                                    <p class="mb-0"><strong>Thanh toán:</strong> <?= ($payment_method ?? 'cod') == 'cod' ? 'Thanh toán khi nhận hàng' : (($payment_method ?? '') == 'bank-transfer' ? 'Chuyển khoản ngân hàng' : ($payment_method ?? '')) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">

                            <h4 class="fw-bold mb-4 text-center">
                                <i class="fas fa-box-open me-2"></i>Chi tiết đơn hàng
                            </h4>

                            <?php if (!empty($order_items)): ?>
                                <?php foreach ($order_items as $item): ?>
                                    <div class="border rounded p-3 mb-3 text-start shadow-sm">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h6 class="fw-bold mb-1"><?= $item['product_name'] ?? $item['name'] ?></h6>
                                                <p class="mb-0 text-muted">Số lượng: <?= $item['quantity'] ?></p>
                                            </div>
                                            <div class="text-end">
                                                <p class="mb-0 fw-bold text-danger"><?= number_format($item['price'] * $item['quantity']) ?>đ</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p class="text-center text-muted">Không có dữ liệu sản phẩm</p>
                            <?php endif; ?>     

                            <hr class="my-4">

                            <div class="d-flex justify-content-between px-2">
                                <h6 class="fw-bold">Phí vận chuyển:</h6>
                                <p><?= number_format($shipping_fee ?? 0) ?>đ</p>
                            </div>

                            <div class="d-flex justify-content-between px-2">
                                <h5 class="fw-bold">Tổng cộng:</h5>
                                <h5 class="fw-bold text-danger"><?= number_format($total_amount ?? 0) ?>đ</h5>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-5">
                            <a href="home.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-home"></i> Về Trang Chủ
                            </a>
                            <a href="order-history.php" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-file-alt"></i> Xem Đơn Hàng
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
