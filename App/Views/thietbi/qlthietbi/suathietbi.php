<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cThietBi.php');
$p = new controlThietBi();

$maThietBi = $_GET['maThietBi'];

if(!$maThietBi) {
    echo "<script>alert('Không tìm thấy thiết bị!'); window.location.href='index.php?page=dsthietbi';</script>";
    exit();
}

$kq = $p->get01ThietBi($maThietBi);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy thiết bị!'); window.location.href='index.php?page=dsthietbi';</script>";
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
                    <input type="text" name="tenThietBi" value="<?= $r['tenThietBi'] ?>" class="form-control" required>
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
                    <textarea name="moTa" class="form-control" rows="3" style="resize:none;"><?= $r['moTa'] ?></textarea>
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
        $hinh = upload($hinhAnh);
    } else {
        $hinh = $r['hinhAnh']; // Giữ nguyên hình cũ nếu không có hình mới
    }

    if($hinh) {
        $kq = $p->updateThietBi($maThietBi, $tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $moTa);
        if($kq === false) {
            echo '<script>alert("Không thể giảm số lượng! Hiện còn thiết bị đang mượn hoặc hỏng."); window.history.back();</script>';
        } else if($kq) {
            echo '<script>alert("Cập nhật thành công!"); window.location.href="index.php?page=dsthietbi";</script>';
        } else {
            echo '<script>alert("Cập nhật thất bại!"); window.history.back();</script>';
        }
    } else {
        echo '<script>alert("Cập nhật thất bại! Hình ảnh không hợp lệ!"); window.history.back();</script>';
    }
}
?>