<!-- App/Views/totruong/kehoachmuasam/dskehoachmuasam.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 2 && $_SESSION['maVaiTro'] != 4) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}
?>

<h2 class="text-center fw-semibold my-3">Danh sách kế hoạch mua sắm</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Nút thêm -->
    <a href="index.php?page=themkehoachmuasam" class="btn btn-primary fw-semibold"><i class="bi bi-database-add me-1"></i> Thêm kế hoạch</a>

    <!-- Thanh tìm kiếm -->
    <form class="d-flex" action="index.php" method="get" spellcheck="false">
        <input type="hidden" name="page" value="dskehoachmuasam"> <!-- Submit sẽ tạo URL: index.php?page=dskehoachmuasam&keyword=xxxxx -->

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
                    <th>Bộ môn</th>
                    <th>Số lượng</th>
                    <th>Ngày lập</th>
                    <th>Tổng chi phí</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cKeHoachMuaSam.php');
            $p = new controlKeHoachMuaSam();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchKeHoachMuaSam($keyword);
            } else {
                $kq = $p->getAllKeHoachMuaSam();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    // Chỉ lấy kế hoạch thuộc bộ môn của người dùng đang đăng nhập
                    if ($r['maBoMon'] != $_SESSION['maBoMon']) continue;
                    
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['hoTen'] . '</td>';
                        echo '<td class="text-center">' . $r['tenVaiTro'] . '</td>';
                        echo '<td class="text-center">' . $r['tenBoMon'] . '</td>';
                        echo '<td class="text-center">' . $r['soLuongMuaSam'] . '</td>';
                        echo '<td class="text-center">' . $r['ngayLap'] . '</td>';
                        echo '<td class="text-end">' . number_format($r['tongChiPhi'], 0, ',', '.') . ' ₫</td>';

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
                            echo '<a href="index.php?page=xemkehoachmuasam&maKeHoachMuaSam=' . $r['maKeHoachMuaSam'] . '" class="btn btn-sm btn-info" style="font-size: 0.95em;"><i class="bi bi-info-circle"></i> Xem</a>&nbsp;';
                            if ($r['trangThai'] == "Chờ duyệt") {
                                echo '<a href="index.php?page=xoakehoachmuasam&action=delete&maKeHoachMuaSam=' . $r['maKeHoachMuaSam'] . '" class="btn btn-sm btn-danger" style="font-size: 0.95em;" onclick="return confirm(\'Bạn có chắc muốn xóa kế hoạch này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                            }
                        echo '</td>';
                    echo '</tr>';
                } if ($dem == 0) {
                    echo '<tr><td colspan="10"><h5 class="text-center text-muted">Hiện chưa có kế hoạch nào. Vui lòng quay lại sau.</h5></td></tr>';
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