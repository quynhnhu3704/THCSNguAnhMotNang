<!-- App/Views/admin/phanquyen/suaquyen.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cNguoiDung.php');
$p = new controlNguoiDung();

$maNguoiDung = $_GET['maNguoiDung'];

if(!$maNguoiDung) {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dsquyen';</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href='index.php?page=dsquyen';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsquyen'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Phân quyền người dùng</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên đăng nhập -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên đăng nhập</label>
                    <input type="text" value="<?= $r['tenDangNhap'] ?>" class="form-control" disabled>
                </div>

                <!-- Họ tên -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Họ tên</label>
                    <input type="text" value="<?= $r['hoTen'] ?>" class="form-control" disabled>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại</label>
                    <input type="tel" value="<?= $r['soDienThoai'] ?>" class="form-control" disabled>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" value="<?= $r['email'] ?>" class="form-control" disabled>
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
    $maVaiTro = trim($_POST['maVaiTro']);

    $maBoMon = $_POST['maBoMon'] ?? null;
    // Chỉ gán bộ môn nếu vai trò là Tổ trưởng chuyên môn hoặc Giáo viên bộ môn
    if ($maVaiTro != 2 && $maVaiTro != 3) {
        $maBoMon = null;
    }
    
    if($p->updateQuyen($maNguoiDung, $maVaiTro, $maBoMon)) {
        echo '<script>alert("Cập nhật thành công!"); window.location.href="index.php?page=dsquyen";</script>';
    } else {
        echo '<script>alert("Cập nhật thất bại!"); window.history.back();</script>';
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