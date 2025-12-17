<!-- App/Views/admin/qlnguoidung/suanguoidung.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 6) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_GET['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng.'); window.location.href='index.php?page=dsnguoidung';</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng.'); window.location.href='index.php?page=dsnguoidung';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsnguoidung'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Cập nhật người dùng</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên đăng nhập <span class="text-danger">*</span></label>
                    <input type="text" name="tenDangNhap" id="tenDangNhap" value="<?= $r['tenDangNhap'] ?>" class="form-control" required>
                    <span class="error" id="tenDangNhapError"></span>
                </div>

                <!-- Mật khẩu mới -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Mật khẩu mới</label>
                    <span class="text-warning fst-italic" style="font-size:smaller">(Không bắt buộc)</span>
                    <div class="input-group">
                        <input type="password" name="matKhauMoi" id="matKhauMoi" value="" class="form-control">
                        <span class="input-group-text" style="cursor: pointer;"><i class="bi bi-eye-slash toggle-pass"></i></span>
                    </div>
                    <span class="error" id="matKhauMoiError"></span>
                </div>

                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoTen" id="hoTen" value="<?= $r['hoTen'] ?>" class="form-control" required>
                    <span class="error" id="hoTenError"></span>
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò <span class="text-danger">*</span></label>
                    <select name="maVaiTro" class="form-select" required>
                        <option value="" disabled>-- Chọn vai trò --</option>
                        <?php
                        include_once('App/Controllers/cVaiTro.php');
                        $p = new controlVaiTro();
                        $kq = $p->getAllVaiTro();
                        while ($bm = $kq->fetch_assoc()) {
                            $sel = ($bm['maVaiTro'] == $r['maVaiTro']) ? 'selected' : '';
                            echo "<option value='{$bm['maVaiTro']}' $sel>{$bm['tenVaiTro']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn <span class="text-danger">*</span></label>
                    <select name="maBoMon" id="selectBoMon" class="form-select" required>
                        <option value="" disabled>-- Chọn bộ môn --</option>
                        <?php
                        include_once('App/Controllers/cBoMon.php');
                        $p = new controlBoMon();
                        $kq = $p->getAllBoMon();
                        while ($bm = $kq->fetch_assoc()) {
                            $sel = ($bm['maBoMon'] == $r['maBoMon']) ? 'selected' : '';
                            echo "<option value='{$bm['maBoMon']}' $sel>{$bm['tenBoMon']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="tel" name="soDienThoai" id="soDienThoai" value="<?= $r['soDienThoai'] ?>" class="form-control" required>
                    <span class="error" id="soDienThoaiError"></span>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="email" value="<?= $r['email'] ?>" class="form-control" required>
                    <span class="error" id="emailError"></span>
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
$p = new controlNguoiDung();

if(isset($_POST['btnluu'])) {
    $tenDangNhap = trim($_POST['tenDangNhap']);
    $matKhauMoi = trim($_POST['matKhauMoi']);
    $hoTen = trim($_POST['hoTen']);
    $maVaiTro = trim($_POST['maVaiTro']);

    $maBoMon = $_POST['maBoMon'] ?? null;
    // Chỉ gán bộ môn nếu vai trò là Tổ trưởng chuyên môn hoặc Giáo viên bộ môn
    if ($maVaiTro != 2 && $maVaiTro != 3) {
        $maBoMon = null;
    }

    $soDienThoai = trim($_POST['soDienThoai']);
    $email = trim($_POST['email']);
    
    if($p->updateNguoiDung($maNguoiDung, $tenDangNhap, $matKhauMoi, $hoTen, $maVaiTro, $maBoMon, $soDienThoai, $email)) {

        // if($maNguoiDung == $_SESSION['maNguoiDung'] && !empty($matKhauMoi)) {
        //     // Admin thay đổi mật khẩu của chính mình
        //     session_unset();
        //     session_destroy();
        //     echo '<script>alert("Bạn đã thay đổi mật khẩu của mình, vui lòng đăng nhập lại!"); window.location.href="index.php?page=dangnhap";</script>';
        //     exit();
        // } else if($maNguoiDung == $_SESSION['maNguoiDung']) {
        //     // Admin sửa thông tin khác của chính mình => chỉ cập nhật lại session
        //     $_SESSION['tenDangNhap'] = $tenDangNhap;
        // }
        
        echo '<script>alert("Thông tin người dùng đã được cập nhật thành công!"); window.location.href="index.php?page=dsnguoidung";</script>';
    } else {
        echo '<script>alert("Cập nhật thông tin người dùng không thành công. Vui lòng thử lại!"); window.history.back();</script>';
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
    // blur events
    $('#tenDangNhap').blur(checkTenDangNhap);
    $('#hoTen').blur(checkHoTen);
    $('#soDienThoai').blur(checkSDT);
    $('#email').blur(checkEmail);
    $('#matKhauMoi').blur(checkMatKhau);

    // submit
    $('form').submit(function(e) {
        if(!(checkTenDangNhap() && checkHoTen() && checkSDT() && checkEmail() && checkMatKhau())) {
            e.preventDefault();
        }
    });

    // --- validation functions ---
    function checkTenDangNhap() {
        const val = $('#tenDangNhap').val().trim();
        const regex = /^[a-zA-Z0-9_.]+$/;

        if(val === "") return showError('#tenDangNhapError', 'Tên đăng nhập không được để trống!');
        if(val.length > 255) return showError('#tenDangNhapError', 'Tên đăng nhập quá dài. Tối đa 255 ký tự!');
        if(!regex.test(val)) return showError('#tenDangNhapError', 'Tên đăng nhập không hợp lệ. Chỉ dùng chữ, số, dấu _ hoặc .');

        clearError('#tenDangNhapError');
        return true;
    }

    function checkHoTen() {
        const val = $('#hoTen').val().trim();
        const regex = /^[a-zA-ZÀ-ỹ\s]+$/;

        if(val === "") return showError('#hoTenError', 'Họ tên không được để trống!');
        if(val.length > 255) return showError('#hoTenError', 'Họ tên quá dài. Tối đa 255 ký tự!');
        if(!regex.test(val)) return showError('#hoTenError', 'Họ tên không được chứa ký tự đặc biệt hoặc số!');

        const words = val.split(/\s+/);
        for(let word of words) {
            if(word[0] !== word[0].toUpperCase()) {
                return showError('#hoTenError', 'Chữ cái đầu mỗi từ trong họ tên phải viết hoa!');
            }
        }

        clearError('#hoTenError');
        return true;
    }

    function checkSDT() {
        const val = $('#soDienThoai').val().trim();
        const regex = /^(03|05|07|08|09)\d{8}$/;

        if(val === "") return showError('#soDienThoaiError', 'Số điện thoại không được để trống!');
        if(!regex.test(val)) return showError('#soDienThoaiError', 'Số điện thoại không hợp lệ. Phải bắt đầu 03,05,07,08,09 và đủ 10 số.');

        clearError('#soDienThoaiError');
        return true;
    }

    function checkEmail() {
        const val = $('#email').val().trim();
        const regex = /^[^\s@]+@(truong\.edu\.vn|gmail\.com|yahoo\.com)$/;

        if(val === "") return showError('#emailError', 'Email không được để trống!');
        if(!regex.test(val)) return showError('#emailError', 'Email không hợp lệ. Chỉ chấp nhận @truong.edu.vn, @gmail.com, @yahoo.com.');

        clearError('#emailError');
        return true;
    }

    function checkMatKhau() {
        const val = $('#matKhauMoi').val().trim();
        if(val === "") {
            clearError('#matKhauMoiError'); // không bắt buộc
            return true;
        }

        const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_+\-=[\]{};':"\\|,.<>/?]).{6,}$/;
        if(!regex.test(val)) return showError('#matKhauMoiError', 'Mật khẩu phải có ít nhất 6 ký tự, gồm 1 chữ hoa, 1 chữ thường, 1 số, 1 ký tự đặc biệt!');

        clearError('#matKhauMoiError');
        return true;
    }

    // --- show / clear error ---
    function showError(elem, msg) {
        $(elem).text(msg);
        const input = $(elem).prevAll('input, select, textarea').first();
        if(input.length) input.focus();
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
    }

    // toggle mật khẩu
    $('.toggle-pass').click(function() {
        const input = $(this).closest('.input-group').find('input');
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        $(this).toggleClass('bi-eye bi-eye-slash');
    });
});
</script>