<!doctype html>
<html lang="vi">
<?php
ob_start();
session_start();
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>THCS Ngũ Anh Một Nàng</title>
    <meta name="description" content="Website đặt phòng khách sạn NguAnhMotNang – sang trọng, thân thiện, đặt phòng nhanh trong 60 giây."/>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="public/uploads/icon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="public/css/style.css">
    <script src="public/js/bootstrap.bundle.min.js"></script>
    <script src="public/js/jquery-3.7.1.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container-fluid px-5">
            <!-- Nút mở sidebar -->
            <button id="menuToggle" class="btn btn-outline-primary me-3">&#9776;</button>

            <a class="navbar-brand fw-bold ms-3" href="index.php">
                <i class="bi bi-mortarboard me-2"></i>THCS Ngũ Anh Một Nàng
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
                    <li class="nav-item"><a class="nav-link" href="index.php?page=dangkymuon">Phiếu mượn</a></li>

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
                                    <li><a class="dropdown-item" href="index.php?page=thongtincanhan">Thông tin cá nhân</a></li>
                                    <li><a class="dropdown-item" href="index.php?page=thaydoimatkhau">Thay đổi mật khẩu</a></li>
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
        <h5 class="fw-bold px-3 pt-3 pb-1"><i class="bi bi-speedometer2 me-2"></i>DANH MỤC</h5>
        <ul class="list-unstyled px-3">
            <?php
            if(!isset($_SESSION['login'])) {
                echo '<li class="fst-italic text-center text-muted">Vui lòng đăng nhập</li>';
            } else {
                echo '<li><a href="index.php?page=dsthietbi" class="text-decoration-none d-block text-dark py-2">Quản lý thiết bị</a></li>';
                echo '<li><a href="index.php?page=dsbomon" class="text-decoration-none d-block text-dark py-2">Quản lý bộ môn</a></li>';
                echo '<li><a href="index.php?page=dsphieumuon" class="text-decoration-none d-block text-dark py-2">Quản lý phiếu mượn</a></li>';
                echo '<li><a href="index.php?page=dsnhacungcap" class="text-decoration-none d-block text-dark py-2">Quản lý nhà cung cấp</a></li>';
                echo '<li><a href="index.php?page=dsnguoidung" class="text-decoration-none d-block text-dark py-2">Quản lý người dùng</a></li>';
                echo '<li><a href="index.php?page=dsquyen" class="text-decoration-none d-block text-dark py-2">Phân quyền</a></li>';
                echo '<li><a href="index.php?page=dsbaohong" class="text-decoration-none d-block text-dark py-2">Báo hỏng thiết bị</a></li>';
            }
            ?>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <div id="mainContent">
        <!-- Header -->
        <?php
        $page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
        
        // Chỉ hiển thị header khi không có ?page nào, tức là index.php
        if ($page == '') {
            include_once('App/Views/layouts/header.php');
        }
        ?>

        <main>
            <!-- switch case -->
            <?php
            switch($page) {
                // Chức năng dùng chung
                // Đăng nhập
                case 'dangnhap':
                    include_once('App/Views/common/dangnhap.php');
                    break;
                // Đăng xuất
                case 'dangxuat':
                    include_once('App/Views/common/dangxuat.php');
                    break;
                // Xem thông tin cá nhân
                case 'thongtincanhan':
                    include_once('App/Views/common/thongtincanhan.php');
                    break;
                // Cập nhật thông tin cá nhân
                case 'suathongtincanhan':
                    include_once('App/Views/common/suathongtincanhan.php');
                    break;
                //  Thay đổi mật khẩu
                case 'thaydoimatkhau':
                    include_once('App/Views/common/thaydoimatkhau.php');
                    break;
                // Xem chi tiết thiết bị
                case 'chitietthietbi':
                    include_once('App/Views/common/chitietthietbi.php');
                    break;
                
                // Chức năng cho Hiệu trưởng
                // Chức năng cho Tổ trưởng chuyên môn
                // Chức năng cho Giáo viên bộ môn
                case 'dangkymuon':
                    include_once('App/Views/giaovien/dangkymuon/dangkymuon.php');
                    break;

                // Chức năng cho Nhân viên quản lý thiết bị
                // Quản lý thiết bị (CRUD)
                case 'dsthietbi':
                    include_once('App/Views/thietbi/qlthietbi/dsthietbi.php');
                    break;
                case 'suathietbi':
                    include_once('App/Views/thietbi/qlthietbi/suathietbi.php');
                    break;
                case 'themthietbi':
                    include_once('App/Views/thietbi/qlthietbi/themthietbi.php');
                    break;
                case 'xoathietbi':
                    include_once('App/Views/thietbi/qlthietbi/xoathietbi.php');
                    break;
                // Quản lý bộ môn (CRUD)
                case 'dsbomon':
                    include_once('App/Views/thietbi/qlbomon/dsbomon.php');
                    break;
                case 'suabomon':
                    include_once('App/Views/thietbi/qlbomon/suabomon.php');
                    break;
                case 'thembomon':
                    include_once('App/Views/thietbi/qlbomon/thembomon.php');
                    break;
                case 'xoabomon':
                    include_once('App/Views/thietbi/qlbomon/xoabomon.php');
                    break;
                // Quản lý nhà cung cấp (CRUD)
                case 'dsnhacungcap':
                    include_once('App/Views/thietbi/qlnhacungcap/dsnhacungcap.php');
                    break;
                case 'suanhacungcap':
                    include_once('App/Views/thietbi/qlnhacungcap/suanhacungcap.php');
                    break;
                case 'themnhacungcap':
                    include_once('App/Views/thietbi/qlnhacungcap/themnhacungcap.php');
                    break;
                case 'xoanhacungcap':
                    include_once('App/Views/thietbi/qlnhacungcap/xoanhacungcap.php');
                    break;
                // Quản lý phiếu mượn (CRUD)
                case 'dsphieumuon':
                    include_once('App/Views/thietbi/qlphieumuon/dsphieumuon.php');
                    break;
                case 'suaphieumuon':
                    include_once('App/Views/thietbi/qlphieumuon/suaphieumuon.php');
                    break;
                case 'themphieumuon':
                    include_once('App/Views/thietbi/qlphieumuon/themphieumuon.php');
                    break;
                case 'xoaphieumuon':
                    include_once('App/Views/thietbi/qlphieumuon/xoaphieumuon.php');
                    break;
                // Báo hỏng thiết bị
                case 'dsbaohong':
                    include_once('App/Views/thietbi/baohong/dsbaohong.php');
                    break;
                case 'baohongthietbi':
                    include_once('App/Views/thietbi/baohong/baohongthietbi.php');
                    break;


                // Chức năng cho Nhân viên kỹ thuật


                // Chức năng cho Quản trị hệ thống
                // Quản lý người dùng (CRUD)
                case 'dsnguoidung':
                    include_once('App/Views/admin/qlnguoidung/dsnguoidung.php');
                    break;
                case 'suanguoidung':
                    include_once('App/Views/admin/qlnguoidung/suanguoidung.php');
                    break;
                case 'themnguoidung':
                    include_once('App/Views/admin/qlnguoidung/themnguoidung.php');
                    break;
                case 'xoanguoidung':
                    include_once('App/Views/admin/qlnguoidung/xoanguoidung.php');
                    break;
                // Phân quyền
                case 'dsquyen':
                    include_once('App/Views/admin/phanquyen/dsquyen.php');
                    break;
                case 'suaquyen':
                    include_once('App/Views/admin/phanquyen/suaquyen.php');
                    break;
                
                // Mặc định
                default:
                    include_once('App/Views/common/thietbi.php');
                    break;
            }
            ?>
        </main>

        <?php         
        include_once('App/Views/layouts/footer.php');
        ?>
    </div>

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
</body>
<?php
ob_end_flush();
?>
</html>