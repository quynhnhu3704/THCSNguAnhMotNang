<?php
class clsKetNoi {
    public function moketnoi() {
        $host = 'localhost';
        $user = 'root';
        $pwd = '';
        $db = 'thcs_nguanhmotnang';

        // $host = 'localhost';
        // $user = 'drzsoja2myqv_quynhnhu'; // Thay bằng username MySQL từ Control Panel
        // $pwd = 'unicorn50k'; // Mật khẩu MySQL (lấy từ Control Panel)
        // $db = 'drzsoja2myqv_thcsnguanhmotnang'; // Tên database
        
        $conn = mysqli_connect($host, $user, $pwd, $db);

        mysqli_set_charset($conn, 'utf8');
        return $conn;
    }

    public function dongketnoi($conn) {
        $conn->close();
    }
}
?>