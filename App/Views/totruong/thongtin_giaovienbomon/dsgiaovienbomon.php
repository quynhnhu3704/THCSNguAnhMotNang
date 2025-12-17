<!-- App/Views/totruong/thongtin_giaovienbomon/dsgiaovienbomon.php -->
<?php
if(!isset($_SESSION['login'])) {
    echo "<script>alert('Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap'</script>";
    exit();
}

if($_SESSION['maVaiTro'] != 2) {
    echo "<script>alert('Bạn không có quyền truy cập chức năng này.'); window.history.back();</script>";
    exit();
}
?>

<h2 class="text-center fw-semibold my-3">Danh sách giáo viên bộ môn</h2>

<div class="d-flex mx-auto justify-content-between align-items-center" style="width: 95%">
    <!-- Thanh tìm kiếm -->
    <form class="d-flex ms-auto" action="index.php" method="get" spellcheck="false">
        <input type="hidden" name="page" value="dsgiaovienbomon"> <!-- Submit sẽ tạo URL: index.php?page=dsgiaovienbomon&keyword=xxxxx -->

        <input class="form-control me-2" type="text" name="keyword" placeholder="Tìm kiếm giáo viên..." style="width: 220px;">
        <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>
    </form>
</div>

<div class="d-flex justify-content-center">
    <div class="table-responsive my-5" style="width: 95%;">
        <table class="table table-striped table-hover table-borderless align-middle" style="font-size: 0.85em;">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Vai trò</th>
                    <th>Bộ môn</th>
                    <th>Số điện thoại</th>
                    <th>Email</th>
                    <th>Thao tác</th>
                </tr>
            </thead>

            <tbody>
            <?php
            include_once('App/Controllers/cNguoiDung.php');
            $p = new controlNguoiDung();
            
            if(isset($_GET['keyword'])) {
                $keyword = $_GET['keyword'];
                $kq = $p->searchNguoiDung($keyword);
            } else {
                $kq = $p->getAllNguoiDung();
            }

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    if ($r['maVaiTro'] != 3) continue; // Ẩn các vai trò khác Giáo viên bộ môn khỏi danh sách => chỉ hiển thị Giáo viên bộ môn
                    if ($r['maBoMon'] != $_SESSION["maBoMon"]) continue; // chỉ lấy Giáo viên bộ môn thuộc bộ môn của người đang đăng nhập

                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td class="text-center">' . $r['hoTen'] . '</td>';
                        echo '<td class="text-center">' . $r['tenVaiTro'] . '</td>';

                        echo '<td class="text-center">';
                            echo ($r['tenBoMon'] === NULL) ? '—' : $r['tenBoMon'];
                        echo '</td>';
                        
                        echo '<td class="text-center">' . $r['soDienThoai'] . '</td>';
                        echo '<td class="text-center">' . $r['email'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=xemgiaovienbomon&maNguoiDung=' . $r['maNguoiDung'] . '" class="btn btn-sm btn-info" style="font-size: 0.95em;"><i class="bi bi-info-circle"></i> Xem</a>';
                        echo '</td>';
                    echo '</tr>';
                } if ($dem == 0) {
                    echo '<tr><td colspan="10"><h5 class="text-center text-muted">Hiện chưa có giáo viên bộ môn nào. Vui lòng quay lại sau.</h5></td></tr>';
                }
            } else {
                echo '<tr><td colspan="8"><h5 class="text-center text-muted">Hiện chưa có giáo viên bộ môn nào. Vui lòng quay lại sau.</h5></td></tr>';   
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    th, td {
        max-width: 12.5em;      /* độ rộng tối đa của cột */
        white-space: nowrap;   /* không xuống dòng */
        overflow: hidden;      /* ẩn phần thừa */
        text-overflow: ellipsis; /* hiện dấu ... */
    }
</style>