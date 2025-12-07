<?php
function changeName($ten) {
    $unicode = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ|A|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ằ|Ẳ|Ẵ|Ặ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ|D|Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|E|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị|I|Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|O|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|U|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Y|Ý|Ỳ|Ỷ|Ỹ|Ỵ'
    );

    foreach($unicode as $nonUnicode => $uni) {
        $ten = preg_replace("/($uni)/i", $nonUnicode, $ten);
    }

    $ten = strtolower($ten);
    $ten = str_replace(' ', '-', $ten);
    return $ten;
}

function upload($hinhAnh) {
    $loi = []; // thêm biến lỗi

    if(!isset($hinhAnh) || $hinhAnh['error'] != 0) {
        $loi[] = "Không thể tải lên ảnh. Vui lòng thử lại.";
        return $loi;
    }

    $ext = strtolower(pathinfo($hinhAnh['name'], PATHINFO_EXTENSION));
    $size = $hinhAnh['size'];

    if(!in_array($ext, ['jpeg', 'jpg', 'png'])) {
        $loi[] = "Định dạng ảnh không hợp lệ. Chỉ hỗ trợ JPEG, JPG hoặc PNG.";
    }

    if($size > 500 * 1024) {
        $loi[] = "Kích thước ảnh vượt quá giới hạn 500KB.";
    }

    if(!empty($loi)) {
        return $loi;
    }

    $ten = pathinfo($hinhAnh['name'], PATHINFO_FILENAME);
    $hinh = changeName($ten) . '_' . time() . '.' . $ext;
    $path = 'public/uploads/' . $hinh;

    if(!move_uploaded_file($hinhAnh['tmp_name'], $path)) {
        $loi[] = "Không thể lưu ảnh lên máy chủ.";
        return $loi;
    }

    return $hinh; // trả về tên file nếu ok
}
?>