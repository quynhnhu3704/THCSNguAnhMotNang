<!-- App/Views/thietbi/baohong/baohongthietbi.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 4) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}

include_once('App/Controllers/cYeuCauSCBTBH.php');
$p = new controlYeuCauSCBTBH();

$maYeuCau = $_GET['maYeuCau'];

if(!$maYeuCau) {
    echo "<script>alert('Không tìm thấy yêu cầu.'); window.location.href='index.php?page=dsghinhan';</script>";
    exit();
}

$kq = $p->get01YeuCauSCBTBH($maYeuCau);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy yêu cầu.'); window.location.href='index.php?page=dsghinhan';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsghinhan'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Ghi nhận yêu cầu</h3>

            <form action="#" method="post" enctype="multipart/form-data" spellcheck="false">
                <!-- Tên thiết bị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên thiết bị</label>
                    <input type="text" value="<?= $r['tenThietBi'] ?>" class="form-control" disabled>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Hình ảnh</label><br>
                    <img src="public/uploads/<?= $r['hinhAnh'] ?>" width="150" height="150" class="rounded-4 mb-2">
                </div>

                <!-- Đơn vị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Đơn vị</label>
                    <input type="text" value="<?= $r['donVi'] ?>" class="form-control" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" value="<?= $r['tenBoMon'] ?>" class="form-control" disabled>
                </div>
                
                <!-- Nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Nhà cung cấp</label>
                    <input type="text" value="<?= $r['tenNhaCungCap'] ?>" class="form-control" disabled>
                </div>
                
                <!-- Loại yêu cầu -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Loại yêu cầu <span class="text-danger">*</span></label>
                    <select name="loaiYeuCau" class="form-select" required>
                        <option value="" disabled selected>-- Chọn loại yêu cầu --</option>
                        <option value="Sửa chữa" <?= ($r["loaiYeuCau"] == 'Sửa chữa') ? 'selected' : '' ?>>Sửa chữa</option>
                        <option value="Bảo trì" <?= ($r["loaiYeuCau"] == 'Bảo trì') ? 'selected' : '' ?>>Bảo trì</option>
                        <option value="Bảo hành" <?= ($r["loaiYeuCau"] == 'Bảo hành') ? 'selected' : '' ?>>Bảo hành</option>
                    </select>
                </div>

                <!-- Tiến độ -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tiến độ <span class="text-danger">*</span></label>
                    <input type="text" value="Chờ xác nhận" class="form-control" readonly>
                </div>

                <!-- Ghi chú -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Ghi chú</label>
                    <textarea name="ghiChu" class="form-control" rows="3" placeholder="Mô tả tình trạng thiết bị và nội dung sửa chữa..." style="resize:none;"><?= $r['ghiChu'] ?></textarea>
                </div>

                <!-- Nút submit/reset -->
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="submit" name="btnluu" class="btn btn-primary w-100">Lưu</button>
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
$p = new controlYeuCauSCBTBH();

if(isset($_POST['btnluu'])) {
    $loaiYeuCau = trim($_POST['loaiYeuCau']);
    $ghiChu = trim($_POST['ghiChu']);
    
    if($p->updateYeuCauSCBTBH($maYeuCau, $loaiYeuCau, "Chờ xác nhận", $ghiChu)) {
        echo '<script>alert("Yêu cầu đã được ghi nhận thành công."); window.location.href="index.php?page=dsghinhan";</script>';
    } else {
        echo '<script>alert("Ghi nhận yêu cầu thất bại. Vui lòng thử lại."); window.history.back();</script>';
    }
}
?>