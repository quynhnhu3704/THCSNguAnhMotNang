<!-- App/Views/thietbi/qlthietbi/xoathietbi.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
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
    echo "<script>alert('Không tìm thấy thiết bị.'); window.location.href='index.php?page=dsthietbi'</script>";
    exit();
}

$kq = $p->get01ThietBi($maThietBi);

if($kq && $kq->num_rows > 0) {
    $r = $kq->fetch_assoc();
} else {
    echo "<script>alert('Không tìm thấy thiết bị.'); window.location.href='index.php?page=dsthietbi'</script>";
    exit();
}


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    // try catch để bắt lỗi khóa ngoại nếu thiết bị đang được tham chiếu ở bảng khác => không được xóa
    try {
        if ($p->deleteThietBi($maThietBi)) {
            
            // Xóa hình ảnh khỏi thư mục
            $image_url = 'public/uploads/' . $r['hinhAnh'];
            if (file_exists($image_url)) {
                unlink($image_url);
            }

            echo "<script>alert('Xóa thiết bị thành công.'); window.location.href='index.php?page=dsthietbi';</script>";
        } else {
            echo "<script>alert('Xóa thiết bị thất bại. Vui lòng thử lại.'); window.history.back();</script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>alert('Không thể xóa thiết bị này vì đang được sử dụng ở nơi khác.'); window.location.href='index.php?page=dsthietbi';</script>";
    }
}
?>