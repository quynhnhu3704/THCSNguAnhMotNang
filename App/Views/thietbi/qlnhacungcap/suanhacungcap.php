<!-- App/Views/thietbi/qlnhacungcap/suanhacungcap.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cNhaCungCap.php');
$p = new controlNhaCungCap();

$maNhaCungCap = $_GET['maNhaCungCap'];

if(!$maNhaCungCap) {
    echo "<script>alert('Không tìm thấy nhà cung cấp.'); window.location.href='index.php?page=dsnhacungcap';</script>";
    exit();
}

$kq = $p->get01NhaCungCap($maNhaCungCap);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy nhà cung cấp.'); window.location.href='index.php?page=dsnhacungcap';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsnhacungcap'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Cập nhật nhà cung cấp</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên nhà cung cấp <span class="text-danger">*</span></label>
                    <input type="text" name="tenNhaCungCap" value="<?= $r['tenNhaCungCap'] ?>" class="form-control" required>
                </div>

                <!-- Địa chỉ -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" name="diaChi" value="<?= $r['diaChi'] ?>" class="form-control" required>
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
    $tenNhaCungCap = trim($_POST['tenNhaCungCap']);
    $diaChi = trim($_POST['diaChi']);
    $soDienThoai = trim($_POST['soDienThoai']);
    $email = trim($_POST['email']);
    
    if($p->updateNhaCungCap($maNhaCungCap, $tenNhaCungCap, $diaChi, $soDienThoai, $email)) {
        echo '<script>alert("Nhà cung cấp đã được cập nhật thành công."); window.location.href="index.php?page=dsnhacungcap";</script>';
    } else {
        echo '<script>alert("Cập nhật nhà cung cấp không thành công. Vui lòng thử lại."); window.history.back();</script>';
    }
}
?>

<script>
$(document).ready(function () {
    const $tenNCC = $('input[name="tenNhaCungCap"]');
    const $diaChi = $('input[name="diaChi"]');
    const $sdt = $('input[name="soDienThoai"]');
    const $email = $('input[name="email"]');

    // blur
    $tenNCC.blur(checkTenNCC);
    $diaChi.blur(checkDiaChi);
    $sdt.blur(checkSDT);
    $email.blur(checkEmail);

    // submit
    $('form').submit(function(e) {
        if(!(checkTenNCC() && checkDiaChi() && checkSDT() && checkEmail())) {
            e.preventDefault();
        }
    });

    // --- Hàm kiểm tra ---
    function checkTenNCC() {
        const val = $tenNCC.val().trim();
        const regex = /^[a-zA-ZÀ-ỹ\s]{1,255}$/; // chỉ chữ và khoảng trắng, tối đa 255

        if(val === "") return showError($tenNCC, 'Tên nhà cung cấp không được để trống!');
        if(val.length > 255) return showError($tenNCC, 'Tên nhà cung cấp quá dài. Tối đa 255 ký tự!');
        if(!regex.test(val)) return showError($tenNCC, 'Tên nhà cung cấp không được chứa số hoặc ký tự đặc biệt!');
        clearError($tenNCC);
        return true;
    }

    function checkDiaChi() {
        const val = $diaChi.val().trim();
        const regex = /^[a-zA-Z0-9À-ỹ\s.,\-]+$/; // chỉ chữ, số, khoảng trắng, dấu . , -

        if(val === "") return showError($diaChi, 'Địa chỉ không được để trống!');
        if(!regex.test(val)) return showError($diaChi, 'Địa chỉ chỉ được chứa chữ, số, khoảng trắng và dấu . , -');
        clearError($diaChi);
        return true;
    }

    function checkSDT() {
        const val = $sdt.val().trim();
        const regex = /^(03|05|07|08|09)\d{8}$/;

        if(val === "") return showError($sdt, 'Số điện thoại không được để trống!');
        if(!regex.test(val)) return showError($sdt, 'Số điện thoại không hợp lệ. Phải bắt đầu bằng 03, 05, 07, 08, 09 và đủ 10 số.');
        clearError($sdt);
        return true;
    }

    function checkEmail() {
        const val = $email.val().trim();
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // email cơ bản, phải có @ và .

        if(val === "") return showError($email, 'Email không được để trống!');
        if(!regex.test(val)) return showError($email, 'Email không hợp lệ. Phải có @ và dấu .');
        clearError($email);
        return true;
    }

    // --- Hàm hiển thị / xóa lỗi ---
    function showError($input, msg) {
        let $span = $input.next('.error');
        if($span.length === 0) $input.after('<span class="error text-danger"></span>');
        $input.next('.error').text(msg);
        $input.focus();
        return false;
    }

    function clearError($input) {
        $input.next('.error').text('');
    }
});
</script>