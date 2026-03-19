<?php @session_start(); ?>

<!-- LẤY DANH SÁCH ẢNH CÓ SẴN TRONG assets/images/ – AN TOÀN, KHÔNG LỖI -->
<?php
$imageFolder = '../assets/images/';
$images = [];

// Tạo thư mục nếu chưa có
if (!is_dir($imageFolder)) {
    mkdir($imageFolder, 0755, true);
}

// Đọc ảnh trong thư mục
if (is_readable($imageFolder)) {
    $files = scandir($imageFolder);
    if ($files !== false) {
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') continue;
            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
                $images[] = $file;
            }
        }
    }
}

// Nếu không có ảnh → tạo ảnh placeholder tự động
$defaultImage = 'no_image.jpg';
$defaultPath = $imageFolder . $defaultImage;
if (empty($images) && !file_exists($defaultPath)) {
    $img = imagecreatetruecolor(300, 300);
    $bg = imagecolorallocate($img, 245, 245, 245);
    $text = imagecolorallocate($img, 150, 150, 150);
    imagefilledrectangle($img, 0, 0, 300, 300, $bg);
    imagestring($img, 5, 95, 140, 'NO IMAGE', $text);
    imagejpeg($img, $defaultPath, 80);
    imagedestroy($img);
    $images[] = $defaultImage;
}
?>

<section class="py-5" style="background: #fff5fa; min-height: 85vh;">
    <div class="container">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold mb-0" style="color:#ad1457;">
                <i class="fas fa-edit me-2"></i>Sửa sản phẩm
            </h3>
            <a href="../controller/AdminProductsController.php" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i>Quay lại
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <!-- Thông báo -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <?= $_SESSION['error'] ?> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $_SESSION['success'] ?> 
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form action="../controller/AdminProductsController.php" method="post">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#ad1457;">Tên sản phẩm *</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color:#ad1457;">Giá bán *</label>
                            <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" min="0" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color:#ad1457;">Số lượng *</label>
                            <input type="number" class="form-control" name="quantity" value="<?= $product['quantity'] ?>" min="0" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#ad1457;">Danh mục *</label>
                        <select class="form-select" name="categoryId" required>
                            <option value="">Chọn danh mục</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $product['id_category'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Ô CHỌN ẢNH -->
                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color:#ad1457;">Đính kèm ảnh sản phẩm *</label>
                        <select class="form-select" name="image" id="imageSelect" required>
                            <option value="">-- Chọn ảnh mới --</option>
                            <?php foreach ($images as $img): ?>
                                <option value="<?= $img ?>" <?= $img == $product['image'] ? 'selected' : '' ?>>
                                    <?= $img ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- PREVIEW ẢNH HIỆN TẠI + THAY ĐỔI NGAY KHI CHỌN -->
                    <div class="text-center mb-4">
                        <img id="preview" 
                             src="../assets/images/<?= htmlspecialchars($product['image'] ?? 'no_image.jpg') ?>" 
                             alt="Ảnh sản phẩm" 
                             class="img-thumbnail border border-3" 
                             style="max-height: 320px; object-fit: contain; border-color:#ad1457;">
                        <p class="text-muted mt-2">Ảnh hiện tại. Chọn ảnh mới để thay đổi.</p>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn px-4 text-white" style="background:#ad1457;">
                            <i class="fas fa-save me-1"></i> Cập nhật sản phẩm
                        </button>
                        <a href="../controller/AdminProductsController.php" class="btn btn-outline-secondary">
                            Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Preview ảnh khi chọn mới -->
<script>
document.getElementById('imageSelect').addEventListener('change', function() {
    const preview = document.getElementById('preview');
    if (this.value) {
        preview.src = '../assets/images/' + this.value;
    }
});
</script>