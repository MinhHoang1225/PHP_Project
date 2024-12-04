<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slidebar</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/slidebar.css">
</head>
<body>
    <div class="left-page">
        <div class="left-page__content">
            <!-- Danh Mục -->
            <div class="mb-4 filter_product_category">
                <h4 class="fw-bold text-uppercase">DANH MỤC</h4>
                <div class="accordion accordion-flush" id="categoryAccordion">
                    <!-- Accessories -->
                    <div class="accordion-item" data-category-id="1">
                        <h2 class="accordion-header" id="headingAccessories">
                            <button class="accordion-button collapsed category-item" type="button" data-category-id="1" data-bs-toggle="collapse" data-bs-target="#collapseAccessories" aria-expanded="false" aria-controls="collapseAccessories">
                                Sản phẩm
                            </button>
                        </h2>
                        <div id="collapseAccessories" class="accordion-collapse collapse" aria-labelledby="headingAccessories" data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled">
                                    <li>
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubAccessories1" aria-expanded="false" aria-controls="collapseSubAccessories1">
                                            Phụ Kiện
                                        </button>
                                        <div id="collapseSubAccessories1" class="collapse">
                                            <ul class="list-unstyled mt-2">
                                                <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Mũ ">Mũ</a></li>
                                                <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Dép">Dép</a></li>
                                                <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Tất">Tất</a></li>
                                                <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Kính">Kính</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubAccessories2" aria-expanded="false" aria-controls="collapseSubAccessories2">
                                            Balo
                                        </button>
                                        <div id="collapseSubAccessories2" class="collapse">
                                            <ul class="list-unstyled mt-2">
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="3">Herschel</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Shoes -->
                    <div class="accordion-item" data-category-id="2">
                        <h2 class="accordion-header" id="headingShoes">
                            <button class="accordion-button collapsed category-item" type="button" data-category-id="2" data-bs-toggle="collapse" data-bs-target="#collapseShoes" aria-expanded="false" aria-controls="collapseShoes">
                                Giày
                            </button>
                        </h2>
                        <div id="collapseShoes" class="accordion-collapse collapse" aria-labelledby="headingShoes" data-bs-parent="#categoryAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mt-2">
                                    <li>
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubShoes1" aria-expanded="false" aria-controls="collapseSubShoes1">
                                        <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Giày Puma">Giày Puma</a></li>
                                        </button>
                                        <div id="collapseSubShoes1" class="collapse">
                                            <!-- <ul class="list-unstyled mt-2">
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="2">Puma Mule</a></li>
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="2">Puma RS</a></li>
                                            </ul> -->
                                        </div>
                                    </li>
                                    <li>
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubShoes2" aria-expanded="false" aria-controls="collapseSubShoes2">
                                        <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Giày Nike">Giày Nike</a></li>
                                        </button>
                                        <div id="collapseSubShoes2" class="collapse">
                                            <!-- <ul class="list-unstyled mt-2">
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="2">Air Max</a></li>
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="2">Air Zoom</a></li>
                                            </ul> -->
                                        </div>
                                    </li>
                                    <li>
                                        <button class="text-decoration-none p-0 d-flex align-items-center accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapseSubShoes2" aria-expanded="false" aria-controls="collapseSubShoes2">
                                        <li><a href="#" class="text-decoration-none category-item"  data-search-keyword="Giày adidas">Giày adidas</a></li>
                                        </button>
                                        <div id="collapseSubShoes2" class="collapse">
                                            <!-- <ul class="list-unstyled mt-2">
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="2">Air Max</a></li>
                                                <li><a href="#" class="text-decoration-none category-item" data-category-id="2">Air Zoom</a></li>
                                            </ul> -->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Clothes -->
                    <div class="accordion-item" data-category-id="4">
                        <h2 class="accordion-header">
                            <button class="collapsed category-item" type="button" data-category-id="4">
                                <p class="clothes">Quần áo</p>
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
            <!-- Kích thước -->
            <div class="mb-4">
                <h4 class="fw-bold text-uppercase">KÍCH THƯỚC</h4>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="44" id="size44">
                    <label class="form-check-label" for="size44">44</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="43" id="size43">
                    <label class="form-check-label" for="size43">43</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="L" id="sizeL">
                    <label class="form-check-label" for="sizeL">L</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="M" id="sizeM">
                    <label class="form-check-label" for="sizeM">M</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="S" id="sizeS">
                    <label class="form-check-label" for="sizeS">S</label>
                </div>
            </div>
            <!-- Lọc giá -->
            <div class="mb-4">
                <h4 class="fw-bold text-uppercase">LỌC</h4>
                <div class="price-slider">
                    <div class="d-flex justify-content-between">
                        <span id="minPrice">Từ: 50,000đ</span>
                        <span id="maxPrice">Đến: 10,000,000đ</span>
                    </div>
                    <input type="range" class="form-range" id="priceRange" min="100000" max="10000000" value="100000">
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>src="../assets/js/slidebar.js"</script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const priceRange = document.getElementById('priceRange');
    const minPrice = document.getElementById('minPrice');
    const productContainer = document.querySelector('.show-product');
    const loadingIndicator = document.querySelector('.loading'); // Spinner hoặc loading text
    let currentCategoryId = null;
    let selectedSizes = [];

    // Hàm định dạng giá
    const formatPrice = (value) => Number(value).toLocaleString('vi-VN') + 'đ';

    // Cập nhật giá trị hiển thị của thanh trượt giá
    const updatePriceDisplay = () => {
        const priceValue = parseInt(priceRange.value);
        minPrice.textContent = `Từ: ${formatPrice(priceValue)}`;
        const percentage = ((priceRange.value - priceRange.min) / (priceRange.max - priceRange.min)) * 100;
        priceRange.style.background = `linear-gradient(90deg, rgb(63, 60, 60) ${percentage}%, rgba(255,255,255) ${percentage}%)`;
    };

    // Lấy danh sách kích thước đã chọn
    const getSelectedSizes = () => {
        return Array.from(document.querySelectorAll('.form-check-input:checked'))
            .map(checkbox => encodeURIComponent(checkbox.value));
    };

    // Tạo URL dựa trên các bộ lọc hiện tại
    const buildFilterURL = () => {
        const minPriceValue = priceRange.value || 0;
        selectedSizes = getSelectedSizes();
        let url = 'show_product.php?';

        if (minPriceValue) url += `min_price=${minPriceValue}&`;
        if (selectedSizes.length > 0) url += `size=${selectedSizes.join(',')}&`;
        if (currentCategoryId) {
            if (isNaN(currentCategoryId)) {
                url += `category_name=${encodeURIComponent(currentCategoryId)}&`;
            } else {
                url += `category_id=${encodeURIComponent(currentCategoryId)}&`;
            }
        }
        return url;
    };

    // Cập nhật danh sách sản phẩm
    const updateProductList = () => {
        const url = buildFilterURL();

        if (loadingIndicator) loadingIndicator.style.display = 'block'; // Hiển thị loading

        fetch(url)
            .then(response => {
                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                return response.text();
            })
            .then(html => {
                if (productContainer) productContainer.innerHTML = html;
            })
            .catch(error => console.error('Lỗi khi tải dữ liệu:', error))
            .finally(() => {
                if (loadingIndicator) loadingIndicator.style.display = 'none'; // Ẩn loading
            });
    };

    // Gán sự kiện cho thanh trượt giá
    priceRange.addEventListener('input', () => {
        updatePriceDisplay();
        updateProductList();
    });

    // Gán sự kiện cho các danh mục
    const categoryItems = document.querySelectorAll('.category-item');
    categoryItems.forEach(item => {
        item.addEventListener('click', (e) => {
            e.preventDefault();
            currentCategoryId = item.getAttribute('data-category-id') || item.getAttribute('data-search-keyword');
            updateProductList();
        });
    });

    // Gán sự kiện cho các checkbox kích thước
    const sizeCheckboxes = document.querySelectorAll('.form-check-input');
    sizeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateProductList);
    });

    // Cập nhật giá ban đầu
    updatePriceDisplay();
});
const size44Checkbox = document.getElementById("size44");
    const size43Checkbox = document.getElementById("size43");
    const sizeLCheckbox = document.getElementById("sizeL");
    const sizeMCheckbox = document.getElementById("sizeM");
    const sizeSCheckbox = document.getElementById("sizeS");

    size44Checkbox.parentElement.style.display = "none";
    size43Checkbox.parentElement.style.display = "none";

    const shoeCategories = document.querySelectorAll(
        '[data-search-keyword="Giày Puma"], [data-search-keyword="Giày Nike"], [data-search-keyword="Giày adidas"], [data-search-keyword="Dép"]'
    );

    const otherCategories = document.querySelectorAll(
        '.category-item:not([data-search-keyword="Giày Puma"]):not([data-search-keyword="Giày Nike"]):not([data-search-keyword="Giày adidas"]):not([data-search-keyword="Dép"])'
    );

    function showShoeSizes() {
        size44Checkbox.parentElement.style.display = "block";
        size43Checkbox.parentElement.style.display = "block";
        sizeLCheckbox.parentElement.style.display = "none";
        sizeMCheckbox.parentElement.style.display = "none";
        sizeSCheckbox.parentElement.style.display = "none";
    }

    function showAllSizesExceptShoes() {
        size44Checkbox.parentElement.style.display = "none";
        size43Checkbox.parentElement.style.display = "none";
        sizeLCheckbox.parentElement.style.display = "block";
        sizeMCheckbox.parentElement.style.display = "block";
        sizeSCheckbox.parentElement.style.display = "block";
    }

    shoeCategories.forEach(category => {
        category.addEventListener("click", showShoeSizes);
    });

    otherCategories.forEach(category => {
        category.addEventListener("click", showAllSizesExceptShoes);
    });

</script>


</body>
</html>
