<section id="rooms" class="py-5">
    <div class="container">
        <div class="d-flex flex-wrap align-items-end justify-content-between mb-4 gap-2">
            <div>
                <h2 class="section-heading mb-1">Danh sách thiết bị</h2>
                <div class="text-muted">Quản lý và theo dõi toàn bộ thiết bị trong trường</div>
            </div>
        </div>

        <div class="row g-4" id="roomsGrid">
        <?php
            include_once('Controller/cTypeOfRoom.php');
            $p = new controlTOR();

            // if(isset($_GET['keyword'])) {
            //     $keyword = $_GET['keyword'];
            //     $kq = $p->searchProduct($keyword);
            // } else if(isset($_GET['type_id'])) {
            //     $type_id = $_GET['type_id'];
            //     $kq = $p->getAllProductByType($type_id);
            // } else {
                $kq = $p->getAllTOR();
            // }

            if ($kq && $kq->num_rows > 0) {
                while ($r = $kq->fetch_assoc()) {
                    echo '<div class="col-md-6 col-lg-4">';
                        echo '<div class="card-na overflow-hidden h-100">';
                            echo '<div class="position-relative">';
                                echo '<img src="image/' . $r['image'] . '" class="w-100" alt="">';
                                echo '<span class="position-absolute top-0 start-0 m-3 badge badge-na rounded-pill">' . $r['badge'] . '</span>';
                            echo '</div>';
                            echo '<div class="p-3 p-lg-4 d-flex flex-column">';
                                echo '<h5 class="fw-bold mb-1">' . $r['type_name'] . '</h5>';
                                echo '<div class="d-flex align-items-center gap-2 mb-2 small text-muted">';
                                    // ⭐ Hiển thị số sao
                                    $fullStars = floor($r['rating']);
                                    $emptyStars = 5 - $fullStars;
                                    echo '<span class="rating">';
                                        echo str_repeat('★', $fullStars);
                                        echo str_repeat('☆', $emptyStars);
                                    echo '</span>';

                                    echo ' • ' . $r['size'] . 'm² • ' . $r['location'];
                                echo '</div>';
                                echo '<ul class="list-unstyled small text-muted mb-3">';
                                    $features = explode(';', $r['features']);
                                    foreach ($features as $f) {
                                        echo '<li><i class="bi bi-check2 text-primary"></i> ' . $f . '</li>';
                                    }
                                echo '</ul>';
                                echo '<div class="d-flex align-items-center justify-content-between mt-auto">';
                                    echo '<div class="room-price h5 mb-0">' . number_format($r['price'], 0, ',', '.') . '₫/đêm</div>';
                                    // echo '<a href="index.php?page=chitietphong&slug=' . $r['slug'] . '" class="btn btn-primary">Xem chi tiết</a>';
                                    // echo '<a href="index.php?page=chitietphong&type_id=' . $r['type_id'] . '" class="btn btn-primary">Xem chi tiết</a>';
                                    echo '<a href="index.php?page=chitietphong&type_id=' . $r['type_id'] . '&slug=' . $r['slug'] . '" class="btn btn-primary">Xem chi tiết</a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<h2>Chúng tôi tạm thời chưa có phòng nào, mời bạn quay lại sau.</h2>';
            }
        ?>
        </div>
    </div>
</section>