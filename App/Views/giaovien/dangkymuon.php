<!-- App/Views/giaovien/dangkymuon/dangkymuon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

// Lấy thông tin người dùng
$maNguoiDung = $_SESSION['maNguoiDung']; 
$r = $p->get01NguoiDung($maNguoiDung)->fetch_assoc();

// Lấy danh sách thiết bị từ session
$gioHang = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 50rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thông tin phiếu mượn</h3>

            <form action="#" method="post">
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
                            <input type="date" name="ngayMuon" id="ngayMuon" class="form-control" value="<?= date('Y-m-d') ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Ngày trả <span class="text-danger">*</span></label>
                            <input type="date" name="ngayTra" id="ngayTra" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            <span class="error" id="ngayTraError"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-medium">Ghi chú</label>
                            <textarea name="ghiChu" class="form-control" style="resize:none;" placeholder="Yêu cầu hoặc lưu ý đặc biệt..."></textarea>
                        </div>
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
                                        $soLuongKhaDung = $p->countSoLuongKhaDung($maThietBi)->fetch_assoc()['soLuongKhaDung'];
                                ?>
                                <tr>
                                    <td><strong><?= $dem++ ?></strong></td>
                                    <td><?= $r['tenThietBi'] ?></td>
                                    <td><?= $r['tenBoMon'] ?></td>
                                    <td>
                                        <input type="number" name="soLuong[<?= $maThietBi ?>]" value="<?= $soLuong ?>" min="1" max="<?= $soLuongKhaDung ?>" class="form-control text-center">
                                    </td>
                                    <td>
                                        <a href="index.php?page=dangkymuon&xoa=<?= $maThietBi ?>" class="btn btn-sm btn-danger" style="font-size: 0.95em;" onclick="return confirm('Bạn có chắc muốn xóa thiết bị này không?')"><i class="bi bi-trash"></i> Xóa</a>
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

    $maNguoiDung = $_SESSION['maNguoiDung'];
    $ngayMuon = $_POST['ngayMuon'];
    $ngayTra = $_POST['ngayTra'];
    $ghiChu = trim($_POST['ghiChu']);

    // Cập nhật SESSION số lượng trong giỏ mượn nếu có tăng/giảm, nếu không thì nó mặc định là 1 như lúc thêm vào giỏ
    if(isset($_POST['soLuong'])) {
        foreach($_POST['soLuong'] as $maTB => $sl) {
            $_SESSION['cart'][$maTB] = (int)$sl;
        }
    }

    // Kiểm tra giỏ mượn không được rỗng
    if(empty($_SESSION['cart'])) {
        echo "<script>alert('Phiếu mượn trống. Vui lòng chọn thiết bị trước khi đăng ký.'); window.history.back();</script>";
        exit();
    }

    $maPhieuMuon = $p->insertPhieuMuon($maNguoiDung, date('Y-m-d'), $ngayTra, "Chờ xử lý", $ghiChu);

    if($maPhieuMuon) {
        // truyền toàn bộ giỏ mượn làm mảng
        if($p->insertChiTietPM($maPhieuMuon, $_SESSION['cart'])) {
            unset($_SESSION['cart']); // xóa giỏ mượn sau khi đăng ký thành công
            echo "<script>alert('Phiếu mượn đã được đăng ký thành công!'); window.location.href='index.php?page=dsphieumuon_canhan';</script>";
        } else {
            $p->deletePhieuMuon($maPhieuMuon); // rollback phiếu mượn
            echo "<script>alert('Không đủ số lượng thiết bị khả dụng. Vui lòng kiểm tra lại.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Đăng ký phiếu mượn không thành công. Vui lòng thử lại.'); window.history.back();</script>";
    }
}
?>

<!-- Xóa thiết bị khỏi giỏ mượn -->
<?php
if(isset($_GET['xoa'])) {
    $maThietBi = $_GET['xoa'];
    if(isset($_SESSION['cart'][$maThietBi])) {
        unset($_SESSION['cart'][$maThietBi]);
    }
    header("Location: index.php?page=dangkymuon"); // load lại trang
    exit();
}
?>

<style>
    th, td {
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>

<script>
// Ràng buộc JQuery ngày trả phải sau ngày mượn
$(document).ready(function () {
    $('#ngayMuon, #ngayTra').change(checkNgayTra);

    $('form').submit(function(e) {
        if(!checkNgayTra()) e.preventDefault();
    });

    function checkNgayTra() {
        const ngayMuon = $('#ngayMuon').val();
        const ngayTra = $('#ngayTra').val();

        if(!ngayMuon || !ngayTra) return true; // chưa nhập đủ

        if(new Date(ngayTra) <= new Date(ngayMuon)) {
            showError('#ngayTraError', 'Ngày trả phải sau ngày mượn!');
            return false;
        } else {
            clearError('#ngayTraError');
            return true;
        }
    }

    function showError(elem, msg) {
        $(elem).text(msg);
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
    }
});
</script>