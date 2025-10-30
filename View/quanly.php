<?php
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
        exit();
    }
?>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-3 col-lg-2 d-md-block bg-white shadow-sm sidebar py-4">
            <div class="position-sticky">
                <h5 class="px-3 mb-4 text-primary fw-bold"><i class="bi bi-speedometer2 me-2"></i>Quản lý</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=quanlynguoidung">
                            <i class="bi bi-people me-2"></i>Khách hàng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=quanly">
                            <i class="bi bi-info-circle me-2"></i>Thông tin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=quanlyphong">
                            <i class="bi bi-house-door me-2"></i>Loại phòng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=quanly">
                            <i class="bi bi-calendar-check me-2"></i>Đặt phòng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="index.php?page=quanly">
                            <i class="bi bi-person-gear me-2"></i>Tài khoản
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-5 py-4">
            <div class="card-na p-4">
                <?php
                    switch ($page) {
                        case 'quanlynguoidung':
                            echo "<h2><i class='bi bi-people me-2'></i>Danh sách khách hàng</h2>";
                            include_once('View/quanlynguoidung.php');
                            break;
                        case 'quanlyphong':
                            echo "<h2><i class='bi bi-people me-2'></i>Danh sách phòng</h2>";
                            include_once('View/quanlyphong.php');
                            break;
                        default:
                            echo '<h4 class="fw-bold">Chào mừng <span class="text-primary text-decoration-underline">' . $_SESSION['username'] . '</span> đến trang quản lý</h4>';
                            echo '<p class="text-muted mb-0">Hãy chọn mục từ menu bên trái để bắt đầu.</p>';
                    }
                ?>
            </div>
        </main>
    </div>
</div>