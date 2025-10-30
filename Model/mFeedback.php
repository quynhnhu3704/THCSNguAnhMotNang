<?php
    include_once('mketnoi.php');

    class modelFeedback {
        public function selectAllFeedback() {
            $p = new clsKetNoi();
            $truyvan = "select * from feedbacks";
            $con = $p->moketnoi();
            $kq = mysqli_query($con, $truyvan);
            $p->dongketnoi($con);
            return $kq;
        }
    }
?>