const priceRange = document.getElementById('priceRange');
const priceMin = document.getElementById('minPrice');


 // Định dạng số với dấu phẩy (sử dụng toLocaleString)
 function formatPrice(value) {
    return Number(value).toLocaleString('en-US');
} 

priceMin.innerHTML = `Từ: ${formatPrice(priceRange.value)}đ`;

// Cập nhật giá trị khi kéo
priceRange.addEventListener('input', function () {
    minPrice.innerHTML = `Từ: ${formatPrice(this.value)}đ`;

    // Cập nhật màu nền
    let percentage = ((this.value - this.min) / (this.max - this.min)) * 100;
    let color = `linear-gradient(90deg, rgb(63, 60, 60) ${percentage}%, rgba(255,255,255) ${percentage}%)`;
    this.style.background = color;
})