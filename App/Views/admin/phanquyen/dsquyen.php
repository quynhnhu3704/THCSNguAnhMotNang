<!-- App/Views/admin/phanquyen/dsquyen.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] != 1) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }
?>

<h2 class="text-center fw-semibold my-3">Danh sách người dùng</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get">
        <input type="hidden" name="page" value="dsquyen"> <!-- Submit sẽ tạo URL: index.php?page=dsquyen&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm người dùng..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>


<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên đăng nhập</th>
                    <th>Họ tên</th>
                    <th>Vai trò</th>
                    <th>Bộ môn</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cNguoiDung.php');
            $p = new controlNguoiDung();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchNguoiDung($keyword);
            } else {
                $kq = $p->getAllNguoiDung();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    // Ẩn admin khỏi danh sách phân quyền
                    if ($r['maVaiTro'] == 6) continue;
                    
                    // Tăng biến đếm
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['tenDangNhap'] . '</td>';
                        echo '<td class="text-center">' . $r['hoTen'] . '</td>';
                        echo '<td class="text-center">' . $r['tenVaiTro'] . '</td>';
                    
                        // echo '<td class="text-center">';
                        //     switch ($r['maVaiTro']) {
                        //         case 1: echo '<span class="badge bg-danger">Hiệu trưởng</span>'; break;
                        //         case 2: echo '<span class="badge bg-warning text-dark">Tổ trưởng chuyên môn</span>'; break;
                        //         case 3: echo '<span class="badge bg-secondary">Giáo viên bộ môn</span>'; break;
                        //         case 4: echo '<span class="badge bg-success">Nhân viên quản lý thiết bị</span>'; break;
                        //         case 5: echo '<span class="badge bg-primary">Nhân viên kỹ thuật</span>'; break;
                        //         case 6: echo '<span class="badge bg-info text-dark">Quản trị hệ thống</span>'; break;
                        //         default: echo '<span class="badge bg-light text-dark">Không xác định</span>';
                        //     }
                        // echo '</td>';

                        echo '<td class="text-center">';
                            echo ($r['tenBoMon'] === NULL) ? '—' : $r['tenBoMon'];
                        echo '</td>';
                        
                        echo '<td class="text-center">' . $r['soDienThoai'] . '</td>';
                        echo '<td class="text-center">' . $r['email'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=suaquyen&maNguoiDung=' . $r['maNguoiDung'] . '" class="btn btn-sm btn-warning" style="font-size: 0.95em;"><i class="bi bi-person-fill-lock"></i> Phân quyền</a>&nbsp;';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="8"><h5 class="text-center text-muted">Hiện chưa có người dùng nào. Vui lòng quay lại sau.</h5></td></tr>';   
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    th, td {
        max-width: 12.5em;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>