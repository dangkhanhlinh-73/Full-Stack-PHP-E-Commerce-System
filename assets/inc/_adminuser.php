<?php
?>

<section class="py-5" style="background: white; min-height: 85vh;">
    <div class="container-fluid px-4">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold" style="color: #ad1457;">
                    <i class="fas fa-users me-3"></i>
                    Quản Lý Người Dùng
                </h2>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12">
                <div class="card" style="min-height: 70vh;">
                    <div class="card-body p-4">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead class="table-primary">
                                    <tr>
                                        <th style="font-size: 1.3rem; padding: 1rem;">ID</th>
                                        <th style="font-size: 1.3rem; padding: 1rem;">Họ Tên</th>
                                        <th style="font-size: 1.3rem; padding: 1rem;">Email</th>
                                        <th style="font-size: 1.3rem; padding: 1rem;">Số Điện Thoại</th>
                                        <th style="font-size: 1.3rem; padding: 1rem;">Phân Quyền</th>
                                        <th style="font-size: 1.3rem; padding: 1rem;">Thao Tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user): ?>
                                    <tr>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $user['id'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $user['name'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $user['email'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $user['phone'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;"><?= $user['role'] ?></td>
                                        <td style="padding: 1rem; font-size: 1.1rem;">
                                            <button class="btn btn-warning btn-sm me-2">
                                                <i class="fas fa-edit"></i> Sửa
                                            </button>
                                            <a href="#" class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i> Xóa
                                            </a>
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
