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
    echo "<script>alert('Không tìm thấy người dùng.'); window.location.href='index.php?page=thongtincanhan';</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng.'); window.location.href='index.php?page=thongtincanhan';</script>";
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
                    <input type="text" name="tenDangNhap" id="tenDangNhap" value="<?= $r['tenDangNhap'] ?>" class="form-control" required>
                    <span class="error" id="tenDangNhapError"></span>
                </div>

                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên <span class="text-danger">*</span></label>
                    <input type="text" name="hoTen" id="hoTen" value="<?= $r['hoTen'] ?>" class="form-control" required>
                    <span class="error" id="hoTenError"></span>
                </div>

                <!-- Vai trò -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Vai trò</label>
                    <input type="text" class="form-control" value="<?php echo $r['tenVaiTro']; ?>" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" class="form-control" value="<?php echo $r['tenBoMon']; ?>" disabled>
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
if(isset($_POST['btnluu'])) {
    $tenDangNhap = trim($_POST['tenDangNhap']);
    $hoTen = trim($_POST['hoTen']);
    $soDienThoai = trim($_POST['soDienThoai']);
    $email = trim($_POST['email']);
    
    if($p->updateThongTinCaNhan($maNguoiDung, $tenDangNhap, $hoTen, $soDienThoai, $email)) {
        // Cập nhật session ngay lập tức
        $_SESSION['tenDangNhap'] = $tenDangNhap;
        
        echo '<script>alert("Thông tin cá nhân đã được cập nhật thành công."); window.location.href="index.php?page=thongtincanhan";</script>';
    } else {
        echo '<script>alert("Cập nhật thông tin cá nhân không thành công. Vui lòng thử lại."); window.history.back();</script>';
    }
}
?>

<script>
$(document).ready(function () {
    $('#tenDangNhap').blur(checkTenDangNhap);
    $('#hoTen').blur(checkHoTen);
    $('#soDienThoai').blur(checkSoDienThoai);
    $('#email').blur(checkEmail);

    $('form').submit(function(e) {
        if(!(checkTenDangNhap() && checkHoTen() && checkSoDienThoai() && checkEmail())) {
            e.preventDefault();
        }
    });

    function checkTenDangNhap() {
        const val = $('#tenDangNhap').val().trim();
        const regex = /^[a-zA-Z0-9_.]{3,255}$/;

        if(val === "") return showError('#tenDangNhapError', 'Tên đăng nhập không được để trống!');
        if(!regex.test(val)) return showError('#tenDangNhapError', 'Tên đăng nhập không hợp lệ. Chỉ dùng chữ, số, dấu _ hoặc .');
        clearError('#tenDangNhapError');
        return true;
    }

    function checkHoTen() {
        const val = $('#hoTen').val().trim();
        const regex = /^[a-zA-ZÀ-ỹ\s]+$/;

        if(val === "") return showError('#hoTenError', 'Họ tên không được để trống!');
        if(!regex.test(val)) return showError('#hoTenError', 'Họ tên không được chứa ký tự đặc biệt hoặc số!');

        // Kiểm tra chữ hoa đầu mỗi từ
        const words = val.split(/\s+/);
        for(let word of words) {
            if(word[0] !== word[0].toUpperCase()) {
                return showError('#hoTenError', 'Chữ cái đầu mỗi từ trong họ tên phải viết hoa!');
            }
        }

        clearError('#hoTenError');
        return true;
    }

    function checkSoDienThoai() {
        const val = $('#soDienThoai').val().trim();
        const regex = /^(03|05|07|08|09)\d{8}$/;

        if(val === "") return showError('#soDienThoaiError', 'Số điện thoại không được để trống!');
        if(!regex.test(val)) return showError('#soDienThoaiError', 'Số điện thoại không hợp lệ. Phải bắt đầu bằng 03, 05, 07, 08, 09 và đủ 10 số.');
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

    function showError(elem, msg) {
        $(elem).text(msg);
        const input = $(elem).prev('input');
        if(input.length) input.focus();
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
    }
});
</script>