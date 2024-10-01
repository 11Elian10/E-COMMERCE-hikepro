document.addEventListener('DOMContentLoaded', function () {
    // Cargar carrito desde localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function renderCart() {
        const cartItems = document.getElementById('cart-items');
        cartItems.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price.toFixed(2)}</td>
                <td>
                    <button class="btn btn-secondary btn-sm btn-decrease" data-id="${item.id}">-</button>
                    ${item.quantity}
                    <button class="btn btn-secondary btn-sm btn-increase" data-id="${item.id}">+</button>
                </td>
                <td>$${(item.price * item.quantity).toFixed(2)}</td>
                <td><button class="btn btn-danger btn-sm btn-remove" data-id="${item.id}">Eliminar</button></td>
            `;
            cartItems.appendChild(row);

            total += item.price * item.quantity;
        });

        const checkoutButton = document.getElementById('checkout');
        checkoutButton.textContent = `Proceder al Pago ($${total.toFixed(2)})`;
    }

    function updateCartInLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
        updateCartCount();
    }

    function updateCartCount() {
        const cartCount = document.getElementById('cart-count');
        const totalCount = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalCount;
    }

    function increaseQuantity(productId) {
        const item = cart.find(p => p.id === productId);
        if (item) {
            item.quantity++;
            updateCartInLocalStorage();
        }
    }

    function decreaseQuantity(productId) {
        const item = cart.find(p => p.id === productId);
        if (item) {
            if (item.quantity > 1) {
                item.quantity--;
                updateCartInLocalStorage();
            }
        }
    }

    function removeFromCart(productId) {
        cart = cart.filter(item => item.id !== productId);
        updateCartInLocalStorage();
    }

    // Event delegation for dynamically added buttons
    document.getElementById('cart-items').addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-increase')) {
            increaseQuantity(parseInt(event.target.dataset.id));
        } else if (event.target.classList.contains('btn-decrease')) {
            decreaseQuantity(parseInt(event.target.dataset.id));
        } else if (event.target.classList.contains('btn-remove')) {
            removeFromCart(parseInt(event.target.dataset.id));
        }
    });

    // Initial render
    renderCart();
});
