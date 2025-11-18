<div class="container d-flex justify-content-center align-items-center my-5">
    <div class="card-na border-0" style="max-width: 26.25em; width: 100%;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 fw-bold text-primary">Đăng nhập</h3>
            
            <form action="#" method="post">
                <div class="mb-3">
                    <label class="form-label fw-medium">Tên người dùng</label>
                    <input type="text" name="tenDangNhap" value="qltb1" class="form-control" required>
                </div>

                <div class="mb-5">
                    <label class="form-label fw-medium">Mật khẩu</label>
                    <input type="password" name="matKhau" value="123456" class="form-control" required>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" name="btnlogin" value="login" class="btn btn-primary w-100">Đăng nhập</button>
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
    if(isset($_POST['btnlogin'])) {
        include_once('App/Controllers/cNguoiDung.php');
        $p = new controlNguoiDung();

        $tenDangNhap = $_POST['tenDangNhap'];
        $matKhau = $_POST['matKhau'];

        $p->cLogin($tenDangNhap, $matKhau);
    }
?>