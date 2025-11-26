<!-- App/Views/thietbi/baohong/baohongthietbi.php -->
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

$maChiTietTB = $_GET['maChiTietTB'];

if(!$maChiTietTB) {
    echo "<script>alert('Không tìm thấy thiết bị!'); window.location.href='index.php?page=dsbaohong';</script>";
    exit();
}

$kq = $p->get01ChiTietTB($maChiTietTB);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy thiết bị!'); window.location.href='index.php?page=dsbaohong';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsbaohong'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Báo hỏng thiết bị</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên thiết bị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên thiết bị</label>
                    <input type="text" value="<?= $r['tenThietBi'] ?>" class="form-control" disabled>
                </div>

                <!-- Hình ảnh -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Hình ảnh</label><br>
                    <img src="public/uploads/<?= $r['hinhAnh'] ?>" width="150" height="150" class="rounded-4 mb-2">
                </div>

                <!-- Đơn vị -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Đơn vị</label>
                    <input type="text" value="<?= $r['donVi'] ?>" class="form-control" disabled>
                </div>

                <!-- Lớp -->
                <div class="mb-3">
                    <label class="form-label fw-medium d-block">Lớp</label>
                    <input type="text" value="<?= str_replace(',', ' - ', $r['lop']) ?>" class="form-control" disabled>
                </div>

                <!-- Bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Bộ môn</label>
                    <input type="text" value="<?= $r['tenBoMon'] ?>" class="form-control" disabled>
                </div>
                
                <!-- Nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Nhà cung cấp</label>
                    <input type="text" value="<?= $r['tenNhaCungCap'] ?>" class="form-control" disabled>
                </div>
                
                <!-- Tình trạng -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tình trạng <span class="text-danger">*</span></label>
                    <input type="text" name="tinhTrang" class="form-control" value="Báo hỏng" readonly>
                </div>

                <!-- Ghi chú -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Ghi chú</label>
                    <textarea name="ghiChu" class="form-control" rows="3" style="resize:none;"><?= $r['ghiChu'] ?></textarea>
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
    $tinhTrang = trim($_POST['tinhTrang']);
    $ghiChu = trim($_POST['ghiChu']);
    
    if($p->updateHong($maChiTietTB, $tinhTrang, $ghiChu)) {
        echo '<script>alert("Báo hỏng thiết bị thành công!"); window.location.href="index.php?page=dsbaohong";</script>';
    } else {
        echo '<script>alert("Báo hỏng thiết bị thất bại!"); window.history.back();</script>';
    }
}
?>