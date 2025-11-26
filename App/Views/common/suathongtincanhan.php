<!-- App/Views/common/suathongtincanhan.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_SESSION['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=thongtincanhan';</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=thongtincanhan';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=thongtincanhan'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Chỉnh sửa thông tin cá nhân</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="tenDangNhap" value="<?= $r['tenDangNhap'] ?>" class="form-control" required>
                </div>

                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoTen" value="<?= $r['hoTen'] ?>" class="form-control" required>
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò</label>
                    <input type="text" class="form-control" name="maVaiTro" value="<?php echo $r['tenVaiTro']; ?>" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" class="form-control" name="maBoMon" value="<?php echo $r['tenBoMon']; ?>" disabled>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="tel" name="soDienThoai" value="<?= $r['soDienThoai'] ?>" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="<?= $r['email'] ?>" class="form-control" required>
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
if(isset($_POST['btnluu'])) {
    $tenDangNhap = trim($_POST['tenDangNhap']);
    $hoTen = trim($_POST['hoTen']);
    $soDienThoai = trim($_POST['soDienThoai']);
    $email = trim($_POST['email']);
    
    if($p->updateThongTinCaNhan($maNguoiDung, $tenDangNhap, $hoTen, $soDienThoai, $email)) {
        // Cập nhật session ngay lập tức
        $_SESSION['tenDangNhap'] = $tenDangNhap;
        
        echo '<script>alert("Cập nhật thông tin cá nhân thành công!"); window.location.href="index.php?page=thongtincanhan";</script>';
    } else {
        echo '<script>alert("Cập nhật thông tin cá nhân thất bại!"); window.history.back();</script>';
    }
}
?>