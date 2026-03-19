<section class="py-5">
    <div class="container">
        <!--Danh mục Category  -->
        <div class="d-flex justify-content-center mb-5">
            <div class="btn-group" role="group">
                <a href="../controller/ProductsController.php" class="btn btn-primary px-4">
                    <i class="fas fa-th-large me-2"></i>Tất Cả
                </a>
                <?php if (!empty($listCategory)) : ?>
                    <?php foreach ($listCategory as $c) : ?>
                        <a href="../controller/ProductsController.php?category=<?= $c->getId() ?>" class="btn btn-outline-primary px-4">
                            <?= $c->getName() ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="row">
            <?php if (!empty($listProduct)) : ?>
                <?php foreach ($listProduct as $p) : ?>
                    <div class="col-lg-3 col-md-6 mb-4">
                        <div class="card product-card h-100">
                            <img src="../assets/images/<?= $p['image'] ?>" class="card-img-top" alt="<?= $p['name'] ?>" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?= $p['name'] ?></h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="h5 text-primary mb-0"><?= number_format($p['price']) ?>đ</span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <?php if (!isset($user)): ?>
                                    <a href="../views/login.php" class="btn btn-primary w-100">
                                        <i class="fas fa-sign-in-alt"></i> Đăng Nhập Để Mua
                                    </a>
                                <?php else: ?>
                                    <form method="POST" action="../controller/CartController.php">
                                        <input type="hidden" name="product_id" value="<?= $p['id'] ?>">
                                        <input type="hidden" name="redirect_url" value="<?= $_SERVER['REQUEST_URI'] ?>">
                                        <button type="submit" name="add_to_cart" class="btn btn-primary w-100">
                                            <i class="fas fa-cart-plus"></i> Thêm Vào Giỏ
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

    </div>
</section>
