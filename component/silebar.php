<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slidebar</title>
    <link rel="stylesheet" href="../assets/css/slidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ZuDOWmXYwsLmkBES2CPGpFq7dURrvlDGlW+BaYa4Ry/eKcsEyZdXey6D9+Q4SToj" crossorigin="anonymous">
</head>
<body>
    <div class="left-page">
        <div class="left-page__content">
            <!-- Top -->
            <div class="mb-4 filter_product_category">
                <h4 class="fw-bold text-uppercase">DANH MỤC</h4>
                <div class="accordion accordion-flush" id="categoryAccordion">
                    <!-- Accessories -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingAccessories">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAccessories" aria-expanded="false" aria-controls="collapseAccessories">
                                Accessories <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
                            </button>
                        </h2>
                        <div id="collapseAccessories" class="accordion-collapse collapse" aria-labelledby="headingAccessories" data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li class="list-item">
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubAccessories1" aria-expanded="false" aria-controls="collapseSubAccessories1">
                                            Phụ Kiện <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
                                        </button>
                                        <div id="collapseSubAccessories1" class="collapse">
                                            <ul class="list-unstyled mt-2">
                                                <li class="list-item"><a href="#" class="text-decoration-none">Mũ</a></li>
                                                <li class="list-item"><a href="#" class="text-decoration-none">Dép</a></li>
                                                <li class="list-item"><a href="#" class="text-decoration-none">Tất</a></li>
                                                <li class="list-item none"><a href="#" class="text-decoration-none">Kính</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="list-item none">
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubAccessories2" aria-expanded="false" aria-controls="collapseSubAccessories2">
                                            Balo <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
                                        </button>
                                        <div id="collapseSubAccessories2" class="collapse">
                                            <ul class="list-unstyled mt-2">
                                                <li class="list-item none"><a href="#" class="text-decoration-none">Herschel</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Shoes -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingShoes">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseShoes" aria-expanded="false" aria-controls="collapseShoes">
                                Giày <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
                            </button>
                        </h2>
                        <div id="collapseShoes" class="accordion-collapse collapse" aria-labelledby="headingShoes" data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li  class="list-item">
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubShoes1" aria-expanded="false" aria-controls="collapseSubShoes1">
                                            Giày Puma <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
                                        </button>
                                        <div id="collapseSubShoes1" class="collapse">
                                            <ul class="list-unstyled mt-2">
                                                <li class="list-item"><a href="#" class="text-decoration-none">Puma Mule</a></li>
                                                <li class="list-item none"><a href="#" class="text-decoration-none">Puma RS</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="list-item none">
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubShoes2" aria-expanded="false" aria-controls="collapseSubShoes2">
                                            Giày Nike <i class="fa-solid fa-plus"></i><i class="fa-solid fa-minus"></i>
                                        </button>
                                        <div id="collapseSubShoes2" class="collapse">
                                            <ul class="list-unstyled mt-2">
                                                <li class="list-item"><a href="#" class="text-decoration-none">Air Max</a></li>
                                                <li class="list-item none"><a href="#" class="text-decoration-none">Air Zoom</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Clothes -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button">
                                Quần áo
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
                
        <!-- Kích thước -->
            <div class="mb-4">
                <h4 class="fw-bold text-uppercase">KÍCH THƯỚC</h4>
                <div class="form-checkbox">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="size44">
                        <label class="form-check-label" for="size44">44</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="size43">
                        <label class="form-check-label" for="size43">43</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="size42">
                        <label class="form-check-label" for="size42">42</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="size41">
                        <label class="form-check-label" for="size41">41</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="size40">
                        <label class="form-check-label" for="size40">40</label>
                    </div>

                </div>
            </div>
            <!-- Lọc -->
            <div class="mb-4">
            <h4 class="fw-bold text-uppercase">LỌC</h4>
            <div class="price-slider">
                    <!-- Giá trị min/max -->
                <div class="d-flex justify-content-between">
                    <span id="minPrice">Từ: 0đ</span>
                    <span id="maxPrice">đến: 10,000,000đ</span>
                </div>
                <!-- Thanh kéo -->
                    <div class="range-input">
                    <!-- <input type="range" class="range-min" min="0" max="10000000"  id="priceRange" value="25000"> -->
                     <input type="range" class="form-range" min="0" max="10000000"  id="priceRange">
                    </div>
                <!-- step="100000" -->
            </div>
            </div>
            </div>  
    
     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>