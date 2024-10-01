document.addEventListener('DOMContentLoaded', function () {
    const productsContainer = document.getElementById('products-container');

    // Cargar carrito desde localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    function addToCart(event) {
        const productId = parseInt(event.target.dataset.id); // Obtiene el ID del producto desde data-id
        const productElement = event.target.closest('.product-card');
        const productName = productElement.querySelector('.card-title').textContent;
        const productPrice = parseFloat(productElement.querySelector('.card-text').textContent.replace('$', ''));

        const product = cart.find(p => p.id === productId);

        if (product) {
            product.quantity++;
        } else {
            const productDetails = {
                id: productId,
                name: productName,
                price: productPrice,
                quantity: 1
            };
            cart.push(productDetails);
        }

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        updateCartUI();
    }

    function updateCartCount() {
        const cartCount = document.getElementById('cart-count');
        const totalCount = cart.reduce((total, product) => total + product.quantity, 0);
        cartCount.textContent = totalCount;
    }

    function updateCartUI() {
        const cartContainer = document.getElementById('cart-container');
        if (cartContainer) {
            cartContainer.innerHTML = ''; // Limpiar el carrito

            cart.forEach(product => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item', 'mb-3');
                cartItem.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>${product.name}</h5>
                            <p>Precio: $${product.price.toFixed(2)}</p>
                            <p>Cantidad: ${product.quantity}</p>
                        </div>
                        <button class="btn btn-danger btn-remove-from-cart" data-id="${product.id}">Eliminar</button>
                    </div>
                `;
                cartContainer.appendChild(cartItem);
            });

            // Añadir eventos a los botones "Eliminar"
            const removeFromCartButtons = document.querySelectorAll('.btn-remove-from-cart');
            removeFromCartButtons.forEach(button => {
                button.addEventListener('click', removeFromCart);
            });
        }
    }

    function removeFromCart(event) {
        const productId = parseInt(event.target.dataset.id);
        cart = cart.filter(p => p.id !== productId);

        localStorage.setItem('cart', JSON.stringify(cart));
        updateCartCount();
        updateCartUI();
    }

    // Añadir eventos a los botones "Añadir al Carrito"
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', addToCart);
    });

    updateCartCount();
    updateCartUI();
});
