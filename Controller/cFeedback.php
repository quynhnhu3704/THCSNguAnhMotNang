<?php
    include_once('Model/mFeedback.php');

    class controlFeedback {
        public function getAllFeedback() {
            $p = new modelFeedback();
            $kq = $p->selectAllFeedback();

            if(mysqli_num_rows($kq) > 0) {
                return $kq;
            } else {
                return false;
            }
        }
    }
?>