<section class="py-5" style="background: white; min-height: 85vh;">
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="fw-bold mb-0" style="color: #ad1457;">
                    Quản Lý Sản Phẩm
                </h2>
                <a href="../controller/AddProductController.php" class="btn btn-success">
                    Thêm Sản Phẩm
                </a>
            </div>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $_SESSION['error'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <div class="row">
            <div class="col-12">
                <div class="card" style="min-height: 70vh;">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead class="table-primary">
                                    <tr>
                                        <th>ID</th>
                                        <th>Sản Phẩm</th>
                                        <th>Giá</th>
                                        <th>Kho</th>
                                        <th>Danh Mục</th>
                                        <th>Trạng Thái</th>
                                        <th>Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($listProduct)): ?>
                                        <?php foreach($listProduct as $product): ?>
                                        <tr>
                                            <td><?= $product['id'] ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="../assets/images/<?= htmlspecialchars($product['image'] ?? 'no-image.jpg') ?>" 
                                                         width="80" height="80"
                                                         class="rounded shadow-sm me-3"
                                                         style="object-fit: cover; border: 3px solid #ad1457;"
                                                         alt="<?= htmlspecialchars($product['name']) ?>"
                                                         onerror="this.src='../assets/images/no_image.jpg'">
                                                    <span class="fw-medium"><?= htmlspecialchars($product['name']) ?></span>
                                                </div>
                                            </td>
                                            <td><?= number_format($product['price']) ?>đ</td>
                                            <td><?= $product['quantity'] ?></td>
                                            <td>
                                                <?php
                                                    $catName = 'Chưa chọn';
                                                    foreach($listCategory as $cat) {
                                                        if($cat['id'] == $product['id_category']) {
                                                            $catName = $cat['name'];
                                                            break;
                                                        }
                                                    }
                                                    echo htmlspecialchars($catName);
                                                ?>
                                            </td>
                                            <td><span class="badge bg-success">Active</span></td>
                                            <td>
                                                <a href="../controller/EditProductController.php?id=<?= $product['id'] ?>" 
                                                   class="btn btn-warning btn-sm me-2">Sửa</a>
                                                <form action="../controller/AdminProductsController.php" method="post" class="d-inline"
                                                      onsubmit="return confirm('Xóa sản phẩm này?')">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <h5 class="text-muted">Chưa có sản phẩm nào</h5>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="../views/admindashboard.php" class="btn btn-primary btn-lg">
                                Quay Lại Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>