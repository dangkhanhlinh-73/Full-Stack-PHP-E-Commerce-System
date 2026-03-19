<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4"><i class="fas fa-history me-2"></i>Lịch sử đơn hàng</h2>

            <?php if (!empty($_SESSION['order_success'])): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i>
                    <?= $_SESSION['order_success'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['order_success']); ?>
            <?php endif; ?>

            <?php if (!empty($_SESSION['order_error'])): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <?= $_SESSION['order_error'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php unset($_SESSION['order_error']); ?>
            <?php endif; ?>

            <?php if (empty($orders)): ?>
                <div class="text-center py-5">
                    <i class="fas fa-shopping-bag text-muted" style="font-size: 4rem;"></i>
                    <h4 class="text-muted mt-3">Chưa có đơn hàng nào</h4>
                    <p class="text-muted">Hãy mua sắm ngay để có đơn hàng đầu tiên!</p>
                    <a href="home" class="btn btn-primary">
                        <i class="fas fa-shopping-cart me-2"></i>Mua sắm ngay
                    </a>
                </div>
            <?php endif; ?>

            <?php foreach ($orders as $order): ?>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Đơn hàng #<?= $order['id'] ?></h6>
                            <small class="text-muted">
                                <?= date("d/m/Y H:i", strtotime($order['createdAt'])) ?>
                            </small>
                        </div>

                        <div class="d-flex align-items-center gap-2">
                            <?php
                                $status = $order['status'];
                                $badge = [
                                    'pending'   => 'bg-warning',
                                    'confirmed' => 'bg-info',
                                    'shipping'  => 'bg-primary',
                                    'delivered' => 'bg-success',
                                    'cancelled' => 'bg-danger'
                                ];
                            ?>
                            <span class="badge <?= $badge[$status] ?? 'bg-secondary' ?>">
                                <?= ucfirst($status) ?>
                            </span>

                            <?php if ($status == 'pending' || $status == 'confirmed'): ?>
                                <form action="../controller/OrderHistoryController.php" method="post" class="d-inline"
                                    onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                <input type="hidden" name="action" value="cancel">
                                <input type="hidden" name="orderId" value="<?= $order['id'] ?>">

                                <button type="submit" class="btn btn-danger btn-sm text-white">
                                    <i class="fas fa-times me-1"></i>Hủy
                                </button>
                                </form>
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <h6 class="text-primary mb-2">Sản phẩm đã đặt:</h6>

                                <?php foreach ($order['orderItems'] as $item): ?>
                                    <div class="d-flex align-items-center mb-2">
                                        <img src="../assets/images/<?= $item['product']['image'] ?>"
                                             class="rounded me-3" width="50" height="50" style="object-fit: cover;">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-0"><?= $item['product']['name'] ?></h6>
                                            <small class="text-muted">
                                                Số lượng: <?= $item['quantity'] ?> × 
                                                <?= number_format($item['price'], 0, ',', '.') ?> ₫
                                            </small>
                                        </div>
                                        <div class="text-end">
                                            <?= number_format($item['subtotal'], 0, ',', '.') ?> ₫
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="col-md-4">
                                <div class="border rounded p-3">
                                    <h6 class="text-primary mb-2">Thông tin giao hàng</h6>

                                    <p class="mb-1"><small><strong>Địa chỉ:</strong> <?= $order['shippingAddress'] ?></small></p>
                                    <p class="mb-1"><small><strong>SĐT:</strong> <?= $order['phone'] ?></small></p>
                                    <p class="mb-2"><small><strong>Thanh toán:</strong> <?= $order['paymentMethod'] ?></small></p>

                                    <hr class="my-2">

                                    <div class="d-flex justify-content-between">
                                        <small>Phí ship:</small>
                                        <small><?= number_format($order['shippingFee'], 0, ',', '.') ?> ₫</small>
                                    </div>

                                    <div class="d-flex justify-content-between fw-bold text-primary">
                                        <span>Tổng cộng:</span>
                                        <span><?= number_format($order['totalAmount'], 0, ',', '.') ?> ₫</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
