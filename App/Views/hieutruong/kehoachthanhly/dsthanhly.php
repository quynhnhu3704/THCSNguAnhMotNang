<!-- App/Views/totruong/kehoachthanhly/dskehoachthanhly.php -->
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

<h2 class="text-center fw-semibold my-3">Danh sách kế hoạch thanh lý</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get">
        <input type="hidden" name="page" value="dsthanhly"> <!-- Submit sẽ tạo URL: index.php?page=dsthanhly&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm kế hoạch..." style="width: 220px;">
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
                    <th>Số lượng</th>
                    <th>Ngày lập</th>
                    <th>Tổng thu nhập</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cKeHoachThanhLy.php');
            $p = new controlKeHoachThanhLy();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchKeHoachThanhLy($keyword);
            } else {
                $kq = $p->getAllKeHoachThanhLy();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['hoTen'] . '</td>';
                        echo '<td class="text-center">' . $r['tenVaiTro'] . '</td>';
                        echo '<td class="text-center">' . $r['soLuongThanhLy'] . '</td>';
                        echo '<td class="text-center">' . $r['ngayLap'] . '</td>';
                        echo '<td class="text-end">' . number_format($r['tongThuNhap'], 0, ',', '.') . ' ₫</td>';

                        echo '<td class="text-center">';
                            switch ($r['trangThai']) {
                                case "Chờ duyệt": echo '<span class="badge bg-warning text-dark">' . $r['trangThai'] . '</span>'; break;
                                case "Chấp thuận": echo '<span class="badge bg-success">' . $r['trangThai'] . '</span>'; break;
                                case "Từ chối": echo '<span class="badge bg-danger">' . $r['trangThai'] . '</span>'; break;
                                default: echo '<span class="badge bg-light text-dark">Không xác định</span>';
                            }
                        echo '</td>';

                        echo '<td>' . $r['ghiChu'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=xemthanhly&maKeHoachThanhLy=' . $r['maKeHoachThanhLy'] . '" class="btn btn-sm btn-info" style="font-size: 0.95em;"><i class="bi bi-info-circle"></i> Xem</a>&nbsp;';
                            echo '<a href="index.php?page=duyetkehoachthanhly&maKeHoachThanhLy=' . $r['maKeHoachThanhLy'] . '" class="btn btn-sm btn-warning" style="font-size: 0.95em;"><i class="bi bi-clipboard-check"></i> Duyệt</a>&nbsp;';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="10"><h5 class="text-center text-muted">Hiện chưa có kế hoạch nào. Vui lòng quay lại sau.</h5></td></tr>';   
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