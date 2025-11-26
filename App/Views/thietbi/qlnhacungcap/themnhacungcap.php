<!-- App/Views/thietbi/qlnhacungcap/themnhacungcap.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsnhacungcap'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thêm nhà cung cấp</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên nhà cung cấp <span class="text-danger">*</span></label>
                    <input type="text" name="tenNhaCungCap" value="Ngũ Anh Một Nàng" class="form-control" required>
                </div>

                <!-- Địa chỉ -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" name="diaChi" value="12 Nguyễn Văn Bảo, TP.HCM" class="form-control" required>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="tel" name="soDienThoai" value="0923456123" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="nguanhmotnang@gmail.com" class="form-control" required>
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
include_once('App/Controllers/cNhaCungCap.php');
$p = new controlNhaCungCap();

if(isset($_POST['btnluu'])) {
    $tenNhaCungCap = trim($_POST['tenNhaCungCap']);
    $diaChi = trim($_POST['diaChi']);
    $soDienThoai = trim($_POST['soDienThoai']);
    $email = trim($_POST['email']);

    if($p->checkName($tenNhaCungCap)) {
        echo '<script>alert("Tên nhà cung cấp đã tồn tại!"); window.location.href="index.php?page=themnhacungcap";</script>';
    } else {
        if($p->insertNhaCungCap($tenNhaCungCap, $diaChi, $soDienThoai, $email)) {
            echo '<script>alert("Thêm thành công!"); window.location.href="index.php?page=dsnhacungcap";</script>';
        } else {
            echo '<script>alert("Thêm thất bại!"); window.history.back();</script>';
        }
    }
}
?>