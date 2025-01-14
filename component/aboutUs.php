  <!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>About Us</title>
      <link rel="stylesheet" href="assets/css/aboutUs.css">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container-big">
      <div class="container">
        <!-- News -->
        <div class="title-product-main"> 
          <h2 class="section-title">
              <span class="text-uppercase fw-bold">
                TIN TỨC
              </span>
          </h2>
          
        </div>
        <!-- About Us -->
        <div class="row bannerNews-home">
          <div class="col-3">
            <div class="bannerNews-home-content">
              <a class="image-content" style="text-decoration: none;">
                <img src="assets/img/aboutUs_img/sale.png" alt="Sale">
              </a>
              <a href="javascript:void(0);" class="bannerNews-home-name">Sale</a>
            </div>
          </div>

          <div class="col-6 bannerNews-home__mid">
            <div class="bannerNews-home-content">
              <a href="" class="image-content">
                <img src="assets/img/aboutUs_img/aboutUs.png" alt="About us">
              </a>
              <div class="bannerNews-home-name" id="navigate_about">About us</div>
            </div>
          </div>
          <div class="col-3">
            <div class="bannerNews-home-content">
              <a class="image-content" style="text-decoration: none">
                <img src="assets/img/aboutUs_img/sale.png" alt="Sale">
              </a>
              <a href="javascript:void(0);" class="bannerNews-home-name">Super Sale</a>
            </div>
          </div>
        </div>

        </div>
      </div>

    </div>
    <script>
      document.getElementById("navigate_about").onclick = function() {
          setTimeout(function() {
              window.location.href = "./view/aboutus.php";
          }, 600);
        };
    </script>
  </body>
  </html>