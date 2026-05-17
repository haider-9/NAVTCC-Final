$(function () {
    const galleryModal = new bootstrap.Modal(document.getElementById('galleryCreateModal'));
    const form = $('#galleryForm');
    const alertBox = $('#galleryFormAlert');
    const galleryGrid = $('.media-grid');

    function showMessage(type, message) {
        alertBox
            .removeClass('d-none alert-danger alert-success')
            .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
            .text(message);
    }

    form.on('submit', function (event) {
        event.preventDefault();

        const data = {
            title: $('#galleryTitle').val().trim(),
            caption: $('#galleryCaption').val().trim(),
            collection: $('#galleryCollection').val().trim(),
            image_url: $('#galleryImageUrl').val().trim(),
            sort_order: $('#gallerySortOrder').val().trim(),
            is_published: $('#galleryPublished').is(':checked') ? 1 : 0,
        };

        if (!data.title || !data.image_url) {
            showMessage('error', 'Title and image URL are required.');
            return;
        }

        $.ajax({
            url: form.data('endpoint'),
            method: 'POST',
            data: data,
        })
            .done(function (response) {
                showMessage('success', response.message ?? 'Gallery item created successfully.');
                galleryGrid.append(`
                    <article class="media-card">
                        <img src="${escapeHtml(data.image_url)}" alt="${escapeHtml(data.title)}">
                        <div class="media-card-body">
                            <span class="category-chip">${escapeHtml(data.collection || 'Media')}</span>
                            <h2>${escapeHtml(data.title)}</h2>
                            <p>${escapeHtml(data.caption)}</p>
                        </div>
                    </article>
                `);
                form[0].reset();
                galleryModal.hide();
            })
            .fail(function (xhr) {
                const errors = xhr.responseJSON?.errors;
                const firstError = errors ? Object.values(errors).flat()[0] : null;
                showMessage('error', firstError ?? 'Could not create gallery item.');
            });
    });

    $('#showGalleryForm').on('click', function () {
        alertBox.addClass('d-none');
        form[0].reset();
        galleryModal.show();
    });

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>'"]/g, function (tag) {
            const chars = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            };
            return chars[tag] || tag;
        });
    }
});