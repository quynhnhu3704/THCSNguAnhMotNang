<!doctype html>
<html lang="vi">
<?php
    session_start();
?>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Ngũ Anh Một Nàng Hotel – Đặt phòng trực tuyến</title>
    <meta name="description" content="Website đặt phòng khách sạn NguAnhMotNang – sang trọng, thân thiện, đặt phòng nhanh trong 60 giây."/>

    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">
                <i class="bi bi-sun"></i> Ngũ Anh Một Nàng
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"><span class="navbar-toggler-icon"></span></button>
            <div id="nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-2">
                    <li class="nav-item"><a class="nav-link active" href="#rooms">Phòng</a></li>
                    <li class="nav-item"><a class="nav-link" href="#amenities">Tiện nghi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#gallery">Thư viện ảnh</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Liên hệ</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-primary" href="#book">Đặt phòng</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero py-5 py-lg-6" style="min-height:72vh;">
        <div class="container position-relative" style="z-index:2">
            <div class="row align-items-center">
                <div class="col-lg-7 text-white">
                    <span class="badge badge-na rounded-pill px-3 py-2 mb-3">Ưu đãi mùa thu • Giảm đến 25%</span>
                    <h1 class="display-5 fw-extrabold">Chạm vào nắng – chạm vào sự an yên</h1>
                    <p class="lead opacity-75">Kỳ nghỉ sang trọng bên bờ biển với dịch vụ 5★, đặt phòng nhanh trong 60 giây. Bữa sáng và đưa đón sân bay tuỳ hạng.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#rooms" class="btn btn-light fw-semibold"><i class="bi bi-door-open"></i> Khám phá phòng</a>
                        <a href="#book" class="btn btn-outline-light fw-semibold"><i class="bi bi-calendar2-check"></i> Đặt ngay</a>
                    </div>
                </div>



                
                <!-- <div class="col-lg-5 mt-4 mt-lg-0">
                    <div id="book" class="card border-0 rounded-4 glass p-3 p-lg-4 sticky-book">
                        <h5 class="fw-bold mb-3"><i class="bi bi-calendar2-week me-2"></i>Đặt phòng nhanh</h5>
                        <form id="bookingForm" class="row g-3">
                            <div class="col-12 col-md-6">
                                <label class="form-label">Ngày nhận phòng</label>
                                <input type="date" class="form-control" id="checkin" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Ngày trả phòng</label>
                                <input type="date" class="form-control" id="checkout" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Số lượng khách</label>
                                <input type="number" class="form-control" id="guests" min="1" value="2" required>
                            </div>
                            <div class="col-12 col-md-6">
                                <label class="form-label">Số lượng phòng</label>
                                <input type="number" class="form-control" id="roomsCount" min="1" value="1" required>
                            </div>
                            <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Kiểm tra phòng trống</button>
                            </div>
                            <div class="col-12 small text-muted text-center">Đảm bảo giá tốt nhất • Xác nhận tức thì</div>
                        </form>
                    </div>
                </div> -->



            </div>
        </div>
    </header>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-6 col-lg-3">
                    <div class="card-na p-4 h-100">
                        <i class="bi bi-stars fs-3 text-primary"></i>
                        <h6 class="mt-2 mb-0">5★ dịch vụ</h6>
                        <div class="small text-muted">Lễ tân 24/7, concierge</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card-na p-4 h-100">
                        <i class="bi bi-umbrella fs-3 text-primary"></i>
                        <h6 class="mt-2 mb-0">Bãi biển riêng</h6>
                        <div class="small text-muted">Cabana & pool bar</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card-na p-4 h-100">
                        <i class="bi bi-wifi fs-3 text-primary"></i>
                        <h6 class="mt-2 mb-0">Wi‑Fi tốc độ cao</h6>
                        <div class="small text-muted">Miễn phí toàn khu</div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card-na p-4 h-100">
                        <i class="bi bi-cup-hot fs-3 text-primary"></i>
                        <h6 class="mt-2 mb-0">Bữa sáng phong phú</h6>
                        <div class="small text-muted">Âu – Á – Healthy</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="rooms" class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap align-items-end justify-content-between mb-4 gap-2">
                <div>
                    <h2 class="section-heading mb-1">Hạng phòng nổi bật</h2>
                    <div class="text-muted">Chọn không gian phù hợp cho kỳ nghỉ của bạn</div>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm" data-filter="all">Tất cả</button>
                    <button class="btn btn-outline-primary btn-sm" data-filter="sea">View biển</button>
                    <button class="btn btn-outline-primary btn-sm" data-filter="suite">Suite</button>
                    <button class="btn btn-outline-primary btn-sm" data-filter="garden">Vườn</button>
                </div>
            </div>

            <div class="row g-4" id="roomsGrid">
                <div class="col-md-6 col-lg-4" data-tags="sea suite">
                    <div class="card-na overflow-hidden h-100">
                        <div class="position-relative">
                            <img src="image/Ocean Panorama Suite.png" class="w-100" alt="Ocean Panorama Suite">
                            <span class="position-absolute top-0 start-0 m-3 badge badge-na rounded-pill">Best Seller</span>
                        </div>
                        <div class="p-3 p-lg-4 d-flex flex-column">
                            <h5 class="fw-bold mb-1">Ocean Panorama Suite</h5>
                            <div class="d-flex align-items-center gap-2 mb-2 small text-muted">
                                <span class="rating">★★★★★</span> • 45m² • Ban công lớn
                            </div>
                            <ul class="list-unstyled small text-muted mb-3">
                                <li><i class="bi bi-check2 text-primary"></i> Bao gồm bữa sáng cho 2 khách</li>
                                <li><i class="bi bi-check2 text-primary"></i> Phòng tắm đá cẩm thạch, bồn tắm</li>
                                <li><i class="bi bi-check2 text-primary"></i> Minibar miễn phí ngày đầu</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="room-price h5 mb-0">3.200.000₫/đêm</div>
                                <button class="btn btn-primary" data-room="Ocean Panorama Suite">Chọn phòng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-tags="garden">
                    <div class="card-na overflow-hidden h-100">
                        <img src="image/Garden Deluxe.png" class="w-100" alt="Garden Deluxe">
                        <div class="p-3 p-lg-4 d-flex flex-column">
                            <h5 class="fw-bold mb-1">Garden Deluxe</h5>
                            <div class="d-flex align-items-center gap-2 mb-2 small text-muted">
                                <span class="rating">★★★★☆</span> • 32m² • Sân vườn
                            </div>
                            <ul class="list-unstyled small text-muted mb-3">
                                <li><i class="bi bi-check2 text-primary"></i> Máy pha cà phê viên</li>
                                <li><i class="bi bi-check2 text-primary"></i> Sofa đọc sách</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="room-price h5 mb-0">2.150.000₫/đêm</div>
                                <button class="btn btn-primary" data-room="Garden Deluxe">Chọn phòng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-tags="sea">
                    <div class="card-na overflow-hidden h-100">
                        <img src="image/Sea View Premier.png" class="w-100" alt="Sea View Premier">
                        <div class="p-3 p-lg-4 d-flex flex-column">
                            <h5 class="fw-bold mb-1">Sea View Premier</h5>
                            <div class="d-flex align-items-center gap-2 mb-2 small text-muted">
                                <span class="rating">★★★★☆</span> • 38m² • View biển
                            </div>
                            <ul class="list-unstyled small text-muted mb-3">
                                <li><i class="bi bi-check2 text-primary"></i> Ban công riêng</li>
                                <li><i class="bi bi-check2 text-primary"></i> Làm mát không khí lọc HEPA</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="room-price h5 mb-0">2.680.000₫/đêm</div>
                                <button class="btn btn-primary" data-room="Sea View Premier">Chọn phòng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-tags="suite">
                    <div class="card-na overflow-hidden h-100">
                        <img src="image/Sunset Corner Suite.png" class="w-100" alt="Sunset Corner Suite">
                        <div class="p-3 p-lg-4 d-flex flex-column">
                            <h5 class="fw-bold mb-1">Sunset Corner Suite</h5>
                            <div class="d-flex align-items-center gap-2 mb-2 small text-muted">
                                <span class="rating">★★★★★</span> • 52m² • Góc 2 mặt thoáng
                            </div>
                            <ul class="list-unstyled small text-muted mb-3">
                                <li><i class="bi bi-check2 text-primary"></i> Phòng khách riêng</li>
                                <li><i class="bi bi-check2 text-primary"></i> Đưa đón sân bay</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="room-price h5 mb-0">4.450.000₫/đêm</div>
                                <button class="btn btn-primary" data-room="Sunset Corner Suite">Chọn phòng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-tags="garden">
                    <div class="card-na overflow-hidden h-100">
                        <img src="image/Tropical Family Room.png" class="w-100" alt="Tropical Family Room">
                        <div class="p-3 p-lg-4 d-flex flex-column">
                            <h5 class="fw-bold mb-1">Tropical Family Room</h5>
                            <div class="d-flex align-items-center gap-2 mb-2 small text-muted">
                                <span class="rating">★★★★☆</span> • 44m² • Phù hợp gia đình
                            </div>
                            <ul class="list-unstyled small text-muted mb-3">
                                <li><i class="bi bi-check2 text-primary"></i> Giường phụ miễn phí trẻ < 6 tuổi</li>
                                <li><i class="bi bi-check2 text-primary"></i> Khu vui chơi gần phòng</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="room-price h5 mb-0">2.850.000₫/đêm</div>
                                <button class="btn btn-primary" data-room="Tropical Family Room">Chọn phòng</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4" data-tags="sea">
                    <div class="card-na overflow-hidden h-100">
                        <img src="image/Beachfront Deluxe.png" class="w-100" alt="Beachfront Deluxe">
                        <div class="p-3 p-lg-4 d-flex flex-column">
                            <h5 class="fw-bold mb-1">Beachfront Deluxe</h5>
                            <div class="d-flex align-items-center gap-2 mb-2 small text-muted">
                                <span class="rating">★★★★☆</span> • 36m² • Sát biển
                            </div>
                            <ul class="list-unstyled small text-muted mb-3">
                                <li><i class="bi bi-check2 text-primary"></i> Trực tiếp ra bãi cát</li>
                                <li><i class="bi bi-check2 text-primary"></i> Ghế tắm nắng riêng</li>
                            </ul>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <div class="room-price h5 mb-0">2.980.000₫/đêm</div>
                                <button class="btn btn-primary" data-room="Beachfront Deluxe">Chọn phòng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="amenities" class="py-5 bg-white">
        <div class="container">
            <h2 class="section-heading mb-4">Tiện nghi & Dịch vụ</h2>
            <div class="row g-4">
                <div class="col-6 col-lg-3 amenity">
                    <i class="bi bi-droplet"></i>
                    <div class="fw-bold">Ngũ Anh Một Nàng Spa</div>
                    <div class="small text-muted">Liệu pháp tinh dầu bản địa</div>
                </div>
                <div class="col-6 col-lg-3 amenity">
                    <i class="bi bi-cup-straw"></i>
                    <div class="fw-bold">Pool Bar</div>
                    <div class="small text-muted">Cocktail & bánh ngọt thủ công</div>
                </div>
                <div class="col-6 col-lg-3 amenity">
                    <i class="bi bi-bicycle"></i>
                    <div class="fw-bold">Hoạt động</div>
                    <div class="small text-muted">Xe đạp – Kayak – Yoga</div>
                </div>
                <div class="col-6 col-lg-3 amenity">
                    <i class="bi bi-shield-check"></i>
                    <div class="fw-bold">An toàn</div>
                    <div class="small text-muted">Bảo vệ 24/7 – Tủ đồ số</div>
                </div>
            </div>
        </div>
    </section>

    <section id="gallery" class="py-5">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end mb-3">
                <h2 class="section-heading">Thư viện ảnh</h2>
                <a class="btn btn-outline-primary btn-sm" href="#contact"><i class="bi bi-camera"></i> Yêu cầu chụp ảnh</a>
            </div>
            <div class="row g-3 gallery">
                <div class="col-6 col-lg-3"><img class="w-100 rounded-4" src="image/Lobby.png" alt="Lobby"></div>
                <div class="col-6 col-lg-3"><img class="w-100 rounded-4" src="image/Pool.png" alt="Pool"></div>
                <div class="col-6 col-lg-3"><img class="w-100 rounded-4" src="image/Breakfast.png" alt="Breakfast"></div>
                <div class="col-6 col-lg-3"><img class="w-100 rounded-4" src="image/Spa.png" alt="Spa"></div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <h2 class="section-heading mb-4">Khách nói gì về Ngũ Anh Một Nàng</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card-na p-4 h-100">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/60?img=5" class="rounded-circle me-2" width="48" height="48" alt="avatar">
                            <div><strong>Quỳnh Như</strong><div class="small text-muted">Lưu trú 07/2025</div></div>
                        </div>
                        <div class="rating mb-2">★★★★★</div>
                        <p class="mb-0">Phòng hướng biển đỉnh thật sự, bữa sáng đa dạng. Nhân viên rất dễ thương, sẽ quay lại!</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-na p-4 h-100">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/60?img=33" class="rounded-circle me-2" width="48" height="48" alt="avatar">
                            <div><strong>Trọng Thuần</strong><div class="small text-muted">Lưu trú 06/2025</div></div>
                        </div>
                        <div class="rating mb-2">★★★★★</div>
                        <p class="mb-0">Dịch vụ xứng đáng 5 sao, có xe đưa đón sân bay miễn phí hạng suite, quá tiện!</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-na p-4 h-100">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/60?img=12" class="rounded-circle me-2" width="48" height="48" alt="avatar">
                            <div><strong>Văn Quân</strong><div class="small text-muted">Lưu trú 05/2025</div></div>
                        </div>
                        <div class="rating mb-2">★★★★☆</div>
                        <p class="mb-0">Không gian chill, pool bar view hoàng hôn siêu đẹp. Giá hợp lý so với chất lượng.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-na p-4 h-100">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/60?img=33" class="rounded-circle me-2" width="48" height="48" alt="avatar">
                            <div><strong>Minh Trung</strong><div class="small text-muted">Lưu trú 04/2025</div></div>
                        </div>
                        <div class="rating mb-2">★★★★★</div>
                        <p class="mb-0">Dịch vụ tuyệt hảo, nhân viên luôn nở nụ cười và hỗ trợ tận tình từ khi nhận phòng đến khi trả phòng.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-na p-4 h-100">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/60?img=12" class="rounded-circle me-2" width="48" height="48" alt="avatar">
                            <div><strong>Văn Tiến</strong><div class="small text-muted">Lưu trú 03/2025</div></div>
                        </div>
                        <div class="rating mb-2">★★★☆☆</div>
                        <p class="mb-0">Phòng rộng rãi, sạch sẽ, view biển tuyệt đẹp khiến mỗi buổi sáng đều tràn đầy năng lượng.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="card-na p-4 h-100">
                        <div class="d-flex align-items-center mb-2">
                            <img src="https://i.pravatar.cc/60?img=33" class="rounded-circle me-2" width="48" height="48" alt="avatar">
                            <div><strong>Điền Thịnh</strong><div class="small text-muted">Lưu trú 02/2025</div></div>
                        </div>
                        <div class="rating mb-2">★★★★★</div>
                        <p class="mb-0">Một kỳ nghỉ yên bình, mọi chi tiết đều được chăm chút, khiến tôi muốn quay lại nhiều lần nữa.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-5">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-heading mb-2">Đặt phòng số lượng lớn?</h2>
                    <p class="text-muted">Đội ngũ kinh doanh sẽ phản hồi trong 2 giờ làm việc.</p>
                    <ul class="list-unstyled text-muted">
                        <li><i class="bi bi-telephone text-primary"></i> 028 3 888 6868</li>
                        <li><i class="bi bi-envelope text-primary"></i> sales@nguanhmotnang.vn</li>
                        <li><i class="bi bi-geo-alt text-primary"></i> 88 Đường Biển Xanh, Phường Mặt Trời, TP. Gió Lành</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="card-na p-4">
                        <form id="contactForm" class="row g-3">
                            <div class="col-md-6"><input class="form-control" placeholder="Họ và tên" required></div>
                            <div class="col-md-6"><input class="form-control" type="email" placeholder="Email" required></div>
                            <div class="col-md-6"><input class="form-control" type="tel" placeholder="Số điện thoại" required></div>
                            <div class="col-md-6"><input class="form-control" type="number" min="10" placeholder="Số khách (tối thiểu 10)" required></div>
                            <div class="col-12"><textarea class="form-control" rows="3" placeholder="Nội dung yêu cầu"></textarea></div>
                            <div class="col-12 d-grid"><button class="btn btn-primary" type="submit">Gửi yêu cầu</button></div>
                            <div class="col-12 small text-muted text-center">Chúng tôi tôn trọng quyền riêng tư của bạn.</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="pt-5" style="background:linear-gradient(180deg,var(--na-primary), var(--na-primary-2)); color:#fff;">
        <div class="container pb-4">
            <div class="row g-4">
                <div class="col-lg-4">
                    <h5 class="fw-bold"><i class="bi bi-sun"></i> Ngũ Anh Một Nàng</h5>
                    <p class="opacity-75">Nơi mỗi tia nắng đánh thức cảm hứng sống. Đặt phòng nhanh – hưởng ưu đãi tốt nhất.</p>
                </div>
                <div class="col-6 col-lg-2">
                    <div class="fw-semibold">Khách sạn</div>
                    <ul class="list-unstyled">
                        <li><a class="footer-link text-decoration-none" href="#rooms">Phòng</a></li>
                        <li><a class="footer-link text-decoration-none" href="#amenities">Tiện nghi</a></li>
                        <li><a class="footer-link text-decoration-none" href="#gallery">Ảnh</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="fw-semibold">Chính sách</div>
                    <ul class="list-unstyled">
                        <li><span class="footer-link">Nhận phòng: 14:00 • Trả phòng: 12:00</span></li>
                        <li><span class="footer-link">Huỷ miễn phí trong 48h</span></li>
                        <li><span class="footer-link">Không hút thuốc trong phòng</span></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <div class="fw-semibold">Kết nối</div>
                    <div class="d-flex gap-3">
                        <a class="text-white" href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                        <a class="text-white" href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                        <a class="text-white" href="https://www.youtube.com/"><i class="bi bi-youtube"></i></a>
                    </div>
                    <div class="small opacity-75 mt-3">© 2025 Ngũ Anh Một Nàng Hotel</div>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="bookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Xác nhận đặt phòng</h5>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-2"><strong>Hạng phòng:</strong> <span id="modalRoom">—</span></div>
                    <div class="mb-2"><strong>Nhận phòng:</strong> <span id="modalCheckin">—</span></div>
                    <div class="mb-2"><strong>Trả phòng:</strong> <span id="modalCheckout">—</span></div>
                    <div class="mb-2"><strong>Khách:</strong> <span id="modalGuests">—</span></div>
                    <div class="mb-2"><strong>Số phòng:</strong> <span id="modalRooms">—</span></div>
                    <div class="small text-muted">* Giá hiển thị đã bao gồm thuế phí. Bạn sẽ nhận email xác nhận ngay sau khi hoàn tất.</div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Để sau</button>
                    <button class="btn btn-primary" id="confirmBooking">Xác nhận & Thanh toán</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const checkin = document.getElementById('checkin');
        const checkout = document.getElementById('checkout');
        const today = new Date();
        const toISO = (d)=> d.toISOString().split('T')[0];
        today.setHours(0,0,0,0);
        checkin.min = toISO(today);
        checkin.value = toISO(today);
        const tomorrow = new Date(today); 
        tomorrow.setDate(tomorrow.getDate()+1);
        checkout.min = toISO(tomorrow);
        checkout.value = toISO(tomorrow);
        
        checkin.addEventListener('change', ()=>{
            const ci = new Date(checkin.value);
            const coMin = new Date(ci); 
            coMin.setDate(coMin.getDate()+1);
            checkout.min = toISO(coMin);
            if(new Date(checkout.value) <= ci) { 
                checkout.value = toISO(coMin);
            }
        });

        // Lọc hạng phòng
        document.querySelectorAll('[data-filter]').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                const tag = btn.getAttribute('data-filter');
                document.querySelectorAll('#roomsGrid > [data-tags]').forEach(col=>{
                    const tags = col.getAttribute('data-tags');
                    col.style.display = (tag==='all' || tags.includes(tag)) ? '' : 'none';
                });
            });
        });

        // Modal chọn phòng
        const bookForm = document.getElementById('bookingForm');
        let selectedRoom = null;

        document.querySelectorAll('[data-room]').forEach(b=>{
            b.addEventListener('click', ()=>{
                selectedRoom = b.getAttribute('data-room');
                document.getElementById('modalRoom').textContent = selectedRoom;
                document.getElementById('modalCheckin').textContent = checkin.value;
                document.getElementById('modalCheckout').textContent = checkout.value;
                document.getElementById('modalGuests').textContent = document.getElementById('guests').value;
                document.getElementById('modalRooms').textContent = document.getElementById('roomsCount').value;
                new bootstrap.Modal('#bookModal').show();
            });
        });

        // Confirm booking (demo)
        document.getElementById('confirmBooking').addEventListener('click', ()=>{
            alert(msg + 'Đặt phòng đã được giữ chỗ. Tiếp tục thanh toán qua cổng an toàn.');
            bootstrap.Modal.getInstance(document.getElementById('bookModal')).hide();
        });

        // Book from hero form (find availability)
        bookForm.addEventListener('submit', (e)=>{
            e.preventDefault();
            // In real app: call API check availability, then scroll to rooms
            document.getElementById('rooms').scrollIntoView({behavior:'smooth'});
        });

        // Contact form demo submit
        document.getElementById('contactForm').addEventListener('submit', (e)=>{
            e.preventDefault();
            alert('Cám ơn bạn! Bộ phận kinh doanh sẽ liên hệ trong 2 giờ làm việc.');
            e.target.reset();
        });
    </script>
</body>
</html>