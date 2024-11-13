document.addEventListener('DOMContentLoaded', () => {
    loadProducts();
    updateCartCount();

    // Carga de productos directamente en el código
    function loadProducts() {
        const products = [
            { id: 1, name: 'Mochila para Senderismo', price: 50, image: 'img/mochila.jpg' },
            { id: 2, name: 'Bicicleta de Montaña', price: 300, image: 'img/bicicleta.jpg' },
            { id: 3, name: 'Tienda de Campaña', price: 120, image: 'img/tienda.jpg' },
            { id: 4, name: 'Linterna LED Recargable', price: 25, image: 'img/linterna.jpg' },
            { id: 5, name: 'Botas de Montaña', price: 80, image: 'img/botas.jpg' },
            { id: 6, name: 'Cuerda de Escalada', price: 60, image: 'img/cuerda.jpg' },
            { id: 7, name: 'Botella de Agua de Acero Inoxidable', price: 15, image: 'img/botella.jpg' },
            { id: 8, name: 'Chaqueta Impermeable', price: 100, image: 'img/chaqueta.jpg' },
            { id: 9, name: 'Mapa Topográfico', price: 10, image: 'img/mapa.jpg' },
            { id: 10, name: 'GPS de Mano', price: 200, image: 'img/gps.jpg' }
        ];

        const productsContainer = document.querySelector('#products .row');
        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.classList.add('col-md-4', 'product-card');
            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <h5>${product.name}</h5>
                <p>$${product.price}</p>
                <button class="btn-add-to-cart" data-id="${product.id}">Añadir al Carrito</button>
            `;
            productsContainer.appendChild(productCard);
        });

        // Añadir eventos para los botones de agregar al carrito
        const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', addToCart);
        });
    }

    // Carrito de compras
    let cart = [];

    function addToCart(event) {
        const productId = parseInt(event.target.dataset.id);
        const product = cart.find(p => p.id === productId);

        if (product) {
            product.quantity++;
        } else {
            const productDetails = {
                id: productId,
                name: event.target.parentElement.querySelector('h5').textContent,
                price: parseFloat(event.target.parentElement.querySelector('p').textContent.replace('$', '')),
                quantity: 1
            };
            cart.push(productDetails);
        }

        renderCart();
        updateCartCount();
    }

    function renderCart() {
        const cartItems = document.getElementById('cart-items');
        cartItems.innerHTML = '';
        let total = 0;

        cart.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>$${item.price}</td>
                <td>${item.quantity}</td>
                <td>$${(item.price * item.quantity).toFixed(2)}</td>
            `;
            cartItems.appendChild(row);

            total += item.price * item.quantity;
        });

        const checkoutButton = document.getElementById('checkout');
        checkoutButton.textContent = `Proceder al Pago ($${total.toFixed(2)})`;
    }

    function updateCartCount() {
        const cartCount = document.getElementById('cart-count');
        const totalCount = cart.reduce((total, product) => total + product.quantity, 0);
        cartCount.textContent = totalCount;
    }
});
