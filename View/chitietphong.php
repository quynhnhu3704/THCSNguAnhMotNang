<?php
    include_once('Controller/cTypeOfRoom.php');
    $p = new controlTOR();

    if (isset($_GET['type_id'])) {
        $type_id = $_GET['type_id'];
        $kq = $p->get01TOR($type_id);
    } else {
        echo "<h2>Chúng tôi tạm thời chưa có phòng nào, mời bạn quay lại sau.</h2>";
        exit();
    }

    if ($kq && $kq->num_rows > 0) {
        $r = $kq->fetch_assoc();
    } else {
        echo "<h2>Chúng tôi tạm thời chưa có phòng nào, mời bạn quay lại sau.</h2>";
        exit();
    }
?>

<div class="container my-5">
    <a href="index.php#rooms" class="btn btn-outline-primary mb-4"><i class="bi bi-arrow-left"></i> Quay lại</a>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card-na p-3 position-sticky" style="top: 1rem;">
                <img id="main-room-image" src="image/<?php echo $r['image']; ?>" alt="<?php echo $r['type_name']; ?>" class="w-100 rounded-4 shadow-sm">

                <?php if($r['badge']): ?>
                    <span class="position-absolute top-0 start-0 badge badge-na rounded-pill m-4"><?php echo $r['badge']; ?></span>
                <?php endif; ?>
                
                <?php if(!empty($r['gallery'])): 
                    $images = explode(';', $r['gallery']);
                ?>

                <div class="row mt-3 g-2">
                    <?php foreach($images as $img): ?>
                        <div class="col-3">
                            <img src="image/<?php echo $img; ?>" class="w-100 rounded-3 shadow-sm gallery-thumb" alt="" style="cursor:pointer;">
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card-na p-4 h-100 d-flex flex-column">
                <h1 class="mb-3 fw-semibold"><?php echo $r['type_name']; ?></h1>
                
                <div class="mb-3 text-muted d-flex align-items-center gap-2">
                    <span class="rating fs-5">
                        <?php
                            $fullStars = floor($r['rating']);
                            $emptyStars = 5 - $fullStars;
                            echo str_repeat('★', $fullStars) . str_repeat('☆', $emptyStars);
                        ?>
                    </span>
                    <span>• <?php echo $r['size']; ?>m² • <?php echo $r['location']; ?></span>
                </div>

                <ul class="list-unstyled mb-4">
                    <?php
                        $features = explode(';', $r['features']);
                        foreach ($features as $f) {
                            echo '<li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>' . $f . '</li>';
                        }
                    ?>
                </ul>

                <h3 class="text-primary fw-bold mb-4"><?php echo number_format($r['price'], 0, ',', '.'); ?>₫/đêm</h3>
                <p class="mb-4"><?php echo nl2br($r['description']); ?></p>
                <a href="booking.php?slug=<?php echo $r['slug']; ?>" class="btn btn-primary btn-lg mt-auto align-self-start">
                    <i class="bi bi-calendar2-check me-2"></i> Đặt phòng ngay
                </a>
            </div>
        </div>        
    </div>
</div>

<!-- JS: Chuyển ảnh chính theo ảnh thumbnail khi click -->
<script>
    const $mainImage = $('#main-room-image');
    const $thumbs = $('.gallery-thumb');

    $thumbs.on('click', function() {
        $mainImage.attr('src', $(this).attr('src'));
    });
</script>