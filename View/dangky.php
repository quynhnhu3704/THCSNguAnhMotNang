<div class="container d-flex justify-content-center align-items-center my-5">
    <div class="card-na border-0" style="max-width: 26.25em; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Đăng ký</h3>
            
            <form action="#" method="post">
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên người dùng</label>
                    <input type="text" name="username" value="quynhnhu" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Họ và tên</label>
                    <input type="text" name="fullname" value="Nguyễn Thị Quỳnh Như" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" name="email" value="quynhnhu@gmail.com" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-medium">Số điện thoại</label>
                    <input type="tel" name="phone" value="0984624532" class="form-control" required>
                </div>

                <!-- <div class="mb-3">
                    <label class="form-label">Giới tính</label>
                    <select name="gender" class="form-control" required>
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div> -->
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-medium">Ngày sinh</label>
                        <input type="date" name="dob" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-medium">Giới tính</label>
                        <select name="gender" class="form-select" required>
                            <option value="Nam">Nam</option>
                            <option value="Nữ" selected>Nữ</option>
                            <option value="Khác">Khác</option>
                        </select>
                    </div>
                </div>
                
                <!-- <div class="mb-3">
                    <label class="form-label">Ngày sinh</label>
                    <input type="date" name="dob" class="form-control" required>
                </div> -->

                <div class="mb-3">
                    <label class="form-label fw-medium">Địa chỉ</label>
                    <input type="text" name="address" value="12 Nguyễn Văn Bảo, TP.HCM" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-5">
                        <label class="form-label fw-medium">Mật khẩu</label>
                        <input type="password" name="password" value="123456" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-5">
                        <label class="form-label fw-medium">Nhập lại mật khẩu</label>
                        <input type="password" name="confirm_password" value="123456" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" name="btnregis" value="regis" class="btn btn-primary w-100">Đăng ký</button>
                    </div>
                    <div class="col-6">
                        <button type="reset" name="btnreset" value="reset" class="btn btn-outline-secondary w-100">Làm mới</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    if(isset($_POST['btnregis'])) {
        include_once('Controller/cUser.php');
        $p = new controlUser();

        $username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if($password != $confirm_password) {
            echo "<script>alert('⚠️ Xác nhận mật khẩu chưa khớp, vui lòng nhập lại.');</script>";
        } else {
            $p->cRegis($username, $fullname, $email, $phone, $dob, $gender, $address, $password);
        }
    }
?>