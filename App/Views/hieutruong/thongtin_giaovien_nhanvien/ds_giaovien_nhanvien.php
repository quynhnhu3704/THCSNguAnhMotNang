<!-- App/Views/hieutruong/thongtin_giaovien_nhanvien/ds_giaovien_nhanvien.php -->
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

<h2 class="text-center fw-semibold my-3">Danh sách giáo viên/nhân viên</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get">
        <input type="hidden" name="page" value="ds_giaovien_nhanvien"> <!-- Submit sẽ tạo URL: index.php?page=ds_giaovien_nhanvien&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm GV/NV..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>

<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
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
                    // Ẩn hiệu trưởng khỏi danh sách
                    if ($r['maVaiTro'] == 1) continue;

                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['hoTen'] . '</td>';
                        echo '<td class="text-center">' . $r['tenVaiTro'] . '</td>';

                        echo '<td class="text-center">';
                            echo ($r['tenBoMon'] === NULL) ? '—' : $r['tenBoMon'];
                        echo '</td>';
                        
                        echo '<td class="text-center">' . $r['soDienThoai'] . '</td>';
                        echo '<td class="text-center">' . $r['email'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=xem_giaovien_nhanvien&maNguoiDung=' . $r['maNguoiDung'] . '" class="btn btn-sm btn-info" style="font-size: 0.95em;"><i class="bi bi-info-circle"></i> Xem</a>';
                        echo '</td>';
                    echo '</tr>';
                }  if ($dem == 0) {
                    echo '<tr><td colspan="10"><h5 class="text-center text-muted">Hiện chưa có giáo viên/nhân viên nào. Vui lòng quay lại sau.</h5></td></tr>';
                }
            } else {
                echo '<tr><td colspan="8"><h5 class="text-center text-muted">Hiện chưa có giáo viên/nhân viên nào. Vui lòng quay lại sau.</h5></td></tr>';   
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