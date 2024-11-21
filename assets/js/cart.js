document.addEventListener("DOMContentLoaded", () => {
    const cartIcon = document.getElementById("cart-icon");
    const cartDetails = document.getElementById("cart-details");
    const cartContent = document.getElementById("cart-content");

    cartIcon.addEventListener("click", () => {
        cartDetails.classList.toggle("d-none");

        // Gọi API để lấy dữ liệu giỏ hàng
        fetch('../../model/cart.php')
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
                    const cartItems = data.map(item => `
                        <li>
                            <span>${item.product_name}</span>
                            <span>${item.quantity} x ${item.price} VND</span>
                        </li>
                    `).join('');
                    cartContent.innerHTML = `<ul>${cartItems}</ul>`;
                } else {
                    cartContent.innerHTML = `<p class="text-center text-muted">Giỏ hàng trống.</p>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                cartContent.innerHTML = `<p class="text-danger text-center">Đã xảy ra lỗi khi tải giỏ hàng.</p>`;
            });
    });
});

