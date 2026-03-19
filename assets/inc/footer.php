<footer class="text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 mb-4">
                <h5><i class="fas fa-shopping-bag"></i> Hapas</h5>
                <p>Thương hiệu túi xách nữ cao cấp với thiết kế sang trọng và chất lượng tuyệt vời.</p>
                <div class="social-links">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-youtube fa-lg"></i></a>
                    <a href="#" class="text-white"><i class="fab fa-tiktok fa-lg"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h6>Sản Phẩm</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">Túi Xách Tay</a></li>
                    <li><a href="#" class="text-white-50">Túi Đeo Chéo</a></li>
                    <li><a href="#" class="text-white-50">Túi Đeo Vai</a></li>
                    <li><a href="#" class="text-white-50">Túi Tote</a></li>
                </ul>
            </div>

            <div class="col-lg-2 col-md-6 mb-4">
                <h6>Hỗ Trợ</h6>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white-50">Liên Hệ</a></li>
                    <li><a href="#" class="text-white-50">Hướng Dẫn</a></li>
                    <li><a href="#" class="text-white-50">Bảo Hành</a></li>
                    <li><a href="#" class="text-white-50">Đổi Trả</a></li>
                </ul>
            </div>

            <div class="col-lg-4 mb-4">
                <h6>Liên Hệ</h6>
                <p><i class="fas fa-map-marker-alt"></i> 123 Đường Nguyễn Huệ, Quận 1, TP.HCM</p>
                <p><i class="fas fa-phone"></i> 1900-1234</p>
                <p><i class="fas fa-envelope"></i> bag@hapas.com</p>

                <h6 class="mt-4">Phương Thức Thanh Toán</h6>
                <div class="d-flex align-items-center">
                    <i class="fab fa-cc-visa fa-2x text-primary me-3" title="Visa"></i>
                    <i class="fab fa-cc-mastercard fa-2x text-warning me-3" title="Mastercard"></i>
                    <i class="fas fa-mobile-alt fa-2x text-success me-3" title="Momo"></i>
                    <i class="fas fa-wallet fa-2x text-info" title="ZaloPay"></i>
                </div>
            </div>
        </div>

        <hr class="my-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2025 Hapas. Tất cả quyền được bảo lưu.</p>
            </div>
            <div class="col-md-6 text-end">
                <a href="#" class="text-white-50 me-3">Chính Sách Bảo Mật</a>
                <a href="#" class="text-white-50">Điều Khoản Sử Dụng</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
//dropdown 
document.addEventListener('DOMContentLoaded', function() {
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });
});
</script>
