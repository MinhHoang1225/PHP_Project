<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sản phẩm</title>
<link rel="stylesheet" href="../assets/css/detail_product.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="product-container">
        <div class="breadcrumb">
            <a href="#">Trang chủ</a> / <a href="#">Quần áo</a>
        </div>
        <div class="product-details">
            <div class="product-image-slider"> 
                <div class="slide-container">
                    <div class="slide">
                        <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_dZgJKtFCz30YW9owCdOGrnL0.png" alt="Sản phẩm 1">
                    </div>
                    <div class="slide">
                        <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_xrt2x5YMMxm8PXSeoZP8LXJo.png" alt="Sản phẩm 2">
                    </div>
                    <div class="slide">
                        <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_ppm7XRanLvI0v1gbAcBlvXw5.png" alt="Sản phẩm 3">
                    </div>
                    <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
                    <button class="next" onclick="changeSlide(1)">&#10095;</button>
                </div> 
                <div class="dot-container">
                    <span class="dot" onclick="currentSlide(1)"></span>
                    <span class="dot" onclick="currentSlide(2)"></span>
                    <span class="dot" onclick="currentSlide(3)"></span>
                </div> 
                <div class="thumbnail-gallery">
                    <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_dZgJKtFCz30YW9owCdOGrnL0.png" alt="Thumbnail 1" onclick="currentSlide(1)">
                    <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_xrt2x5YMMxm8PXSeoZP8LXJo.png" alt="Thumbnail 2" onclick="currentSlide(2)">
                    <img src="https://pos.nvncdn.com/eb9ddb-116318/ps/20220323_ppm7XRanLvI0v1gbAcBlvXw5.png" alt="Thumbnail 3" onclick="currentSlide(3)">
                </div>
            </div> 
            <div class="product-info">
                <h1>Quần Nike AS M NSW Club JGGR FT 'Black'</h1>
                <p class="product-price">2.100.000₫</p>
                <div class="product-size">
                    <label>Size:</label>
                    <div class="size-options">
                        <button>L</button>
                        <button>M</button>
                        <button>S</button>
                    </div>
                </div> 
                <p class="stock-status">Còn hàng</p>
                <div class="quantity-control">
                    <button class="qty-btn decrement">-</button>
                    <input type="text" value="1" class="quantity-input">
                    <button class="qty-btn increment">+</button>
                </div>
                
                <div class="product-actions">
                    <button class="add-to-cart">Thêm vào giỏ hàng</button>
                    <button class="buy-now">Mua ngay</button>
                </div>
                <button class="contact-btn">Liên hệ chúng tôi</button>
                <div class="product-meta">
                    <p>Mã: Q1203</p>
                    <p>Danh mục: Quần áo</p>
                    <div class="social-icons">
                        <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="icon"><i class="fas fa-envelope"></i></a>
                        <a href="#" class="icon"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
 <script>
    let slideIndex = 1;
    showSlide(slideIndex);

    function changeSlide(n) {
        showSlide(slideIndex += n);
    }

    function currentSlide(n) {
        showSlide(slideIndex = n);
    }

    function showSlide(n) {
        const slides = document.querySelectorAll(".slide");
        const dots = document.querySelectorAll(".dot");

        if (n > slides.length) { slideIndex = 1 }
        if (n < 1) { slideIndex = slides.length }

        slides.forEach(slide => slide.style.display = "none");
        dots.forEach(dot => dot.classList.remove("active"));

        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].classList.add("active");
    }

    const decrementBtn = document.querySelector(".decrement");
    const incrementBtn = document.querySelector(".increment");
    const quantityInput = document.querySelector(".quantity-input");
    decrementBtn.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) { 
            quantityInput.value = currentValue - 1;
        }
    });
    incrementBtn.addEventListener("click", () => {
        let currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
    });
    
 </script>
 </body>
</html>
