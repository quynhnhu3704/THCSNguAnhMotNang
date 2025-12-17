<!-- App/Views/thietbi/baohong/dsbaohong.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 4) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}
?>

<h2 class="text-center fw-semibold my-3">Danh sách thiết bị chi tiết</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get">
        <input type="hidden" name="page" value="dsbaohong"> <!-- Submit sẽ tạo URL: index.php?page=dsbaohong&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm thiết bị..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>


<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên thiết bị</th>
                    <th>Hình ảnh</th>
                    <th>Đơn vị</th>
                    <th>Lớp</th>
                    <th>Bộ môn</th>
                    <th>Nhà cung cấp</th>
                    <th>Tình trạng</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cThietBi.php');
            $p = new controlThietBi();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchChiTietTB($keyword);
            } else {
                $kq = $p->getAllChiTietTB();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td title="'.$r['tenThietBi'].'">' . $r['tenThietBi'] . '</td>';
                        echo '<td><img src="public/uploads/' . $r['hinhAnh'] . '" width="40" height="40" class="rounded d-block mx-auto"></td>';
                        echo '<td class="text-center">' . $r['donVi'] . '</td>';
                        echo '<td class="text-center">' . $r['lop'] . '</td>';
                        echo '<td class="text-center">' . $r['tenBoMon'] . '</td>';
                        echo '<td class="text-center">' . $r['tenNhaCungCap'] . '</td>';
                        
                        echo '<td class="text-center">';
                            switch ($r['tinhTrang']) {
                                case "Khả dụng": echo '<span class="badge bg-success">' . $r['tinhTrang'] . '</span>'; break;
                                case "Đang mượn": echo '<span class="badge bg-warning text-dark">' . $r['tinhTrang'] . '</span>'; break;
                                case "Thanh lý": echo '<span class="badge bg-secondary">' . $r['tinhTrang'] . '</span>'; break;
                                case "Báo hỏng": echo '<span class="badge bg-danger">' . $r['tinhTrang'] . '</span>'; break;
                                default: echo '<span class="badge bg-light text-dark">Không xác định</span>';
                            }
                        echo '</td>';

                        echo '<td>' . $r['ghiChu'] . '</td>';

                        echo '<td class="text-center">';
                            if($r['tinhTrang'] == "Khả dụng") {
                                echo '<a href="index.php?page=baohongthietbi&maChiTietTB=' . $r['maChiTietTB'] . '" class="btn btn-sm btn-warning" style="font-size: 0.95em;"><i class="bi bi-exclamation-triangle-fill"></i> Báo hỏng</a>';
                            }
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="11"><h5 class="text-center text-muted">Hiện chưa có thiết bị nào. Vui lòng quay lại sau.</h5></td></tr>';   
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