<!-- App/Views/common/thietbi.php -->
<section id="thietbi" class="py-5">
    <div class="container-fluid px-4">
        <div class="row">
            <!-- Sidebar bộ môn -->
            <div class="col-md-3 mb-4">
                <div class="card position-sticky" style="top: 4em">
                    <div class="card-header bg-primary text-white fw-bold">Bộ môn</div>
                    <ul class="list-group list-group-flush">
                        <?php
                        include_once('App/Controllers/cBoMon.php');
                        $p = new controlBoMon();
                        $kq = $p->getAllBoMon();
                        if ($kq && $kq->num_rows > 0) {
                            echo '<li class="list-group-item">';
                                echo "<a href='index.php' class='text-decoration-none text-dark'>Tất cả</a>";
                            echo '</li>';
                            while ($r = $kq->fetch_assoc()) {
                                echo '<li class="list-group-item">';
                                echo "<a href='index.php?maBoMon=" . $r['maBoMon'] . "' class='text-decoration-none text-dark'>" . $r['tenBoMon'] . "</a>";
                                echo '</li>';
                            }
                        } else {
                            echo '<li class="list-group-item text-muted">Chưa có bộ môn</li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>

            <!-- Danh sách thiết bị -->
            <div class="col-md-9">                
                <!-- Hiển thị tiêu đề dựa trên bộ môn đã chọn hoặc từ khóa tìm kiếm -->
                <div class="d-flex flex-wrap align-items-end justify-content-between mb-4 gap-2">
                    <div>
                        <?php
                        $title = "Danh sách thiết bị";

                        if (isset($_GET['maBoMon'])) {
                            $maBoMon = $_GET['maBoMon'];
                            $kq = $p->get01BoMon($maBoMon);
                            if ($kq && $r = $kq->fetch_assoc()) {
                                $title = "Kết quả lọc theo bộ môn: " . $r['tenBoMon'];
                            }
                        } else if (isset($_GET['keyword'])) {
                            $keyword = $_GET['keyword'];
                            $title = "Kết quả tìm kiếm cho: " . $keyword;
                        }
                        ?>
                        <h2 class="section-heading mb-1"><?= $title ?></h2>
                        <div class="text-muted">Quản lý và theo dõi toàn bộ thiết bị trong trường</div>
                    </div>
                </div>
                
                <div class="row g-4">
                <?php
                include_once('App/Controllers/cThietBi.php');
                $p = new controlThietBi();

                if(isset($_GET['keyword'])) {
                    $keyword = $_GET['keyword'];
                    $kq = $p->searchThietBi($keyword);
                } else if(isset($_GET['maBoMon'])) {
                    $maBoMon = $_GET['maBoMon'];
                    $kq = $p->getAllThietBiTheoBoMon($maBoMon);
                } else {
                    $kq = $p->getAllThietBi();
                }

                if ($kq && $kq->num_rows > 0) {
                    while ($r = $kq->fetch_assoc()) {
                        echo '<div class="col-md-6 col-lg-3">';
                            echo '<div class="card-na overflow-hidden h-100">';
                                echo '<div class="position-relative">';
                                    echo '<img src="public/uploads/' . $r['hinhAnh'] . '" class="w-100" alt="' . $r['tenThietBi'] . '">';
                                    echo '<span class="position-absolute top-0 start-0 m-3 badge badge-na rounded-pill">' . $r['tenBoMon'] . '</span>';
                                echo '</div>';
                                echo '<div class="p-3 p-lg-4 d-flex flex-column">';
                                    echo '<h6 class="fw-bold mb-3">' . $r['tenThietBi'] . '</h6>';
                                    echo '<div class="d-flex align-items-center justify-content-between mt-auto">';
                                        echo '<a href="index.php?page=chitietthietbi&maThietBi=' . $r['maThietBi'] . '" class="btn btn-primary">Xem chi tiết</a>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<h3 class="text-muted">Chúng tôi tạm thời chưa có thiết bị nào, mời bạn quay lại sau.</h3>';
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>