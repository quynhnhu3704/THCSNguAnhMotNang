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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="image/icon.svg" type="image/svg+xml">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.7.1.min.js"></script>
</head>

<body>
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
                    echo '<li><a href="index.php?page=quanlythietbi" class="text-decoration-none d-block text-dark py-2">Quản lý thiết bị</a></li>';
                    echo '<li><a href="index.php?page=quanlybomon" class="text-decoration-none d-block text-dark py-2">Quản lý bộ môn</a></li>';
                    echo '<li><a href="#" class="text-decoration-none d-block text-dark py-2">Quản lý phiếu mượn</a></li>';
                    echo '<li><a href="index.php?page=quanlynhacungcap" class="text-decoration-none d-block text-dark py-2">Quản lý nhà cung cấp</a></li>';
                    echo '<li><a href="index.php?page=quanlynguoidung" class="text-decoration-none d-block text-dark py-2">Quản lý người dùng</a></li>';
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
                include_once('View/includes/header.php');
            }
        ?>

        <main>
            <!-- switch case -->
            <?php
                switch($page) {
                    // Chức năng dùng chung
                    case 'dangnhap':
                        include_once('View/common/dangnhap.php');
                        break;
                    case 'dangxuat':
                        include_once('View/common/dangxuat.php');
                        break;
                    case 'chitietthietbi':
                        include_once('View/common/chitietthietbi.php');
                        break;
                    
                    // Chức năng cho Hiệu trưởng
                    // Chức năng cho Tổ trưởng chuyên môn
                    // Chức năng cho Giáo viên bộ môn


                    // Chức năng cho Nhân viên quản lý thiết bị
                    // Quản lý thiết bị (CRUD)
                    case 'quanlythietbi':
                        include_once('View/nvthietbi/quanlythietbi/quanlythietbi.php');
                        break;
                    case 'suathietbi':
                        include_once('View/nvthietbi/quanlythietbi/suathietbi.php');
                        break;
                    case 'themthietbi':
                        include_once('View/nvthietbi/quanlythietbi/themthietbi.php');
                        break;
                    case 'xoathietbi':
                        include_once('View/nvthietbi/quanlythietbi/xoathietbi.php');
                        break;

                    // Quản lý bộ môn (CRUD)
                    case 'quanlybomon':
                        include_once('View/nvthietbi/quanlybomon/quanlybomon.php');
                        break;
                    case 'suabomon':
                        include_once('View/nvthietbi/quanlybomon/suabomon.php');
                        break;
                    case 'thembomon':
                        include_once('View/nvthietbi/quanlybomon/thembomon.php');
                        break;
                    case 'xoabomon':
                        include_once('View/nvthietbi/quanlybomon/xoabomon.php');
                        break;

                    // Quản lý nhà cung cấp (CRUD)
                    case 'quanlynhacungcap':
                        include_once('View/nvthietbi/quanlynhacungcap/quanlynhacungcap.php');
                        break;
                    case 'suanhacungcap':
                        include_once('View/nvthietbi/quanlynhacungcap/suanhacungcap.php');
                        break;
                    case 'themnhacungcap':
                        include_once('View/nvthietbi/quanlynhacungcap/themnhacungcap.php');
                        break;
                    case 'xoanhacungcap':
                        include_once('View/nvthietbi/quanlynhacungcap/xoanhacungcap.php');
                        break;


                    // Chức năng cho Nhân viên kỹ thuật


                    // Chức năng cho Quản trị hệ thống
                    // Quản lý người dùng (CRUD)
                    case 'quanlynguoidung':
                        include_once('View/quantri/quanlynguoidung/quanlynguoidung.php');
                        break;
                    case 'suanguoidung':
                        include_once('View/quantri/quanlynguoidung/suanguoidung.php');
                        break;
                    case 'themnguoidung':
                        include_once('View/quantri/quanlynguoidung/themnguoidung.php');
                        break;
                    case 'xoanguoidung':
                        include_once('View/quantri/quanlynguoidung/xoanguoidung.php');
                        break;

                    default:
                        include_once('View/common/thietbi.php');
                        break;
                }
            ?>
        </main>

        <?php         
            include_once('View/includes/footer.php');
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