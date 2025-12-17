<!-- App/Views/thietbi/qlbomon/xoabomon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 4) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}

include_once('App/Controllers/cBoMon.php');
$p = new controlBoMon();

$maBoMon = $_GET['maBoMon'];

if(!$maBoMon) {
    echo "<script>alert('Không tìm thấy bộ môn.'); window.location.href='index.php?page=dsbomon'</script>";
    exit();
}

$kq = $p->get01BoMon($maBoMon);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy bộ môn.'); window.location.href='index.php?page=dsbomon'</script>";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // try catch để bắt lỗi khóa ngoại nếu bộ môn đang được tham chiếu ở bảng khác => không được xóa
    try {
        if ($p->deleteBoMon($maBoMon)) {
            echo "<script>alert('Xóa bộ môn thành công.'); window.location.href='index.php?page=dsbomon';</script>";
        } else {
            echo "<script>alert('Xóa bộ môn thất bại. Vui lòng thử lại.'); window.history.back();</script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Không thể xóa bộ môn này vì đang được sử dụng ở nơi khác.'); window.location.href='index.php?page=dsbomon';</script>";
    }
}
?>