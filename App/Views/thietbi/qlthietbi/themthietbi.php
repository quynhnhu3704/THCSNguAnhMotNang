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

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsthietbi'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Thêm thiết bị</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên thiết bị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên thiết bị <span class="text-danger">*</span></label>
                    <input type="text" name="tenThietBi" value="Bộ thí nghiệm Khoa học tổng hợp STEM Junior Lab Kit" class="form-control" required>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Hình ảnh <span class="text-danger">*</span></label><br>
                    <input type="file" name="hinhAnh" class="form-control" required>
                </div>

                <!-- Đơn vị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Đơn vị <span class="text-danger">*</span></label>
                    <select name="donVi" class="form-select" required>
                        <option value="" disabled selected>-- Chọn đơn vị --</option>
                        <option value="Bộ">Bộ</option>
                        <option value="Cái">Cái</option>
                        <option value="Chiếc">Chiếc</option>
                        <option value="Hộp">Hộp</option>
                        <option value="Tấm">Tấm</option>
                    </select>
                </div>

                <!-- Số lượng -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số lượng <span class="text-danger">*</span></label>
                    <input type="number" name="soLuong" value="" class="form-control" min="1" required>
                </div>

                <!-- Lớp -->
                <div class="mb-3">
                    <label class="form-label fw-medium d-block">Lớp <span class="text-danger">*</span></label>

                    <?php 
                    $cacLop = ['6','7','8','9'];
                    foreach ($cacLop as $lop) {
                        echo '<div class="form-check form-check-inline">';
                        echo '<input class="form-check-input" type="checkbox" name="lop[]" value="'.$lop.'">';
                        echo '<label class="form-check-label me-3">'.$lop.'</label>';
                        echo '</div>';
                    }
                    ?>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn <span class="text-danger">*</span></label>
                    <select name="maBoMon" class="form-select" required>
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
                
                <!-- Nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Nhà cung cấp <span class="text-danger">*</span></label>
                    <select name="maNhaCungCap" class="form-select" required>
                        <option value="" disabled selected>-- Chọn nhà cung cấp --</option>
                        <?php
                        include_once('App/Controllers/cNhaCungCap.php');
                        $p = new controlNhaCungCap();
                        $kq = $p->getAllNhaCungCap();
                        while ($r = $kq->fetch_assoc()) {
                            echo "<option value='{$r['maNhaCungCap']}'>{$r['tenNhaCungCap']}</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- Tình trạng -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tình trạng <span class="text-danger">*</span></label>
                    <select name="tinhTrang" class="form-select" required>
                        <option value="" disabled selected>-- Chọn tình trạng --</option>
                        <option value="Khả dụng">Khả dụng</option>
                        <option value="Thanh lý">Thanh lý</option>
                    </select>
                </div>

                <!-- Ghi chú -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Ghi chú</label>
                    <textarea name="ghiChu" class="form-control" rows="3" style="resize:none;"></textarea>
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
include_once('App/Controllers/cThietBi.php');
include_once('App/Controllers/cUpload.php');

$p = new controlThietBi();

if(isset($_POST['btnluu'])) {
    $tenThietBi = trim($_POST['tenThietBi']);
    $hinhAnh = $_FILES['hinhAnh'];
    $donVi = trim($_POST['donVi']);
    $soLuong = trim($_POST['soLuong']);
    $lop = isset($_POST['lop']) ? implode(',', $_POST['lop']) : null;
    $maBoMon = trim($_POST['maBoMon']);
    $maNhaCungCap = trim($_POST['maNhaCungCap']);
    $tinhTrang = trim($_POST['tinhTrang']);
    $ghiChu = trim($_POST['ghiChu']);

    if($p->checkName($tenThietBi)) {
        echo '<script>alert("Tên thiết bị đã tồn tại!"); window.location.href="index.php?page=themthietbi";</script>';
    } else {
        $hinh = upload($hinhAnh);

        if($hinh) {
            if($p->insertThietBi($tenThietBi, $hinh, $donVi, $soLuong, $lop, $maBoMon, $maNhaCungCap, $tinhTrang, $ghiChu)) {
                echo '<script>alert("Thêm thành công!"); window.location.href="index.php?page=dsthietbi";</script>';
            } else {
                echo '<script>alert("Thêm thất bại!"); window.history.back();</script>';
            }
        } else {
            echo '<script>alert("Thêm thất bại!"); window.history.back();</script>';
        }
    }
}
?>