<!-- App/Views/giaovien/dangkymuon/dangkymuon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

// Lấy thông tin người dùng
$maNguoiDung = $_SESSION['maNguoiDung']; 
$r = $p->get01NguoiDung($maNguoiDung)->fetch_assoc();

// Lấy danh sách thiết bị từ session
$gioHang = isset($_SESSION['gioHangMuon']) ? $_SESSION['gioHangMuon'] : [];
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsthietbi'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 50rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thông tin phiếu mượn</h3>

            <form action="index.php?page=xulydangkymuon" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Tên người mượn</label>
                            <input type="text" class="form-control" value="<?= $r['hoTen'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Vai trò</label>
                            <input type="text" class="form-control" value="<?= $r['tenVaiTro'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Bộ môn</label>
                            <input type="text" class="form-control" value="<?= $r['tenBoMon'] ?>" disabled>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label fw-medium">Ngày mượn</label>
                            <input type="date" name="ngayMuon" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Ngày trả</label>
                            <input type="date" name="ngayTra" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Ghi chú</label>
                            <textarea name="ghiChu" class="form-control" style="resize:none;" placeholder="Ghi chú thông tin phiếu mượn..."></textarea>
                        </div>
                    </div>

                <h5 class="my-2 fw-semibold text-secondary text-center">Danh sách thiết bị</h5>
                <div class="d-flex justify-content-center mb-3">
                    <div class="table-responsive text-center" style="width: 100%;">
                        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên thiết bị</th>
                                    <th>Bộ môn</th>
                                    <th>Số lượng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                include_once('App/Controllers/cThietBi.php');
                                $p = new controlThietBi();

                                if(!empty($gioHang)) {
                                    $dem = 1;
                                    foreach($gioHang as $maThietBi => $soLuong) {
                                        $r = $p->get01ThietBi($maThietBi)->fetch_assoc();
                                ?>
                                <tr>
                                    <td><?= $dem++ ?></td>
                                    <td><?= $r['tenThietBi'] ?></td>
                                    <td><?= $r['tenBoMon'] ?></td>
                                    <td>
                                        <input type="number" name="soLuong[<?= $maThietBi ?>]" value="<?= $soLuong ?>" min="1" max="<?= $r['soLuong'] ?>" class="form-control text-center">
                                    </td>
                                    <td>
                                        <a href="index.php?page=xoathietbophieumuon&action=delete&maThietBi=<?= $maThietBi ?>" class="btn btn-sm btn-danger" style="font-size: 0.95em;" onclick="return confirm('Bạn có chắc muốn xóa thiết bị này không?')"><i class="bi bi-trash"></i> Xóa</a>
                                    </td>
                                </tr>
                                <?php 
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="5"><h5 class="text-center text-muted">Chưa có thiết bị nào trong phiếu mượn!</h5></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="submit" name="btnXacNhan" class="btn btn-primary w-100">Xác nhận</button>
                    </div>
                    <div class="col-6 mb-2">
                        <button type="reset" class="btn btn-outline-secondary w-100">Đặt lại</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
if(isset($_POST['btnXacNhan'])) {
    include_once('App/Controllers/cPhieuMuon.php');
    $p = new controlPhieuMuon();

    $maNguoiDung = $_SESSION['maNguoiDung']; // mã người đang đăng nhập
    $ngayMuon = $_POST['ngayMuon'];
    $ngayTra = $_POST['ngayTra'];
    $ghiChu = trim($_POST['ghiChu']);

    // Kiểm tra tính hợp lệ
    $today = date('Y-m-d');
    if($ngayMuon < $today) {
        echo "<script>alert('Ngày mượn không được trước ngày hiện tại'); window.history.back();</script>";
        exit();
    }
    if($ngayTra < $ngayMuon) {
        echo "<script>alert('Ngày trả phải sau ngày mượn'); window.history.back();</script>";
        exit();
    }

    // Lưu phiếu mượn
    $maPhieuMuon = $p->insertPhieuMuon($maNguoiDung, $ngayMuon, $ngayTra, $trangThai, $ghiChu);

    if($maPhieuMuon) {
        // Lưu chi tiết phiếu mượn
        foreach($_SESSION['gioHangMuon'] as $maThietBi => $soLuong) {
            $p->insertChiTietPM($maPhieuMuon, $maThietBi, $soLuong);
        }
        unset($_SESSION['gioHangMuon']); // clear session
        echo "<script>alert('Đăng ký mượn thành công!'); window.location.href='index.php?page=phieumuon';</script>";
    } else {
        echo "<script>alert('Đăng ký thất bại!'); window.history.back();</script>";
    }
}
?>

<style>
    th, td {
        border: 1px solid #ddd;
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>