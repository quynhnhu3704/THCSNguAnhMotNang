<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container-fluid px-5">
        <!-- Nút mở offcanvas -->
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling">
            <i class="bi bi-list fs-5"></i>
        </button>

        <a class="navbar-brand fw-bold ms-3" href="index.php">
            <i class="bi bi-mortarboard"></i> THCS Ngũ Anh Một Nàng
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
        <div id="nav" class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                <!-- Thanh tìm kiếm -->
                <li class="nav-item me-5">
                    <form class="d-flex" action="#" method="get">
                        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm thiết bị..." style="width: 220px;">
                        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
                    </form>
                </li>

                <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php?page=phieumuon">Phiếu mượn</a></li>

                <?php
                    if(isset($_SESSION['login'])) {
                    // if(isset($_SESSION['role_id'])) {
                        // if($_SESSION['role_id'] != 3) {
                            echo '
                            <li class="nav-item dropdown ms-lg-2">
                                <a class="btn btn-primary dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                                    <i class="bi bi-person-circle me-2"></i>' . $_SESSION['tenDangNhap'] . '
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end shadow">
                                    <li><a class="dropdown-item" href="#">Thông tin cá nhân</a></li>
                                    <li><a class="dropdown-item" href="#">Thay đổi mật khẩu</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="index.php?page=dangxuat" onclick="return confirm(\'Bạn có chắc chắn muốn đăng xuất khỏi hệ thống không?\');"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
                                </ul>
                            </li>
                            ';

                        // }
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

<!-- OFFCANVAS MENU -->
<div class="offcanvas offcanvas-start" style="width:17.5em;" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1" id="offcanvasScrolling">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasScrollingLabel">DANH MỤC</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled mb-0">
            <li><a href="index.php?page=quanlythietbi" class="text-decoration-none d-block text-dark py-2">Quản lý thiết bị</a></li>
            <li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý bộ môn</a></li>
            <li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý phiếu mượn</a></li>
            <li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý nhà cung cấp</a></li>
        </ul>
    </div>
</div>