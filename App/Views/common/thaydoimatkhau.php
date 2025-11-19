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
            <h3 class="text-center mb-4 fw-bold text-primary">Thay đổi mật khẩu</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu hiện tại</label>
                    <input type="password" name="matKhauHienTai" value="123456" class="form-control" required>
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu mới</label>
                    <input type="password" name="matKhauMoi" value="123" class="form-control" required>
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Xác nhận mật khẩu mới</label>
                    <input type="password" name="xacNhanMatKhauMoi" value="123" class="form-control" required>
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
    $matKhauHienTai = trim($_POST['matKhauHienTai']);
    $matKhauMoi = trim($_POST['matKhauMoi']);
    $xacNhanMatKhauMoi = trim($_POST['xacNhanMatKhauMoi']);
    
    if(md5($matKhauHienTai) != $r['matKhau']) {
        echo '<script>alert("Mật khẩu hiện tại không đúng!"); window.location.href="index.php?page=thaydoimatkhau";</script>';
        exit();
    } else if($matKhauMoi != $xacNhanMatKhauMoi) {
        echo '<script>alert("Mật khẩu mới và xác nhận mật khẩu mới không khớp!"); window.location.href="index.php?page=thaydoimatkhau";</script>';
        exit();
    } else if(md5($matKhauMoi) == $r['matKhau']) {
        echo '<script>alert("Mật khẩu mới không được trùng với mật khẩu hiện tại!"); window.location.href="index.php?page=thaydoimatkhau";</script>';
        exit();
    } else {
        if($p->updateMatKhau($maNguoiDung, $matKhauMoi)) {
            session_unset(); // Xóa tất cả biến phiên hiện tại
            session_destroy(); // Hủy phiên hiện tại
            echo '<script>alert("Cập nhật thành công! Vui lòng đăng nhập lại."); window.location.href="index.php?page=dangnhap";</script>';
        } else {
            echo '<script>alert("Cập nhật thất bại!"); window.history.back();</script>';
        }
    }
}
?>