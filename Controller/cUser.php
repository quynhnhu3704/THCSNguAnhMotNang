<?php
    include_once('Model/mUser.php');

    class controlUser {
        public function cLogin($username, $password) {
            $p = new modelUser();
            $password = md5($password);
            $kq = $p->mLogin($username, $password);

            if(!$kq) {
                echo "<script>alert('Không thể kết nối đến hệ thống. Vui lòng thử lại sau.')</script>";
            } else if($kq->num_rows > 0) {
                $r = $kq->fetch_assoc();
                
                $_SESSION['login'] = true;
                $_SESSION['role_id'] = $r['role_id'];
                $_SESSION['username'] = $r['username'];
                // $_SESSION['user_id'] = $r['user_id'];
                echo "<script>alert('Đăng nhập thành công! Chào mừng bạn trở lại.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng thử lại.')</script>";
            }
        }

        public function cRegis($username, $fullname, $email, $phone, $dob, $gender, $address, $password) {
            $p = new modelUser();
            $password = md5($password);
            $kq = $p->mCheckUsername($username);
            
            if($kq->num_rows > 0) {
                echo "<script>alert('Tên đăng nhập đã được sử dụng. Vui lòng chọn tên khác.')</script>";
            } else {
                $kq = $p->mRegis($username, $fullname, $email, $phone, $dob, $gender, $address, $password);
                if ($kq) {
                    $_SESSION['regis'] = true;
                    echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập để tiếp tục.'); window.location.href='index.php?page=dangnhap';</script>";
                } else {
                    echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại sau.')</script>";
                }
            }
        }

        public function getAllUser() {
            $p = new modelUser();
            $kq = $p->selectAllUser();

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }
    }
?>