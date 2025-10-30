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

<div class="table-responsive my-5 mx-2">
    <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
        <thead class="text-center">
            <tr>
                <th>STT</th>
                <th>Tên loại phòng</th>
                <th>Hình ảnh</th>
                <th>Badge</th>
                <th>Đánh giá</th>
                <th>Kích thước</th>
                <th>Vị trí</th>
                <th>Giá</th>
                <th>Tiện ích</th>
                <th>Mô tả</th>
                <th>Trống</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
        <?php
            include_once('Controller/cTypeOfRoom.php');
            $p = new controlTOR();
            $kq = $p->getAllTOR();

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td>' . $r['type_name'] . '</td>';
                        echo '<td><img src="image/' . $r['image'] . '" width="80"</td>';

                        echo '<td>' . $r['badge'] . '</td>';
                        echo '<td class="text-center">' . $r['rating'] . '</td>';
                        echo '<td>' . $r['size'] . '</td>';
                        echo '<td>' . $r['location'] . '</td>';

                        echo '<td>' . number_format($r['price'], 0, ',', '.') . '</td>';
                        echo '<td>' . $r['features'] . '</td>';
                        echo '<td>' . $r['description'] . '</td>';
                        echo '<td class="text-center"><span class="badge bg-success">' . $r['available_rooms'] . '</span></td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=suaLoaiPhong&id=' . $r['type_id'] . '" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Sửa</a>&nbsp;';
                            echo '<a href="index.php?page=xoaLoaiPhong&id=' . $r['type_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc muốn xóa loại phòng này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="10"><h2>Chưa có dữ liệu loại phòng.</h2></td></tr>';   
            }
        ?>
        </tbody>
    </table>

    <div class="text-center mt-5">
        <a href="index.php?page=themloaiphong" class="btn btn-primary btn-sm"><i class="bi bi-person-plus"></i> Thêm loại phòng</a>
    </div>
</div>

<style>
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        max-width: 200px;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>