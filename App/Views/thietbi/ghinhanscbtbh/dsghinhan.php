<!-- App/Views/thietbi/ghinhanscbtbh/dsghinhan.php -->
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

<h2 class="text-center fw-semibold my-3">Danh sách yêu cầu sửa chữa - bảo trì - bảo hành</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get" spellcheck="false">
        <input type="hidden" name="page" value="dsghinhan"> <!-- Submit sẽ tạo URL: index.php?page=dsghinhan&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm yêu cầu..." style="width: 220px;">
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
                    <th>Bộ môn</th>
                    <th>Nhà cung cấp</th>
                    <th>Loại yêu cầu</th>
                    <th>Tiến độ</th>
                    <th>Ghi chú</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cYeuCauSCBTBH.php');
            $p = new controlYeuCauSCBTBH();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchYeuCauSCBTBH($keyword);
            } else {
                $kq = $p->getAllYeuCauSCBTBH();
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
                        echo '<td class="text-center">' . $r['tenBoMon'] . '</td>';
                        echo '<td class="text-center">' . $r['tenNhaCungCap'] . '</td>';

                        echo '<td class="text-center">';
                            echo ($r['loaiYeuCau'] === NULL) ? '—' : $r['loaiYeuCau'];
                        echo '</td>';
                        
                        echo '<td class="text-center">';
                            switch ($r['tienDo']) {
                                case "Chờ xác nhận": echo '<span class="badge bg-secondary">' . $r['tienDo'] . '</span>'; break;
                                case "Đang xử lý": echo '<span class="badge bg-warning text-dark">' . $r['tienDo'] . '</span>'; break;
                                case "Đã sửa": echo '<span class="badge bg-success">' . $r['tienDo'] . '</span>'; break;
                                case "Không thể sửa": echo '<span class="badge bg-danger">' . $r['tienDo'] . '</span>'; break;
                                default: echo '—';
                            }
                        echo '</td>';

                        echo '<td>' . $r['ghiChu'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=ghinhanyeucau&maYeuCau=' . $r['maYeuCau'] . '" class="btn btn-sm btn-warning" style="font-size: 0.95em;"><i class="bi bi-pencil-square"></i> Ghi nhận</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="11"><h5 class="text-center text-muted">Hiện chưa có yêu cầu nào. Vui lòng quay lại sau.</h5></td></tr>';   
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