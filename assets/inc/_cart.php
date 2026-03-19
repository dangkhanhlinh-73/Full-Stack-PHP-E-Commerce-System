<?php
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}
?>

<section class="cart-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-shopping-cart"></i> Giỏ Hàng Của Bạn
                        </h4>
                        <form method="POST" style="display: inline;">
                            <button type="submit" name="action" value="clear_all" class="btn btn-outline-dark btn-sm" onclick="return confirm('Bạn có chắc muốn xóa tất cả sản phẩm?')">
                                <i class="fas fa-trash-alt"></i> Xóa Tất Cả
                            </button>
                        </form>

                    </div>
                    <div class="card-body">
                        <div class="mb-3 text-muted">
                            <small><i class="fas fa-info-circle"></i> Bạn đang có <?= count($cart) ?> sản phẩm trong giỏ hàng</small>
                        </div>

                        <?php if (!empty($cart)): ?>
                        <?php foreach ($cart as $product): ?>
                        <div class="card mb-3" style="border: 2px solid #e91e63;">
                            <div class="row align-items-center py-2">
                                <div class="col-md-6 py-1 ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="../assets/images/<?= $product['image'] ?>" 
                                             class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;" 
                                             alt="<?= $product['name'] ?>">
                                        <div>
                                            <h6 class="mb-1"><?= $product['name'] ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 text-center py-1">
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <input type="number" name="quantity" value="<?= $product['quantity'] ?>" min="1" 
                                               class="form-control text-center mb-2" 
                                               style="width: 80px; margin: 0 auto;">
                                </div>
                                <div class="col-md-2 text-center">
                                    <span class="fw-bold text-primary"><?= number_format($product['price']) ?>đ</span>
                                </div>
                                <div class="col-md-2 text-center">
                                        <button type="submit" name="action" value="update" class="btn btn-outline-success btn-sm me-1">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                    </form>
                                    <form method="POST" style="display: inline;">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                        <button type="submit" name="action" value="delete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Giỏ hàng trống</h5>
                                <a href="../controller/ProductsController.php" class="btn btn-primary mt-3">
                                    <i class="fas fa-shopping-bag"></i> Tiếp Tục Mua Sắm
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="card sticky-top">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-receipt"></i> Tóm Tắt Đơn Hàng
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tạm tính:</span>
                            <span><?= number_format($total) ?>đ</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Phí vận chuyển:</span>
                            <span class="text-success">Miễn phí</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <strong>Tổng cộng:</strong>
                            <strong class="text-primary"><?= number_format($total) ?>đ</strong>
                        </div>
                        <div class="d-grid gap-2">
                            <a href="../views/checkout.php" class="btn btn-primary">
                                <i class="fas fa-credit-card"></i> Thanh Toán
                            </a>
                            <a href="../controller/ProductsController.php" class="btn btn-outline-primary">
                                <i class="fas fa-shopping-bag"></i> Tiếp Tục Mua Sắm
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


