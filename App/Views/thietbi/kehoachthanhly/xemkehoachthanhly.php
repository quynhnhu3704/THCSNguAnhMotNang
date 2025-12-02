<!-- App/Views/totruong/kehoachthanhly/xemkehoachthanhly.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cKeHoachThanhLy.php');
$p = new controlKeHoachThanhLy();

$maKeHoachThanhLy = $_GET['maKeHoachThanhLy'];

if(!$maKeHoachThanhLy) {
    echo "<script>alert('Không tìm thấy kế hoạch!'); window.location.href='index.php?page=dskehoachthanhly';</script>";
    exit();
}

$kq = $p->get01KeHoachThanhLy($maKeHoachThanhLy);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy kế hoạch!'); window.location.href='index.php?page=dskehoachthanhly';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 46rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Chi tiết kế hoạch thanh lý</h3>
            <!-- Họ tên -->
            <div class="mb-3">
                <label class="form-label fw-medium">Họ tên</label>
                <input type="text" class="form-control" value="<?php echo $r['hoTen']; ?>" disabled>
            </div>

            <!-- Vai trò -->
            <div class="mb-3">
                <label class="form-label fw-medium">Vai trò</label>
                <input type="text" class="form-control" value="<?php echo $r['tenVaiTro']; ?>" disabled>
            </div>

            <!-- Ngày lập -->
            <div class="mb-3">
                <label class="form-label fw-medium">Ngày lập</label>
                <input type="date" class="form-control" value="<?php echo $r['ngayLap']; ?>" disabled>
            </div>

            <h5 class="my-2 fw-semibold text-secondary text-center">Danh sách thiết bị</h5>
            <div class="d-flex justify-content-center mb-3">
                <div class="table-responsive text-center" style="width: 100%;">
                    <table class="table table-striped table-borderless align-middle" style="font-size: 0.85em;">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên thiết bị</th>
                                <th>Bộ môn</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $res = $p->get01ChiTietKHThanhLy($maKeHoachThanhLy);
                            $dem = 1;
                            while($row = $res->fetch_assoc()) {
                                echo '<tr>';
                                    echo '<td><strong>' . $dem++ . '</strong></td>';
                                    echo '<td title="'. $row['tenThietBi'] .'">' . $row['tenThietBi'] . '</td>';
                                    echo '<td>' . $row['tenBoMon'] . '</td>';
                                    echo '<td>' . $row['soLuong'] . '</td>';
                                    echo '<td>' . number_format($row['donGia'], 0, ',', '.') . ' ₫</td>';
                                    echo '<td>' . number_format($row['thanhTien'], 0, ',', '.') . ' ₫</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tổng chi phí -->
            <div class="mb-3">
                <label class="form-label fw-medium">Tổng thu nhập</label>
                <input type="text" class="form-control" value="<?php echo number_format($r['tongThuNhap'], 0, ',', '.') . ' ₫'; ?>" disabled>
            </div>

            <!-- Trạng thái -->
            <div class="mb-3">
                <label class="form-label fw-medium">Trạng thái</label>
                <input type="text" class="form-control" value="<?php echo $r['trangThai']; ?>" disabled>
            </div>

            <!-- Ghi chú -->
            <div class="mb-3">
                <label class="form-label fw-medium">Ghi chú</label>
                <textarea class="form-control" rows="3" style="resize: none;" disabled><?php echo $r['ghiChu']; ?></textarea>
            </div>
        </div>
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