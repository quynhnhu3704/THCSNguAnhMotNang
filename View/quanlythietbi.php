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

<h2 class="text-center fw-semibold my-3">Danh sách thiết bị</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Nút thêm -->
    <a href="index.php?page=themthietbi" class="btn btn-primary fw-semibold"><i class="bi bi-database-add me-1"></i> Thêm thiết bị</a>

    <!-- Thanh tìm kiếm -->
    <form class="d-flex" action="index.php" method="get">
        <input type="hidden" name="page" value="quanlythietbi"> <!-- Submit sẽ tạo URL: index.php?page=quanlythietbi&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm thiết bị..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>


<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
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

                if(isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                    $kq = $p->searchThietBi($keyword);
                } else {
                    $kq = $p->getAllThietBi();
                }

                if ($kq && $kq->num_rows > 0) {
                    $dem = 0;
                    while ($r = $kq->fetch_assoc()) {
                        $dem++;

                        echo '<tr>';
                            echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                            echo '<td title="'.$r['tenThietBi'].'">' . $r['tenThietBi'] . '</td>';
                            echo '<td><img src="image/' . $r['hinhAnh'] . '" width="40" class="rounded d-block mx-auto"></td>';
                            echo '<td class="text-center">' . $r['donVi'] . '</td>';
                            echo '<td class="text-center">' . $r['soLuong'] . '</td>';
                            echo '<td class="text-center">' . $r['lop'] . '</td>';
                            echo '<td class="text-center">' . $r['tenBoMon'] . '</td>';
                            echo '<td class="text-center">' . $r['tenNhaCungCap'] . '</td>';
                            echo '<td class="text-center">' . $r['tinhTrang'] . '</td>';
                            echo '<td>' . $r['ghiChu'] . '</td>';

                            echo '<td class="text-center">';
                                echo '<a href="index.php?page=suathietbi&id=' . $r['maThietBi'] . '" class="btn btn-sm btn-warning" style="font-size: 0.95em;"><i class="bi bi-pencil-square"></i> Sửa</a>&nbsp;';
                                echo '<a href="index.php?page=xoathietbi&id=' . $r['maThietBi'] . '" class="btn btn-sm btn-danger" style="font-size: 0.95em;" onclick="return confirm(\'Bạn có chắc muốn xóa thiết bị này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                            echo '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="11"><h3 class="text-muted">Chúng tôi tạm thời chưa có thiết bị nào, mời bạn quay lại sau.</h3></td></tr>';   
                }
            ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    th, td {
        border: 1px solid #ddd;
        max-width: 7.25em;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>