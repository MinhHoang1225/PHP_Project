
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
   <script src="../assets/js/font-aware.js"></script>
   <script src="../assets/js/navigation.js"></script>
   <style>
   :root {
  --bg-header: #e5e5e5;
  --bg-btn: #0c6478;
  --bg-hover-btn: #159198;
  --main-font: 'Poppins', sans-serif;
  --main-color: #000;
  --second-color: #666666b3;
  --title-text-size: 32px;
  --main-text-size: 16px;
  --highlight-color: #fc0;
}

body {
  font-family: var(--main-font);
  margin: 0;
  padding: 0;
  background-color: #f9f9f9;
  color: var(--main-color);
}

.about {
  display: flex;
  flex-direction: column;
  gap: 50px;
  background-color: #fff;
  padding: 50px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
}

/* CSS chung */
.heading-title {
  font-size: 2rem;
  font-weight: bold;
  text-transform: uppercase;
  color: var(--bg-btn);
  margin-bottom: 10px;
  text-align: center;
}

.row-line {
  width: 60px;
  height: 4px;
  background-color: var(--highlight-color);
  margin: 20px auto;
  border-radius: 2px;
}

.heading-description {
  font-size: 1.2rem;
  color: var(--second-color);
  line-height: 1.6;
  text-align: center;
}

/* Who We Are */
.who-we-are {
  display: flex;
  align-items: center;
  gap: 50px;
}

.who-we-are .image {
  flex: 1;
  border: 8px solid var(--highlight-color);
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.img-who-we-are {
  width: 100%;
  height: auto;
  object-fit: cover;
}

.heading-who-we-are {
  flex: 2;
  text-align: left;
}

.heading-who-we-are .heading-description {
  font-size: 1rem;
  margin-bottom: 15px;
}

/* What We Do */
.menu-description {
  list-style: none;
  padding: 0;
  margin: 0;
}

.menu-item {
  font-size: 1rem;
  margin-bottom: 10px;
  line-height: 1.5;
  position: relative;
}

.menu-item::before {
  content: '•';
  color: var(--highlight-color);
  margin-right: 10px;
  font-size: 1.2rem;
}

/* Our Team */
.our-team {
  text-align: center;
}

.card {
    display: grid;
    grid-auto-flow: column; /* Đặt tất cả thẻ vào hàng ngang */
    gap: 110px; /* Khoảng cách giữa các thẻ */
    justify-content: start; /* Hoặc dùng justify-content: center; để căn giữa */
    overflow-x: auto; /* Cho phép thanh cuộn nếu không đủ không gian */
}

.card-member {
    width: 300px;
    text-align: center;
    border-radius: 10px;
    overflow: hidden;
    background-color: #000;
    color: #fff;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}



.card-member:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.profile-image img {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.social-links {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-top: 15px;
}

.social-links a {
  color: var(--bg-btn);
  font-size: 1.5rem;
  transition: color 0.3s;
}

.social-links a:hover {
  color: var(--bg-hover-btn);
}

.info-member .name-member {
  font-size: 1.2rem;
  font-weight: bold;
  margin-top: 10px;
  color:#fff
}

.info-member .position-member {
  font-size: 1rem;
  color: #ccc;
  margin-top: 5px;
}

   </style>
</head>

<body>
<?php include("../component/header.php"); ?>

<div class="about">
        <div class="about-us">
            <h2 class="heading-title">About Us</h2>
            <p class="heading-description">Chào mừng bạn đến với <b>Sneakers Home</b>, nơi mang đến những đôi giày thể thao và phụ kiện thời trang đỉnh cao dành cho mọi phong cách. 
                Chúng tôi không chỉ là một cửa hàng trực tuyến, mà còn là nơi kết nối đam mê thời trang và phong cách sống hiện đại.</p>
        </div>
        <div class="who-we-are">
            <div class="row">
                <span class="row-line"></span>
            </div>
            <div class="heading-who-we-are">
                <h2 class="heading-title">Who We Are?</h2>
                <p class="heading-description"><b>Sneakers Home</b> là thương hiệu dành cho những ai yêu thích sự kết hợp giữa thời trang và sự tiện dụng. Với đội ngũ đam mê và chuyên nghiệp, 
                    chúng tôi cam kết mang đến cho bạn những sản phẩm chất lượng nhất, phù hợp với mọi lứa tuổi và xu hướng.</p>
                <p class="heading-description">Chúng tôi cũng hướng tới việc xây dựng một cộng đồng nơi những người yêu thích giày thể thao có thể chia sẻ phong cách,
                         tìm kiếm cảm hứng mới và luôn cập nhật những xu hướng thời trang mới nhất.</p>
                <p class="heading-description">Bên cạnh đó, <b>Sneakers Home</b> luôn chú trọng đến trải nghiệm của khách hàng, không chỉ thông qua sản phẩm mà còn qua dịch vụ chăm sóc tận tình. 
                        Chúng tôi mong muốn trở thành người bạn đồng hành đáng tin cậy, giúp bạn thể hiện cá tính và phong cách riêng qua từng bước chân.</p>
    
            </div>
            <div class="image">
                <img src="../assets/img/who_we_are.jpg" alt="" class="img-who-we-are">
            </div>
        </div>
        <div class="what-we-do">
            <div class="row">
                <span class="row-line"></span>
            </div>
            <div class="heading-what-we-do">
                <h2 class="heading-title">What We Do?</h2>
                <p class="heading-description">
                    <ul class="menu-description">
                        <li class="menu-item"><b>Cung cấp giày thể thao đa dạng:</b> Từ phong cách cổ điển đến hiện đại, chúng tôi luôn cập nhật những mẫu giày phù hợp với xu hướng thời trang toàn cầu.</li>
                        <li class="menu-item"><b>Phụ kiện đi kèm:</b> Áo và tất thời trang giúp bạn hoàn thiện phong cách cá nhân.</li>
                        <li class="menu-item"><b>Hỗ trợ mua sắm tiện lợi:</b> Với giao diện thân thiện, bạn dễ dàng tìm kiếm, chọn mua và thanh toán trực tuyến chỉ với vài bước đơn giản.</li>
                        <li class="menu-item"><b>Dịch vụ khách hàng chuyên nghiệp:</b> Chúng tôi luôn sẵn sàng hỗ trợ và tư vấn để mang đến trải nghiệm mua sắm tốt nhất.</li>
                    </ul>
                </p>
            </div>
        </div>
        <div class="our-team">
            <div class="row">
                <span class="row-line"></span>
            </div>
            <h2 class="heading-title">Our Team</h2>
            <div class="card">
            <div class="card-member">
                <div class="profile-image">
                    <img src="../assets/img/who_we_are.jpg" alt="Amanda Care">
                </div>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-solid fa-envelope"></i></i></a>
                </div>
                <div class="info-member">
                    <h2 class="name-member">Đoàn Minh Hoàng</h2>
                    <p class="position-member">Leader</p>
                </div>
                </div>
                <div class="card-member">
                    <div class="profile-image">
                    <img src="../assets/img/who_we_are.jpg" alt="Amanda Care">
                    </div>
                    <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-solid fa-envelope"></i></i></a>
                    </div>
                    <div class="info-member">
                    <h2 class="name-member">Trần Văn Vinh</h2>
                    <p class="position-member">Member</p>
                    </div>
                </div>
                <div class="card-member">
                    <div class="profile-image">
                    <img src="../assets/img/who_we_are.jpg" alt="Amanda Care">
                    </div>
                    <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-solid fa-envelope"></i></i></a>
                    </div>
                    <div class="info-member">
                    <h2 class="name-member">Hồ Thị Tiếp</h2>
                    <p class="position-member">Member</p>
                    </div>
                </div>
                <div class="card-member">
                    <div class="profile-image">
                    <img src="../assets/img/who_we_are.jpg" alt="Amanda Care">
                    </div>
                    <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-solid fa-envelope"></i></i></a>
                    </div>
                    <div class="info-member">
                    <h2 class="name-member">Bờ Nướch Hoài Tiên</h2>
                    <p class="position-member">Member</p>
                    </div>
                </div>
                <div class="card-member">
                    <div class="profile-image">
                    <img src="../assets/img/who_we_are.jpg" alt="Amanda Care">
                    </div>
                    <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-solid fa-envelope"></i></i></a>
                    </div>
                    <div class="info-member">
                    <h2 class="name-member">Coor Chăng</h2>
                    <p class="position-member">Member</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===================================================================== -->
</body>
<?php include("../component/footer.php") ?>
<?php include("../component/btn_up.php") ?>
</html>