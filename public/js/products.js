$(function () {
    const productGrid = $('#productGrid');
    const productModal = new bootstrap.Modal(document.getElementById('productModal'));
    const productCreateModal = new bootstrap.Modal(document.getElementById('productCreateModal'));
    const productCreateForm = $('#productCreateForm');
    const productCreateAlert = $('#productFormAlert');
    const productsById = new Map();

    function money(value) {
        return Number(value).toLocaleString('en-US', {
            style: 'currency',
            currency: 'USD',
        });
    }

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function (character) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            }[character];
        });
    }

    function productCard(product) {
        productsById.set(String(product.id), product);
        const category = product.category ?? 'General';
        const description = product.description ?? 'No product description available.';
        const initials = product.name
            .split(' ')
            .map((part) => part.charAt(0))
            .join('')
            .slice(0, 2)
            .toUpperCase();

        return `
            <article class="product-card">
                <div>
                    <div class="product-visual">
                        ${
                            product.image_url
                                ? `<img src="${escapeHtml(product.image_url)}" alt="${escapeHtml(product.name)}">`
                                : `<span>${escapeHtml(initials)}</span>`
                        }
                    </div>
                    <span class="category-chip">${escapeHtml(category)}</span>
                    <h3>${escapeHtml(product.name)}</h3>
                    <p>${escapeHtml(description)}</p>
                </div>
                <div class="product-card-footer">
                    <strong>${money(product.price)}</strong>
                    <button class="btn btn-sm btn-portal view-product" data-product-id="${product.id}">Details</button>
                </div>
            </article>
        `;
    }

    function showCreateMessage(type, message) {
        productCreateAlert
            .removeClass('d-none alert-danger alert-success')
            .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
            .text(message);
    }

    function loadProducts() {
        $.getJSON('/api/products')
            .done(function (response) {
                if (!response.data.length) {
                    productGrid.html('<div class="empty-panel">No products found.</div>');
                    return;
                }

                productGrid.html(response.data.map(productCard).join(''));
            })
            .fail(function () {
                productGrid.html('<div class="empty-panel">Could not load catalog items.</div>');
            });
    }

    $('#showProductForm').on('click', function () {
        productCreateAlert.addClass('d-none');
        productCreateForm[0].reset();
        productCreateModal.show();
    });

    productCreateForm.on('submit', function (event) {
        event.preventDefault();

        const payload = {
            name: $('#productName').val().trim(),
            sku: $('#productSku').val().trim(),
            description: $('#productDescription').val().trim(),
            category: $('#productCategory').val().trim(),
            price: $('#productPrice').val().trim(),
            image_url: $('#productImageUrl').val().trim(),
            is_featured: $('#productFeatured').is(':checked') ? 1 : 0,
        };

        if (!payload.name || !payload.sku || !payload.price) {
            showCreateMessage('error', 'Name, SKU, and price are required.');
            return;
        }

        $.ajax({
            url: productCreateForm.data('endpoint'),
            method: 'POST',
            data: payload,
        })
            .done(function (response) {
                showCreateMessage('success', response.message ?? 'Product created successfully.');
                productCreateModal.hide();
                loadProducts();
            })
            .fail(function (xhr) {
                const errors = xhr.responseJSON?.errors;
                const firstError = errors ? Object.values(errors).flat()[0] : null;
                showCreateMessage('error', firstError ?? 'Could not create product.');
            });
    });

    productGrid.on('click', '.view-product', function () {
        const product = productsById.get(String($(this).data('product-id')));

        if (!product) {
            return;
        }

        $('#productModalTitle').text(product.name);
        $('#productModalBody')
            .hide()
            .html(`
                <p class="mb-2"><strong>SKU:</strong> ${escapeHtml(product.sku)}</p>
                <p class="mb-2"><strong>Category:</strong> ${escapeHtml(product.category ?? 'General')}</p>
                <p class="mb-2"><strong>Price:</strong> ${money(product.price)}</p>
                <p class="mb-0">${escapeHtml(product.description ?? 'No product description available.')}</p>
            `)
            .slideDown(220);

        $('#productModal').fadeIn(120);
        productModal.show();
    });

    loadProducts();
});
