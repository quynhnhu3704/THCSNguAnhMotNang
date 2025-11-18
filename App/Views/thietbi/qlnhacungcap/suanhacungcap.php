<?php
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Bạn chưa đăng nhập!'); window.location.href='index.php?page=dangnhap'</script>";
        exit();
    }

    // if($_SESSION['login'] == 3) {
    //     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    //     exit();
    // }

    include_once('App/Controllers/cNhaCungCap.php');
    $p = new controlNhaCungCap();

    $maNhaCungCap = $_GET['maNhaCungCap'];

    if(!$maNhaCungCap) {
        echo "<script>alert('Không tìm thấy nhà cung cấp!'); window.location.href='index.php?page=dsnhacungcap';</script>";
        exit();
    }

    $kq = $p->get01NhaCungCap($maNhaCungCap);

    if($kq && $kq->num_rows > 0) {
        $r = $kq->fetch_assoc();
    } else {
        echo "<script>alert('Không tìm thấy nhà cung cấp!'); window.location.href='index.php?page=dsnhacungcap';</script>";
        exit();
    }
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsnhacungcap'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Cập nhật nhà cung cấp</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên nhà cung cấp -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên nhà cung cấp <span class="text-danger">*</span></label>
                    <input type="text" name="tenNhaCungCap" value="<?= $r['tenNhaCungCap'] ?>" class="form-control" required>
                </div>

                <!-- Địa chỉ -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Địa chỉ <span class="text-danger">*</span></label>
                    <input type="text" name="diaChi" value="<?= $r['diaChi'] ?>" class="form-control" required>
                </div>

                <!-- Số điện thoại -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
                    <input type="tel" name="soDienThoai" value="<?= $r['soDienThoai'] ?>" class="form-control" required>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" value="<?= $r['email'] ?>" class="form-control" required>
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
        $tenNhaCungCap = trim($_POST['tenNhaCungCap']);
        $diaChi = trim($_POST['diaChi']);
        $soDienThoai = trim($_POST['soDienThoai']);
        $email = trim($_POST['email']);
        
        if($p->updateNhaCungCap($maNhaCungCap, $tenNhaCungCap, $diaChi, $soDienThoai, $email)) {
            echo '<script>alert("Cập nhật thành công!"); window.location.href="index.php?page=dsnhacungcap";</script>';
        } else {
            echo '<script>alert("Cập nhật thất bại!"); window.history.back();</script>';
        }
    }
?>