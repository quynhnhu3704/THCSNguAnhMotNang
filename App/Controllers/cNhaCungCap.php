<?php
include_once('App/Models/mNhaCungCap.php');

class controlNhaCungCap {
    public function getAllNhaCungCap() {
        $p = new modelNhaCungCap();
        $kq = $p->selectAllNhaCungCap();

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function get01NhaCungCap($maNhaCungCap) {
        $p = new modelNhaCungCap();
        $kq = $p->select01NhaCungCap($maNhaCungCap);
        return $kq;
    }

    public function searchNhaCungCap($keyword) {
        $p = new modelNhaCungCap();
        $kq = $p->searchNhaCungCap($keyword);

        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function checkName($tenNhaCungCap) {
        $p = new modelNhaCungCap();
        $kq = $p->checkName($tenNhaCungCap);
        
        if(mysqli_num_rows($kq) > 0) {
            return $kq;
        } else {
            return false;
        }
    }

    public function insertNhaCungCap($tenNhaCungCap, $diaChi, $soDienThoai, $email) {
        $p = new modelNhaCungCap();
        $kq = $p->insertNhaCungCap($tenNhaCungCap, $diaChi, $soDienThoai, $email);
        return $kq;
    }

    public function updateNhaCungCap($maNhaCungCap, $tenNhaCungCap, $diaChi, $soDienThoai, $email) {
        $p = new modelNhaCungCap();
        $kq = $p->updateNhaCungCap($maNhaCungCap, $tenNhaCungCap, $diaChi, $soDienThoai, $email);
        return $kq;
    }

    public function deleteNhaCungCap($maNhaCungCap) {
        $p = new modelNhaCungCap();
        $kq = $p->deleteNhaCungCap($maNhaCungCap);
        return $kq;
    }
}
?>