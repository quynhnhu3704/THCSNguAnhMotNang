<!-- App/Views/giaovien/phieumuon_canhan/dsphieumuon_canhan.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 2 && $_SESSION['maVaiTro'] != 3) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}
?>

<h2 class="text-center fw-semibold my-3">Danh sách phiếu mượn của tôi</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get" spellcheck="false">
        <input type="hidden" name="page" value="dsphieumuon_canhan"> <!-- Submit sẽ tạo URL: index.php?page=dsphieumuon_canhan&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm phiếu mượn..." style="width: 220px;">
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
                    <th>Ngày mượn</th>
                    <th>Ngày trả</th>
                    <th>Trạng thái</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cPhieuMuon.php');
            $p = new controlPhieuMuon();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchPhieuMuon($keyword);
            } else {
                $kq = $p->getAllPhieuMuon();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    // BỎ QUA nếu không phải phiếu của người dùng đang đăng nhập
                    if ($r['maNguoiDung'] != $_SESSION['maNguoiDung']) continue;

                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['hoTen'] . '</td>';
                        echo '<td class="text-center">' . $r['tenVaiTro'] . '</td>';
                        echo '<td class="text-center">' . $r['tenBoMon'] . '</td>';
                        echo '<td class="text-center">' . $r['soLuongMuon'] . '</td>';
                        echo '<td class="text-center">' . $r['ngayMuon'] . '</td>';
                        echo '<td class="text-center">' . $r['ngayTra'] . '</td>';

                        echo '<td class="text-center">';
                            switch ($r['trangThai']) {
                                case "Chờ xử lý": echo '<span class="badge bg-secondary">' . $r['trangThai'] . '</span>'; break;
                                case "Đã xác nhận": echo '<span class="badge bg-info text-dark">' . $r['trangThai'] . '</span>'; break;
                                case "Đang mượn": echo '<span class="badge bg-warning text-dark">' . $r['trangThai'] . '</span>'; break;
                                case "Đã trả": echo '<span class="badge bg-success">' . $r['trangThai'] . '</span>'; break; 
                                default: echo '<span class="badge bg-light text-dark">Không xác định</span>';
                            }
                        echo '</td>';

                        echo '<td>' . $r['ghiChu'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=xemphieumuon_canhan&maPhieuMuon=' . $r['maPhieuMuon'] . '" class="btn btn-sm btn-info" style="font-size: 0.95em;"><i class="bi bi-info-circle"></i> Xem</a>&nbsp;';
                            if ($r['trangThai'] == "Chờ xử lý") {
                                echo '<a href="index.php?page=xoaphieumuon_canhan&action=delete&maPhieuMuon=' . $r['maPhieuMuon'] . '" class="btn btn-sm btn-danger" style="font-size: 0.95em;" onclick="return confirm(\'Bạn có chắc muốn xóa phiếu mượn này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                            }
                        echo '</td>';
                    echo '</tr>';
                } if ($dem == 0) {
                    echo '<tr><td colspan="10"><h5 class="text-center text-muted">Hiện chưa có phiếu mượn nào. Vui lòng quay lại sau.</h5></td></tr>';
                }
            } else {
                echo '<tr><td colspan="10"><h5 class="text-center text-muted">Hiện chưa có phiếu mượn nào. Vui lòng quay lại sau.</h5></td></tr>';   
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