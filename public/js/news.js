$(function () {
    const newsModal = new bootstrap.Modal(document.getElementById('newsCreateModal'));
    const form = $('#newsForm');
    const alertBox = $('#newsFormAlert');
    const newsList = $('.news-list');

    function showMessage(type, message) {
        alertBox
            .removeClass('d-none alert-danger alert-success')
            .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
            .text(message);
    }

    form.on('submit', function (event) {
        event.preventDefault();

        const data = {
            title: $('#newsTitle').val().trim(),
            slug: $('#newsSlug').val().trim(),
            category: $('#newsCategory').val().trim(),
            summary: $('#newsSummary').val().trim(),
            published_at: $('#newsPublishedAt').val().trim(),
            is_published: $('#newsPublished').is(':checked') ? 1 : 0,
        };

        if (!data.title || !data.slug) {
            showMessage('error', 'Title and slug are required.');
            return;
        }

        $.ajax({
            url: form.data('endpoint'),
            method: 'POST',
            data: data,
        })
            .done(function (response) {
                showMessage('success', response.message ?? 'News item created successfully.');
                newsList.append(`
                    <article class="news-item">
                        <div>
                            <span class="category-chip">${escapeHtml(data.category)}</span>
                            <h2>${escapeHtml(data.title)}</h2>
                            <p>${escapeHtml(data.summary)}</p>
                        </div>
                        <time datetime="${escapeHtml(data.published_at)}">${escapeHtml(data.published_at)}</time>
                    </article>
                `);
                form[0].reset();
                newsModal.hide();
            })
            .fail(function (xhr) {
                const errors = xhr.responseJSON?.errors;
                const firstError = errors ? Object.values(errors).flat()[0] : null;
                showMessage('error', firstError ?? 'Could not create news item.');
            });
    });

    $('#showNewsForm').on('click', function () {
        alertBox.addClass('d-none');
        form[0].reset();
        newsModal.show();
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