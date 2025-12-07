<!-- App/Views/thietbi/qlnhacungcap/xoanhacungcap.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
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
    echo "<script>alert('Không tìm thấy nhà cung cấp.'); window.location.href='index.php?page=dsnhacungcap'</script>";
    exit();
}

$kq = $p->get01NhaCungCap($maNhaCungCap);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy nhà cung cấp.'); window.location.href='index.php?page=dsnhacungcap'</script>";
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // try catch để bắt lỗi khóa ngoại nếu nhà cung cấp này đang được tham chiếu ở bảng khác => không được xóa
    try {
        if ($p->deleteNhaCungCap($maNhaCungCap)) {
            echo "<script>alert('Xóa nhà cung cấp thành công.'); window.location.href='index.php?page=dsnhacungcap';</script>";
        } else {
            echo "<script>alert('Xóa nhà cung cấp thất bại. Vui lòng thử lại.'); window.history.back();</script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Không thể xóa nhà cung cấp này vì đang được sử dụng ở nơi khác.'); window.location.href='index.php?page=dsnhacungcap';</script>";
    }
}
?>