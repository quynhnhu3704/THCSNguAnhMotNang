<!-- App/Views/thietbi/qlnhacungcap/dsnhacungcap.php -->
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

<h2 class="text-center fw-semibold my-3">Danh sách nhà cung cấp</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Nút thêm -->
    <a href="index.php?page=themnhacungcap" class="btn btn-primary fw-semibold"><i class="bi bi-database-add me-1"></i> Thêm nhà cung cấp</a>

    <!-- Thanh tìm kiếm -->
    <form class="d-flex" action="index.php" method="get">
        <input type="hidden" name="page" value="dsnhacungcap"> <!-- Submit sẽ tạo URL: index.php?page=dsnhacungcap&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm nhà cung cấp..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>

<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên nhà cung cấp</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cNhaCungCap.php');
            $p = new controlNhaCungCap();

            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchNhaCungCap($keyword);
            } else {
                $kq = $p->getAllNhaCungCap();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['tenNhaCungCap'] . '</td>';
                        echo '<td class="text-center">' . $r['diaChi'] . '</td>';
                        echo '<td class="text-center">' . $r['soDienThoai'] . '</td>';
                        echo '<td class="text-center">' . $r['email'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=suanhacungcap&maNhaCungCap=' . $r['maNhaCungCap'] . '" class="btn btn-sm btn-warning" style="font-size: 0.95em;"><i class="bi bi-pencil-square"></i> Sửa</a>&nbsp;';
                            echo '<a href="index.php?page=xoanhacungcap&action=delete&maNhaCungCap=' . $r['maNhaCungCap'] . '" class="btn btn-sm btn-danger" style="font-size: 0.95em;" onclick="return confirm(\'Bạn có chắc muốn xóa nhà cung cấp này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6"><h5 class="text-center text-muted">Chúng tôi tạm thời chưa có nhà cung cấp nào, mời bạn quay lại sau.</h5></td></tr>';   
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