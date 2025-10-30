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
                <th>Tên đăng nhập</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Vai trò</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Địa chỉ</th>
                <th>Thao tác</th>
            </tr>
        </thead>

        <tbody>
        <?php
            include_once('Controller/cUser.php');
            $p = new controlUser();
            $kq = $p->getAllUser();

            if ($kq && $kq->num_rows > 0) {
                $dem = 0;
                while ($r = $kq->fetch_assoc()) {
                    $dem++;

                    echo '<tr>';
                        echo '<td class="text-center"><strong>' . $dem . '</strong></td>';
                        echo '<td>' . $r['username'] . '</td>';
                        echo '<td>' . $r['fullname'] . '</td>';
                        echo '<td>' . $r['email'] . '</td>';
                        echo '<td>' . $r['phone'] . '</td>';

                        echo '<td class="text-center">';
                            switch ($r['role_id']) {
                                case 1: 
                                    echo '<span class="badge bg-danger">Quản lý</span>'; 
                                    break;
                                case 2: 
                                    echo '<span class="badge bg-info text-dark">Nhân viên</span>'; 
                                    break;
                                case 3: 
                                    echo '<span class="badge bg-secondary">Khách hàng</span>'; 
                                    break;
                                default: 
                                    echo '<span class="badge bg-light text-dark">Không xác định</span>';
                            }
                        echo '</td>';

                        echo '<td>' . $r['dob'] . '</td>';
                        echo '<td class="text-center">' . $r['gender'] . '</td>';
                        echo '<td>' . $r['address'] . '</td>';

                        echo '<td class="text-center">';
                            echo '<a href="index.php?page=suaNguoiDung&id=' . $r['user_id'] . '" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i> Sửa</a>&nbsp;';
                            echo '<a href="index.php?page=xoaNguoiDung&id=' . $r['user_id'] . '" class="btn btn-sm btn-danger" onclick="return confirm(\'Bạn có chắc muốn xóa người dùng này không?\')"><i class="bi bi-trash"></i> Xóa</a>';
                        echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="10"><h2>Chưa có dữ liệu người dùng.</h2></td></tr>';   
            }
        ?>
        </tbody>
    </table>

    <div class="text-center mt-5">
        <a href="index.php?page=themnguoidung" class="btn btn-primary btn-sm"><i class="bi bi-person-plus"></i> Thêm người dùng</a>
    </div>
</div>