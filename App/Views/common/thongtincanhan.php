<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_SESSION['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng!'); window.history.back();</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.history.back();</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thông tin cá nhân</h3>

            <!-- Tên đăng nhập -->
            <div class="mb-3">
                <label class="form-label fw-medium">Tên đăng nhập</label>
                <input type="text" class="form-control" name="tenDangNhap" value="<?php echo $r['tenDangNhap']; ?>" disabled>
            </div>

            <!-- Họ tên -->
            <div class="mb-3">
                <label class="form-label fw-medium">Họ tên</label>
                <input type="text" class="form-control" name="hoTen" value="<?php echo $r['hoTen']; ?>" disabled>
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
                <label class="form-label fw-medium">Số điện thoại</label>
                <input type="text" class="form-control" name="soDienThoai" value="<?php echo $r['soDienThoai']; ?>" disabled>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label fw-medium">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $r['email']; ?>" disabled>
            </div>

            <!-- Nút chỉnh sửa -->
            <div class="text-center mb-2">
                <a href="index.php?page=suathongtincanhan" class="btn btn-outline-primary fw-semibold"><i class="bi bi-pencil-square me-2"></i>Chỉnh sửa</a>
            </div>
        </div>
    </div>
</div>