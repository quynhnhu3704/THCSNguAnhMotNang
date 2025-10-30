<?php
    include_once('mketnoi.php');

    class modelUser {
        public function mLogin($username, $password) {
            $p = new clsKetNoi();
            $truyvan = "select * from users where username = '$username' and password = '$password'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function mRegis($username, $fullname, $email, $phone, $dob, $gender, $address, $password) {
            $p = new clsKetNoi();
            $truyvan = "insert into users(username, fullname, email, phone, dob, gender, address, password) values('$username', '$fullname', '$email', $phone, '$dob', '$gender', '$address', '$password')";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function mCheckUsername($username) {
            $p = new clsKetNoi();
            $truyvan = "select * from users where username = '$username'";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }

        public function selectAllUser() {
            $p = new clsKetNoi();
            $truyvan = "select * from users";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>