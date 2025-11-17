<?php
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
        exit();
    }

    // if($_SESSION['login'] == 3) {
    //     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    //     exit();
    // }

    include_once('Controller/cBoMon.php');
    $p = new controlBoMon();

    $maBoMon = $_GET['maBoMon'];

    if(!$maBoMon) {
        echo "<script>alert('Không tìm thấy bộ môn!'); window.location.href='index.php?page=quanlybomon';</script>";
        exit();
    }

    $kq = $p->get01BoMon($maBoMon);

    if($kq && $kq->num_rows > 0) {
        $r = $kq->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy bộ môn!'); window.location.href='index.php?page=quanlybomon';</script>";
        exit();
    }
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=quanlybomon'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Cập nhật bộ môn</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên bộ môn <span class="text-danger">*</span></label>
                    <input type="text" name="tenBoMon" value="<?= $r['tenBoMon'] ?>" class="form-control" required>
                </div>

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
    if(isset($_POST['btnluu'])) {
        $tenBoMon = trim($_POST['tenBoMon']);
        $moTa = trim($_POST['moTa']);
        
        if($p->updateBoMon($maBoMon, $tenBoMon, $moTa)) {
            echo '<script>alert("Cập nhật thành công!"); window.location.href="index.php?page=quanlybomon";</script>';
        } else {
            echo '<script>alert("Cập nhật thất bại!"); window.history.back();</script>';
        }
    }
?>