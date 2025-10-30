<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-mortarboard"></i> THCS Ngũ Anh Một Nàng
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=phieumuon">Phiếu mượn</a></li>

                <?php
                    if(isset($_SESSION['login'])) {
                    // if(isset($_SESSION['role_id'])) {
                        // if($_SESSION['role_id'] != 3) {
                            echo '<li class="nav-item ms-lg-2"><a class="btn btn-primary" href="index.php?page=quanly"><i class="bi bi-person-circle me-2"></i>' . $_SESSION['tenDangNhap'] . '</a></li>';
                        // }
                        echo '<li class="nav-item ms-lg-2">';
                            echo '<a class="btn btn-outline-primary" href="index.php?page=dangxuat" onclick="return confirm(\'Bạn có chắc chắn muốn đăng xuất khỏi hệ thống không?\');"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a>';
                        echo '</li>';
                    } else {
                        echo '<li class="nav-item ms-lg-2">';
                            echo '<a class="btn btn-primary" href="index.php?page=dangnhap"><i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập</a>';
                        echo '</li>';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>