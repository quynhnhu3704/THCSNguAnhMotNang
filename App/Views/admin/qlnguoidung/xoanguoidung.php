<!-- App/Views/admin/qlnguoidung/xoanguoidung.php -->
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
    echo "<script>alert('Không tìm thấy người dùng.'); window.location.href='index.php?page=dsnguoidung'</script>";
    exit();
}

$kq = $p->get01NguoiDung($maNguoiDung);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy người dùng.'); window.location.href='index.php?page=dsnguoidung'</script>";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // try catch để bắt lỗi khóa ngoại nếu người dùng đang được tham chiếu ở bảng khác => không được xóa
    try {
        if ($p->deleteNguoiDung($maNguoiDung)) {
            echo "<script>alert('Xóa người dùng thành công.'); window.location.href='index.php?page=dsnguoidung';</script>";
        } else {
            echo "<script>alert('Xóa người dùng thất bại. Vui lòng thử lại.'); window.history.back();</script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Không thể xóa người dùng này vì đang được sử dụng ở nơi khác.'); window.location.href='index.php?page=dsnguoidung';</script>";
    }
}
?>