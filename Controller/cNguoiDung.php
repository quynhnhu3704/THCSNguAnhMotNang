<?php
    include_once('Model/mNguoiDung.php');

    class controlNguoiDung {
        public function cLogin($tenDangNhap, $matKhau) {
            $p = new modelNguoiDung();
            $matKhau = md5($matKhau);
            $kq = $p->mLogin($tenDangNhap, $matKhau);

            if(!$kq) {
                echo "<script>alert('Không thể kết nối đến hệ thống. Vui lòng thử lại sau.')</script>";
            } else if($kq->num_rows > 0) {
                $r = $kq->fetch_assoc();
                
                $_SESSION['login'] = true;
                $_SESSION['maVaiTro'] = $r['maVaiTro'];
                $_SESSION['tenDangNhap'] = $r['tenDangNhap'];
                // $_SESSION['user_id'] = $r['user_id'];
                echo "<script>alert('Đăng nhập thành công! Chào mừng bạn trở lại.'); window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('Tên đăng nhập hoặc mật khẩu không chính xác. Vui lòng thử lại.')</script>";
            }
        }

        public function getAllNguoiDung() {
            $p = new modelNguoiDung();
            $kq = $p->selectAllNguoiDung();

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function searchNguoiDung($keyword) {
            $p = new modelNguoiDung();
            $kq = $p->searchNguoiDung($keyword);

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function get01NguoiDung($maNguoiDung) {
            $p = new modelNguoiDung();
            $kq = $p->select01NguoiDung($maNguoiDung);
            return $kq;
        }

        public function checkName($tenDangNhap) {
            $p = new modelNguoiDung();
            $kq = $p->checkName($tenDangNhap);
            
            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }

        public function insertNguoiDung($tenDangNhap, $hoTen, $matKhauTamThoi, $soDienThoai, $email, $maVaiTro, $maBoMon) {
            $p = new modelNguoiDung();
            $matKhauTamThoi = md5($matKhauTamThoi);
            $kq = $p->insertNguoiDung($tenDangNhap, $hoTen, $matKhauTamThoi, $soDienThoai, $email, $maVaiTro, $maBoMon);
            return $kq;
        }

        public function updateNguoiDung($maNguoiDung, $tenDangNhap, $matKhauMoi, $hoTen, $maVaiTro, $maBoMon, $soDienThoai, $email) {
            $p = new modelNguoiDung();
            $matKhauMoi = md5($matKhauMoi);
            $kq = $p->updateNguoiDung($maNguoiDung, $tenDangNhap, $matKhauMoi, $hoTen, $maVaiTro, $maBoMon, $soDienThoai, $email);
            return $kq;
        }

        public function deleteNguoiDung($maNguoiDung) {
            $p = new modelNguoiDung();
            $kq = $p->deleteNguoiDung($maNguoiDung);
            return $kq;
        }
    }
?>