<?php
@session_start();
?>

<section class="py-5" style="background: white; min-height: 85vh;">
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h2 class="fw-bold" style="color: #ad1457;">
                    <i class="fas fa-tags me-3"></i>
                    Quản Lý Danh Mục
                </h2>

                <a href="../views/add-category.php" class="btn btn-success btn-sm px-3 py-2">
                    <i class="fas fa-plus me-1"></i> Thêm Danh Mục
                </a>
            </div>
        </div>
        
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <?= $_SESSION['success'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
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
                                        <th style="font-size: 1.3rem; padding: 1rem;">ID</th>
                                        <th style="font-size: 1.3rem; padding: 1rem;">Tên Danh Mục</th>
                                        <th style="font-size: 1.3rem; padding: 1.rem;">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($listCategory as $category): ?>
                                    <tr>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $category['id'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $category['name'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;">
                                            <a href="../controller/EditCategoryController.php?id=<?= $category['id'] ?>" class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i> Sửa
                                            </a>
                                            <form action="../controller/CategoryController.php" method="post" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa danh mục này?')">
                                                <input type="hidden" name="id" value="<?= $category['id'] ?>">
                                                <input type="hidden" name="action" value="delete">
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="text-center mt-4">
                            <a href="../views/admindashboard.php" class="btn btn-primary btn-lg">
                                <i class="fas fa-arrow-left me-2"></i> Quay Lại Dashboard
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
