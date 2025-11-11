<?php
    if(!isset($_SESSION['login'])) {
        echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
        exit();
    }

    // if($_SESSION['login'] != 1) {
    //     echo "<script>alert('Bạn không được quyền truy cập trang này!'); window.location.href='index.php'</script>";
    //     exit();
    // }
?>

<!-- <div class="d-flex justify-content-center">
    <div class="table-responsive my-5 mx-2" style="width:90%; max-width:1200px;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center"> -->

<div class="table-responsive my-5 mx-2">
    <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
        <thead class="text-center">
            <tr>
                <th>STT</th>
                <th>Tên thiết bị</th>
                <th>Hình ảnh</th>
                <th>Đơn vị</th>
                <th>Số lượng</th>
                <th>Lớp</th>
                <th>Bộ môn</th>
                <th>Nhà cung cấp</th>
                <th>Tình trạng</th>
                <th>Ghi chú</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
        <?php
            include_once('Controller/cThietBi.php');
            $p = new controlThietBi();
            $kq = $p->getAllThietBi();

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td>' . $r['tenThietBi'] . '</td>';
                        echo '<td><img src="image/' . $r['hinhAnh'] . '" width="50"></td>';
                        echo '<td class="text-center">' . $r['donVi'] . '</td>';
                        echo '<td class="text-center">' . $r['soLuong'] . '</td>';
                        echo '<td class="text-center">' . $r['lop'] . '</td>';
                        echo '<td class="text-center">' . $r['tenBoMon'] . '</td>';
                        echo '<td class="text-center">' . $r['tenNhaCungCap'] . '</td>';
                        echo '<td class="text-center">' . $r['tinhTrang'] . '</td>';
                        echo '<td>' . $r['ghiChu'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=suathietbi&id=' . $r['maThietBi'] . '" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Sửa</a>&nbsp;';
                            echo '<a href="index.php?page=xoathietbi&id=' . $r['maThietBi'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc muốn xóa thiết bị này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="11"><h2>Chưa có dữ liệu thiết bị.</h2></td></tr>';   
            }
        ?>
        </tbody>
    </table>

    <div class="text-center mt-5">
        <a href="index.php?page=themthietbi" class="btn btn-primary btn-sm"><i class="bi bi-person-plus"></i> Thêm thiết bị</a>
    </div>
</div>

<style>
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        max-width: 100px;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>