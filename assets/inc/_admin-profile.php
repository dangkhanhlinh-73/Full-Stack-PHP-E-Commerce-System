<section class="py-5" style="background:#fff5fa; min-height:85vh;">
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-header rounded-top-4" style="background:#ad1457;">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle fa-2x text-white me-3"></i>
                            <h4 class="mb-0 text-white">Thông Tin Admin</h4>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="../controller/AdminProfileController.php" method="post">

                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Họ và tên <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background:#ffe4ef; border-color:#ad1457;">
                                            <i class="fas fa-user" style="color:#ad1457;"></i>
                                        </span>
                                        <input type="text" name="name" class="form-control"
                                               value="<?= $user['name'] ?>" required
                                               placeholder="Nhập họ và tên"
                                               style="border:2px solid #f3c3d5;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Số điện thoại <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background:#ffe4ef; border-color:#ad1457;">
                                            <i class="fas fa-phone" style="color:#ad1457;"></i>
                                        </span>
                                        <input type="tel" name="phone" class="form-control"
                                               value="<?= $user['phone'] ?>" required
                                               pattern="[0-9]{10,11}"
                                               placeholder="Nhập số điện thoại"
                                               style="border:2px solid #f3c3d5;">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Email</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background:#ffe4ef; border-color:#ad1457;">
                                            <i class="fas fa-envelope" style="color:#ad1457;"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control"
                                               value="<?= $user['email'] ?>" readonly
                                               style="border:2px solid #f3c3d5; background:#f8f9fa;">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label fw-semibold">Role</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background:#ffe4ef; border-color:#ad1457;">
                                            <i class="fas fa-users-cog" style="color:#ad1457;"></i>
                                        </span>
                                        <input type="text" class="form-control"
                                               value="<?= $user['role'] ?>" readonly
                                               style="border:2px solid #f3c3d5; background:#f8f9fa;">
                                    </div>
                                </div>

                            </div>

                            <input type="hidden" name="action" value="update_profile">

                        </form>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>
