<!-- App/Views/admin/qlnguoidung/themnguoidung.php -->
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

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsnguoidung'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thêm người dùng</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="tenDangNhap" value="nguanhmotnang" class="form-control" required>
                </div>
                
                <!-- Mật khẩu tạm thời -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu tạm thời <span class="text-danger">*</span></label>
                    <input type="password" name="matKhauTamThoi" value="123456" class="form-control" required>
                </div>

                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoTen" value="Ngũ Anh Một Nàng" class="form-control" required>
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò <span class="text-danger">*</span></label>
                    <select name="maVaiTro" class="form-select" required>
                        <option value="" disabled selected>-- Chọn vai trò --</option>
                        <?php
                        include_once('App/Controllers/cVaiTro.php');
                        $p = new controlVaiTro();
                        $kq = $p->getAllVaiTro();
                        while ($r = $kq->fetch_assoc()) {
                            echo "<option value='{$r['maVaiTro']}'>{$r['tenVaiTro']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn <span class="text-danger">*</span></label>
                    <select name="maBoMon" id="selectBoMon" class="form-select" required>
                        <option value="" disabled selected>-- Chọn bộ môn --</option>
                        <?php
                        include_once('App/Controllers/cBoMon.php');
                        $p = new controlBoMon();
                        $kq = $p->getAllBoMon();
                        while ($r = $kq->fetch_assoc()) {
                            echo "<option value='{$r['maBoMon']}'>{$r['tenBoMon']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="nguanhmotnang@gmail.com" class="form-control" required>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="tel" name="soDienThoai" value="0908000003" class="form-control" required>
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
include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

if(isset($_POST['btnluu'])) {
    $tenDangNhap = trim($_POST['tenDangNhap']);
    $hoTen = trim($_POST['hoTen']);
    $matKhauTamThoi = trim($_POST['matKhauTamThoi']);
    $soDienThoai = trim($_POST['soDienThoai']);
    $email = trim($_POST['email']);
    $maVaiTro = trim($_POST['maVaiTro']);

    $maBoMon = $_POST['maBoMon'] ?? null;
    if ($maVaiTro != 2 && $maVaiTro != 3) {
        $maBoMon = "NULL";
    }

    if($p->checkName($tenDangNhap)) {
        echo '<script>alert("Tên đăng nhập đã tồn tại!"); window.location.href="index.php?page=themnguoidung";</script>';
    } else {
        if($p->insertNguoiDung($tenDangNhap, $hoTen, $matKhauTamThoi, $soDienThoai, $email, $maVaiTro, $maBoMon)) {
            echo '<script>alert("Thêm thành công!"); window.location.href="index.php?page=dsnguoidung";</script>';
        } else {
            echo '<script>alert("Thêm thất bại!"); window.history.back();</script>';
        }
    }
}
?>

<script>
    function checkBoMon() {
        const vaiTro = document.querySelector('select[name="maVaiTro"]').value;
        const boMon = document.getElementById('selectBoMon');

        if (vaiTro == "2" || vaiTro == "3") {
            boMon.disabled = false;
            boMon.required = true;
        } else {
            boMon.disabled = true;
            boMon.required = false;
            boMon.value = "";   // clear để không gửi dữ liệu
        }
    }

    document.addEventListener("DOMContentLoaded", checkBoMon);
    document.querySelector('select[name="maVaiTro"]').addEventListener("change", checkBoMon);
</script>