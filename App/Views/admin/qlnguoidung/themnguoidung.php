<!-- App/Views/admin/qlnguoidung/themnguoidung.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 6) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsnguoidung'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thêm người dùng</h3>

            <form action="#" method="post" enctype="multipart/form-data" spellcheck="false">
                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="tenDangNhap" value="nguanhmotnang" class="form-control" required>
                </div>
                
                <!-- Mật khẩu tạm thời -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu tạm thời <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="matKhauTamThoi" value="Nguanhmotnang123@" class="form-control" required>
                        <span class="input-group-text" style="cursor: pointer;"><i class="bi bi-eye-slash toggle-pass"></i></span>
                    </div>
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
        echo '<script>alert("Tên đăng nhập này đã được sử dụng. Vui lòng chọn tên khác!"); window.history.back();</script>';
    } else {
        if($p->insertNguoiDung($tenDangNhap, $hoTen, $matKhauTamThoi, $soDienThoai, $email, $maVaiTro, $maBoMon)) {
            echo '<script>alert("Thêm người dùng thành công."); window.location.href="index.php?page=dsnguoidung";</script>';
        } else {
            echo '<script>alert("Thêm người dùng thất bại! Vui lòng thử lại."); window.history.back();</script>';
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

<script>
$(document).ready(function () {
    const $tenDangNhap = $('input[name="tenDangNhap"]');
    const $hoTen = $('input[name="hoTen"]');
    const $soDienThoai = $('input[name="soDienThoai"]');
    const $email = $('input[name="email"]');
    const $matKhau = $('input[name="matKhauTamThoi"]');

    // blur
    $tenDangNhap.blur(checkTenDangNhap);
    $hoTen.blur(checkHoTen);
    $soDienThoai.blur(checkSDT);
    $email.blur(checkEmail);
    $matKhau.blur(checkMatKhau);

    // submit
    $('form').submit(function(e) {
        if(!(checkTenDangNhap() && checkHoTen() && checkSDT() && checkEmail() && checkMatKhau())) {
            e.preventDefault();
        }
    });

    // --- Hàm kiểm tra ---
    function checkTenDangNhap() {
        const val = $tenDangNhap.val().trim();
        const regex = /^[a-zA-Z0-9_.]+$/;

        if(val === "") return showError($tenDangNhap, 'Tên đăng nhập không được để trống!');
        if(val.length > 255) return showError($tenDangNhap, 'Tên đăng nhập quá dài. Tối đa 255 ký tự!');
        if(!regex.test(val)) return showError($tenDangNhap, 'Tên đăng nhập không hợp lệ. Chỉ dùng chữ, số, dấu _ hoặc .');
        clearError($tenDangNhap);
        return true;
    }

    function checkHoTen() {
        const val = $hoTen.val().trim();
        const regex = /^[a-zA-ZÀ-ỹ\s]+$/;

        if(val === "") return showError($hoTen, 'Họ tên không được để trống!');
        if(val.length > 255) return showError($hoTen, 'Họ tên quá dài. Tối đa 255 ký tự!');
        if(!regex.test(val)) return showError($hoTen, 'Họ tên không được chứa ký tự đặc biệt hoặc số!');

        // Kiểm tra chữ hoa đầu mỗi từ
        const words = val.split(/\s+/);
        for(let word of words) {
            if(word[0] !== word[0].toUpperCase()) {
                return showError($hoTen, 'Chữ cái đầu mỗi từ trong họ tên phải viết hoa!');
            }
        }
        clearError($hoTen);
        return true;
    }

    function checkSDT() {
        const val = $soDienThoai.val().trim();
        const regex = /^(03|05|07|08|09)\d{8}$/;

        if(val === "") return showError($soDienThoai, 'Số điện thoại không được để trống!');
        if(!regex.test(val)) return showError($soDienThoai, 'Số điện thoại không hợp lệ. Phải bắt đầu bằng 03, 05, 07, 08, 09 và đủ 10 số.');
        clearError($soDienThoai);
        return true;
    }

    function checkEmail() {
        const val = $email.val().trim();
        const regex = /^[^\s@]+@(truong\.edu\.vn|gmail\.com|yahoo\.com)$/;

        if(val === "") return showError($email, 'Email không được để trống!');
        if(!regex.test(val)) return showError($email, 'Email không hợp lệ. Chỉ chấp nhận @truong.edu.vn, @gmail.com, @yahoo.com.');
        clearError($email);
        return true;
    }

    function checkMatKhau() {
        const val = $matKhau.val().trim();
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{6,}$/;

        if(val === "") return showError($matKhau, 'Mật khẩu tạm thời không được để trống!');
        if(!regex.test(val)) return showError($matKhau, 
            'Mật khẩu phải có ít nhất 6 ký tự, bao gồm 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt!');
        clearError($matKhau);
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

    // Ẩn/hiện mật khẩu khi click vào icon trong input-group
    $('.toggle-pass').click(function() {
        // tìm input cha gần nhất
        const input = $(this).closest('.input-group').find('input');
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        
        // đổi icon
        $(this).toggleClass('bi-eye bi-eye-slash');
    });
});
</script>