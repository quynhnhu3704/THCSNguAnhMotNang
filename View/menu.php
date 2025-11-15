<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container-fluid px-5">
        <!-- Nút mở sidebar -->
        <button id="menuToggle" class="btn btn-outline-primary me-3">&#9776;</button>

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

<!-- SIDEBAR -->
<div id="sidebar" class="bg-white shadow-sm">
    <h5 class="fw-semibold px-3 pt-3 pb-1">DANH MỤC</h5>
    <ul class="list-unstyled px-3">
        <?php
            if(!isset($_SESSION['login'])) {
                // echo "<li>vui lòng dang nhap</li>";
                echo '<li class="fst-italic text-center text-muted">Vui lòng đăng nhập</li>';
            } else {
                echo '<li><a href="index.php?page=quanlythietbi" class="text-decoration-none d-block text-dark py-2">Quản lý thiết bị</a></li>';
                echo '<li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý bộ môn</a></li>';
                echo '<li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý phiếu mượn</a></li>';
                echo '<li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý nhà cung cấp</a></li>';
            }
        ?>
    </ul>
</div>

<!-- MAIN CONTENT -->
<div id="mainContent">
    <!-- Header -->
    <?php
        include_once('View/menu.php');

        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
        
        // Chỉ hiển thị header khi không có ?page nào, tức là index.php
        if ($page == '') {
            include_once('View/header.php');
        }
    ?>

    <main>
        <!-- switch case -->
        <?php
            switch($page) {
                case 'dangnhap':
                    include_once('View/dangnhap.php');
                    break;
                case 'dangxuat':
                    include_once('View/dangxuat.php');
                    break;
                case 'quanlythietbi':
                    include_once('View/quanlythietbi.php');
                    break;
                case 'chitietthietbi':
                    include_once('View/chitietthietbi.php');
                    break;
                default:
                    include_once('View/thietbi.php');
                    break;
            }
        ?>
    </main>

    <?php         
        include_once('View/footer.php');
    ?>
</div>

<style>

</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');
        const toggleBtn = document.getElementById('menuToggle');

        // Tạm tắt transition để tránh thụt ra thụt vô
        document.body.classList.add('no-transition');

        // Kiểm tra trạng thái lưu
        if (localStorage.getItem('sidebarOpen') === 'true') {
            sidebar.classList.add('active');
            main.classList.add('shifted');
        }

        // Bật lại transition sau khi layout ổn định
        setTimeout(() => {
            document.body.classList.remove('no-transition');
        }, 100);

        // Toggle sidebar
        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('active');
            main.classList.toggle('shifted');
            localStorage.setItem('sidebarOpen', sidebar.classList.contains('active'));
        });
    });
</script>