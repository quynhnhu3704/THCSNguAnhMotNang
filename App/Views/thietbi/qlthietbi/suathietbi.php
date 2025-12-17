<!-- App/Views/thietbi/qlthietbi/suathietbi.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 4) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}

include_once('App/Controllers/cThietBi.php');
$p = new controlThietBi();

$maThietBi = $_GET['maThietBi'];

if(!$maThietBi) {
    echo "<script>alert('Không tìm thấy thiết bị.'); window.location.href='index.php?page=dsthietbi';</script>";
    exit();
}

$kq = $p->get01ThietBi($maThietBi);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy thiết bị.'); window.location.href='index.php?page=dsthietbi';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsthietbi'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Cập nhật thiết bị</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên thiết bị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên thiết bị <span class="text-danger">*</span></label>
                    <input type="text" name="tenThietBi" id="tenThietBi" value="<?= $r['tenThietBi'] ?>" class="form-control" required>
                    <span class="error" id="tenThietBiError"></span>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Hình ảnh <span class="text-danger">*</span></label><br>
                    <img src="public/uploads/<?= $r['hinhAnh'] ?>" width="150" height="150" class="rounded-4 mb-2">
                    <input type="file" name="hinhAnh" class="form-control">
                </div>

                <!-- Đơn vị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Đơn vị <span class="text-danger">*</span></label>
                    <select name="donVi" class="form-select" required>
                        <option value="" disabled>-- Chọn đơn vị --</option>
                        <option value="Bộ" <?= ($r["donVi"] == 'Bộ') ? 'selected' : '' ?>>Bộ</option>
                        <option value="Cái" <?= ($r["donVi"] == 'Cái') ? 'selected' : '' ?>>Cái</option>
                        <option value="Chiếc" <?= ($r["donVi"] == 'Chiếc') ? 'selected' : '' ?>>Chiếc</option>
                        <option value="Hộp" <?= ($r["donVi"] == 'Hộp') ? 'selected' : '' ?>>Hộp</option>
                        <option value="Tấm" <?= ($r["donVi"] == 'Tấm') ? 'selected' : '' ?>>Tấm</option>
                    </select>
                </div>

                <!-- Số lượng -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số lượng <span class="text-danger">*</span></label>
                    <input type="number" name="soLuong" value="<?= $r['soLuong'] ?>" class="form-control" min="1" max="3" required>
                </div>

                <!-- Lớp -->
                <div class="mb-3">
                    <label class="form-label fw-medium d-block">Lớp <span class="text-danger">*</span></label>
                    <?php
                        $cacLop = ['6','7','8','9'];
                        
                        // Lấy lớp đã chọn từ CSDL, giả sử lưu dạng chuỗi "6,7"
                        $lopDaChon = isset($r['lop']) ? explode(',', $r['lop']) : [];

                        foreach ($cacLop as $lop) {
                            $checked = in_array($lop, $lopDaChon) ? 'checked' : '';
                            echo '<div class="form-check form-check-inline">';
                            echo '<input class="form-check-input" type="checkbox" name="lop[]" value="'.$lop.'" '.$checked.'>';
                            echo '<label class="form-check-label me-3">'.$lop.'</label>';
                            echo '</div>';
                        }
                    ?>
                    <br><span class="error" id="lopError"></span>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn <span class="text-danger">*</span></label>
                    <select name="maBoMon" class="form-select" required>
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
                
                <!-- Nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Nhà cung cấp <span class="text-danger">*</span></label>
                    <select name="maNhaCungCap" class="form-select" required>
                        <option value="" disabled>-- Chọn nhà cung cấp --</option>
                        <?php
                        include_once('App/Controllers/cNhaCungCap.php');
                        $p = new controlNhaCungCap();
                        $kq = $p->getAllNhaCungCap();
                        while ($ncc = $kq->fetch_assoc()) {
                            $sel = ($ncc['maNhaCungCap'] == $r['maNhaCungCap']) ? 'selected' : '';
                            echo "<option value='{$ncc['maNhaCungCap']}' $sel>{$ncc['tenNhaCungCap']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Tình trạng -->
                <!-- <div class="mb-3">
                    <label class="form-label fw-medium">Tình trạng <span class="text-danger">*</span></label>
                    <select name="tinhTrang" class="form-select" required>
                        <option value="" disabled>-- Chọn tình trạng --</option>
                        <option value="Khả dụng" <?= ($r["tinhTrang"] == 'Khả dụng') ? 'selected' : '' ?>>Khả dụng</option>
                        <option value="Thanh lý" <?= ($r["tinhTrang"] == 'Thanh lý') ? 'selected' : '' ?>>Thanh lý</option>
                        <option value="Đang mượn" <?= ($r["tinhTrang"] == 'Đang mượn') ? 'selected' : '' ?>>Đang mượn</option>
                        <option value="Báo hỏng" <?= ($r["tinhTrang"] == 'Báo hỏng') ? 'selected' : '' ?>>Báo hỏng</option>
                    </select>
                </div> -->

                <!-- Mô tả -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Mô tả</label>
                    <textarea name="moTa" class="form-control" rows="3" placeholder="Thông tin mô tả về thiết bị..." style="resize:none;"><?= $r['moTa'] ?></textarea>
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
include_once('App/Controllers/cUpload.php');
$p = new controlThietBi();

if(isset($_POST['btnluu'])) {
    $tenThietBi = trim($_POST['tenThietBi']);
    $hinhAnh = $_FILES['hinhAnh'];
    $donVi = trim($_POST['donVi']);
    $soLuong = (int) $_POST['soLuong'];
    $lop = isset($_POST['lop']) ? implode(',', $_POST['lop']) : null;
    $maBoMon = trim($_POST['maBoMon']);
    $maNhaCungCap = trim($_POST['maNhaCungCap']);
    $moTa = trim($_POST['moTa']);

    // Xử lý hình ảnh
    if (is_uploaded_file($hinhAnh['tmp_name'])) {
        // Upload hình mới
        $hinh = upload($hinhAnh);
        // Nếu upload lỗi → $hinh là mảng $loi[]
        if (is_array($hinh)) {
            $msg = implode("\n", $hinh); // Ghép mỗi lỗi thành 1 dòng
            echo "<script>alert(`$msg`); window.history.back(); </script>";
            exit();
        }

        // Xóa hình cũ nếu có
        if(!empty($r['hinhAnh']) && file_exists('public/uploads/' . $r['hinhAnh'])) {
            unlink('public/uploads/' . $r['hinhAnh']);
        }
    } else {
        $hinh = $r['hinhAnh']; // Giữ nguyên hình cũ nếu không có hình mới
    }

    $kq = $p->updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa);
    if($kq === false) {
        echo '<script>alert("Không thể giảm số lượng! Vẫn còn thiết bị đang được mượn hoặc bị hỏng."); window.history.back();</script>';
    } else if($kq) {
        echo '<script>alert("Cập nhật thông tin thiết bị thành công!"); window.location.href="index.php?page=dsthietbi";</script>';
    } else {
        echo '<script>alert("Cập nhật thông tin thiết bị thất bại! Vui lòng thử lại."); window.history.back();</script>';
    }
}
?>

<script>
$(document).ready(function () {
    $('#tenThietBi').blur(checkTenThietBi);
    $('input[name="lop[]"]').change(checkLop);

    $('form').submit(function(e) {
        if(!(checkTenThietBi() && checkLop())) {
            e.preventDefault();
        }
    });

    function checkTenThietBi() {
        const val = $('#tenThietBi').val().trim();

        if(val === "") {
            return showError('#tenThietBiError', 'Tên thiết bị không được để trống!');
        }

        const regex = /^[a-zA-Z0-9\s\-_À-ỹ]+$/;
        if(!regex.test(val)) {
            return showError('#tenThietBiError', 'Tên thiết bị không hợp lệ. Không dùng ký tự đặc biệt!');
        }

        if(val.length > 255) {
            return showError('#tenThietBiError', 'Tên thiết bị quá dài. Tối đa 255 ký tự!');
        }

        clearError('#tenThietBiError');
        return true;
    }

    function checkLop() {
        const count = $('input[name="lop[]"]:checked').length;

        if(count === 0) {
            return showError('#lopError', 'Vui lòng chọn ít nhất một khối lớp!');
        }

        clearError('#lopError');
        return true;
    }

    function showError(elem, msg) {
        $(elem).text(msg);
        const input = $(elem).prevAll('input, select, textarea').first();
        if(input.length) input.focus();
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
    }
});
</script>