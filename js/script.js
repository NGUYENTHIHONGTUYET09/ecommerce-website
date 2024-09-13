document.addEventListener('DOMContentLoaded', function() {

    // Hàm để thêm sản phẩm vào giỏ hàng
    function addToCart(productId) {
        const product = {
            id: productId,
            name: 'Sample Product',
            price: 19.99
        };

        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));

        alert('Sản phẩm đã được thêm vào giỏ hàng!');
    }

    // Xử lý sự kiện nhấp chuột vào nút "Thêm vào Giỏ"
    const addToCartButtons = document.querySelectorAll('.add-to-cart-button');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            addToCart(productId);
        });
    });
});
