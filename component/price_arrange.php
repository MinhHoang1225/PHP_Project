<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/price_arrange.css">
</head>
<body>
<div class="muc_gia">
    <div class="muc1">
        <div class="home"><a href="#trangchu">Trang chủ</a></div>
        <div class="acc"><b>/ Accessores</b></div>
    </div>
    <div class="gia">
        <div class="kq">Showing 1-19 of 19 result</div>
        <form method="" action="">
            <select name="sort_price" id="price" onchange="this.form.submit()">
                <option value="">Thứ tự mặc định</option>
                <option value="asc">Thứ tự theo giá: thấp đến cao</option>
                <option value="desc">Thứ tự theo giá: cao xuống thấp</option>
            </select>
        </form>
    </div>
</div>

</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const priceDropdown = document.getElementById('price');
    const productContainer = document.querySelector('.show-product');

    // Biến lưu trữ thông tin sắp xếp
    let sortPrice = '';

    // Lắng nghe sự kiện thay đổi của dropdown
    priceDropdown.addEventListener('change', function (event) {
        event.preventDefault(); // Ngăn chặn hành vi mặc định (submit form)
        sortPrice = this.value; // Lấy giá trị sắp xếp được chọn
        updateProductList(); // Cập nhật danh sách sản phẩm
    });

    function updateProductList() {
        // Lấy các kích thước đã chọn
        const selectedSizes = Array.from(document.querySelectorAll('.form-check-input:checked'))
            .map(cb => encodeURIComponent(cb.value));

        // Giá trị lọc theo giá tối thiểu
        const minPriceValue = document.getElementById('priceRange')?.value || 0;

        // Xây dựng URL với các tham số lọc và sắp xếp
        let url = 'show_product.php?';

        if (minPriceValue) {
            url += `min_price=${minPriceValue}&`;
        }

        if (selectedSizes.length > 0) {
            url += `size=${selectedSizes.join(',')}&`;
        }

        if (sortPrice) {
            url += `sort_price=${sortPrice}&`;
        }

        // Gửi yêu cầu AJAX
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(html => {
                if (productContainer) {
                    productContainer.innerHTML = html; // Cập nhật sản phẩm vào container
                } else {
                    console.error('Không tìm thấy container để hiển thị sản phẩm.');
                }
            })
            .catch(error => {
                console.error('Lỗi khi tải sản phẩm:', error);
                alert('Có lỗi xảy ra khi tải sản phẩm. Vui lòng thử lại.');
            });
    }
});


</script>
</html>