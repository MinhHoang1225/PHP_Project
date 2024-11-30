<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/price_arrange.css">
    <style>
        /* Mục Giá */
.muc_gia {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Mục 1 (Trang chủ và Acc) */
.muc_gia .muc1 {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
}

.muc_gia .muc1 .home a {
    color: #007bff;
    text-decoration: none;
    font-size: 16px;
}

.muc_gia .muc1 .home a:hover {
    text-decoration: underline;
}

.muc_gia .muc1 .acc {
    font-size: 16px;
    color: #555;
    margin-left: 5px;
}

/* Kết quả tìm kiếm và chọn giá */
.muc_gia .gia {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.muc_gia .gia .kq {
    font-size: 16px;
    color: #333;
}

.muc_gia .gia form {
    display: flex;
    align-items: center;
}

.muc_gia .gia select {
    padding: 8px 12px;
    font-size: 14px;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: #fff;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

.muc_gia .gia select:focus {
    border-color: #007bff;
}

.muc_gia .gia select option {
    padding: 8px;
}

    </style>
</head>
<body>
<div class="muc_gia">
    <div class="muc1">
        <div class="home"><a href="../index.php" style="color:#0c6478">Trang chủ</a></div>
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

    let sortPrice = '';
    priceDropdown.addEventListener('change', function (event) {
        event.preventDefault(); 
        sortPrice = this.value; 
        updateProductList(); 
    });

    function updateProductList() {

        const selectedSizes = Array.from(document.querySelectorAll('.form-check-input:checked'))
            .map(cb => encodeURIComponent(cb.value));

        const minPriceValue = document.getElementById('priceRange')?.value || 0;

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
                    productContainer.innerHTML = html; 
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