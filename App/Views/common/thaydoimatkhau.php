<!-- App/Views/common/thaydoimatkhau.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_SESSION['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng.'); window.history.back();</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng.'); window.history.back();</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.history.back();"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5" style="min-height:60vh;">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thay đổi mật khẩu</h3>

            <form action="#" method="post" enctype="multipart/form-data" spellcheck="false">
                <!-- Mật khẩu hiện tại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu hiện tại <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="matKhauHienTai" value="Nguanhmotnang123@" class="form-control" required>
                        <span class="input-group-text" style="cursor: pointer;"><i class="bi bi-eye-slash toggle-pass"></i></span>
                    </div>
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu mới <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="matKhauMoi" id="matKhauMoi" value="Thcs123@" class="form-control" required>
                        <span class="input-group-text" style="cursor: pointer;"><i class="bi bi-eye-slash toggle-pass"></i></span>
                    </div>
                    <span class="error" id="matKhauMoiError"></span>
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Xác nhận mật khẩu mới <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <input type="password" name="xacNhanMatKhauMoi" value="Thcs123@" class="form-control" required>
                        <span class="input-group-text" style="cursor: pointer;"><i class="bi bi-eye-slash toggle-pass"></i></span>
                    </div>
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
        echo '<script>alert("Mật khẩu hiện tại không đúng. Vui lòng kiểm tra lại."); window.history.back();</script>';
        exit();
    } else if($matKhauMoi != $xacNhanMatKhauMoi) {
        echo '<script>alert("Mật khẩu mới và xác nhận mật khẩu chưa khớp. Hãy nhập lại."); window.history.back();</script>';
        exit();
    } else if(md5($matKhauMoi) == $r['matKhau']) {
        echo '<script>alert("Mật khẩu mới không được trùng với mật khẩu hiện tại."); window.history.back();</script>';
        exit();
    } else {
        if($p->updateMatKhau($maNguoiDung, $matKhauMoi)) {
            session_unset(); // Xóa tất cả biến phiên hiện tại
            session_destroy(); // Hủy phiên hiện tại
            echo '<script>alert("Thay đổi mật khẩu thành công! Vui lòng đăng nhập lại."); window.location.href="index.php?page=dangnhap";</script>';
        } else {
            echo '<script>alert("Thay đổi mật khẩu thất bại. Vui lòng thử lại."); window.history.back();</script>';
        }
    }
}
?>

<script>
$(document).ready(function () {
    $('#matKhauMoi').blur(checkMatKhauMoi);

    $('form').submit(function(e) {
        if(!checkMatKhauMoi()) {
            e.preventDefault();
        }
    });

    function checkMatKhauMoi() {
        const val = $('#matKhauMoi').val().trim();

        // Kiểm tra rỗng
        if(val === "") return showError('#matKhauMoiError', 'Mật khẩu mới không được để trống!');

        // Regex: ít nhất 6 ký tự, 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt
        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{6,}$/;

        if(!regex.test(val)) return showError('#matKhauMoiError', 
            'Mật khẩu phải có ít nhất 6 ký tự, bao gồm 1 chữ hoa, 1 chữ thường, 1 số và 1 ký tự đặc biệt!');

        clearError('#matKhauMoiError');
        return true;
    }

    function showError(elem, msg) {
        // Nếu chưa có span hiển thị lỗi thì thêm
        if($(elem).length === 0) {
            $('#matKhauMoi').after('<span class="error" id="matKhauMoiError"></span>');
        }
        $(elem).text(msg);
        $('#matKhauMoi').focus();
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
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