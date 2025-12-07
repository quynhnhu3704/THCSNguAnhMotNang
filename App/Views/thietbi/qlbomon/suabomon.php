<!-- App/Views/thietbi/qlbomon/suabomon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

// if($_SESSION['login'] == 3) {
//     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
//     exit();
// }

include_once('App/Controllers/cBoMon.php');
$p = new controlBoMon();

$maBoMon = $_GET['maBoMon'];

if(!$maBoMon) {
    echo "<script>alert('Không tìm thấy bộ môn.'); window.location.href='index.php?page=dsbomon';</script>";
    exit();
}

$kq = $p->get01BoMon($maBoMon);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy bộ môn.'); window.location.href='index.php?page=dsbomon';</script>";
    exit();
}
?>

<button type="button" class="btn btn-outline-primary ms-4 my-4" onclick="window.location.href='index.php?page=dsbomon'"><i class="bi bi-arrow-left"></i> Quay lại</button>

<div class="container d-flex justify-content-center align-items-center mb-5">
    <div class="card-na border-0" style="max-width: 36rem; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Cập nhật bộ môn</h3>

            <form action="#" method="post" enctype="multipart/form-data">
                <!-- Tên bộ môn -->
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên bộ môn <span class="text-danger">*</span></label>
                    <input type="text" name="tenBoMon" id="tenBoMon" value="<?= $r['tenBoMon'] ?>" class="form-control" required>
                    <span class="error" id="tenBoMonError"></span>
                </div>

                <!-- Mô tả -->
                <div class="mb-4">
                    <label class="form-label fw-medium">Mô tả</label>
                    <textarea name="moTa" class="form-control" rows="3" placeholder="Mô tả chức năng và phạm vi của bộ môn..." style="resize:none;"><?= $r['moTa'] ?></textarea>
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
        echo '<script>alert("Bộ môn đã được cập nhật thành công."); window.location.href="index.php?page=dsbomon";</script>';
    } else {
        echo '<script>alert("Cập nhật bộ môn không thành công. Vui lòng thử lại."); window.history.back();</script>';
    }
}
?>

<script>
// JQuery ràng buộc bộ môn
$(document).ready(function () {
    $('form').submit(function(e) {
        if(!checkTenBoMon()) e.preventDefault();
    });

    $('#tenBoMon').blur(checkTenBoMon);

    function checkTenBoMon() {
        const val = $('input[name="tenBoMon"]').val().trim();
        const regex = /^[a-zA-ZÀ-ỹ\s]+$/; // chỉ cho phép chữ và khoảng trắng

        if(val === "") return showError('#tenBoMonError', 'Tên bộ môn không được để trống!');
        if(val.length > 255) return showError('#tenBoMonError', 'Tên bộ môn quá dài. Tối đa 255 ký tự!');
        if(!regex.test(val)) return showError('#tenBoMonError', 'Tên bộ môn chỉ được chứa chữ cái, không có số hay ký tự đặc biệt!');
        
        clearError('#tenBoMonError');
        return true;
    }

    function showError(elem, msg) {
        $(elem).text(msg);
        $('input[name="tenBoMon"]').focus();
        return false;
    }

    function clearError(elem) {
        $(elem).text('');
    }
});
</script>