<?php @session_start(); ?>
<section class="py-5" style="background: white; min-height: 85vh;">
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow-sm">
                    <div class="card-header" style="background: #ad1457; color: white;">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i> Sửa danh mục
                        </h5>
                    </div>

                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <?= $_SESSION['error'] ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                            <?php unset($_SESSION['error']); ?>
                        <?php endif; ?>
                        
                        <form action="../controller/CategoryController.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">
                                    Tên danh mục <span class="text-danger">*</span>
                                </label>

                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="name" 
                                    name="name" 
                                    value="<?= $category['name'] ?>" 
                                    required
                                >
                            </div>

                            <input type="hidden" name="action" value="edit">
                            <input type="hidden" name="id" value="<?= $category['id'] ?>">

                            <div class="d-flex justify-content-between mt-4">

                                <a href="admincategory.php" 
                                   class="btn btn-secondary px-3">
                                    <i class="fas fa-arrow-left me-2"></i> Quay lại
                                </a>

                                <button type="submit" 
                                        class="btn px-4" 
                                        style="background:#ad1457; color:white;">
                                    <i class="fas fa-save me-2"></i> Cập nhật
                                </button>

                            </div>

                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
