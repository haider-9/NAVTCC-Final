$(function () {
    $('#contactForm').on('submit', function (event) {
        event.preventDefault();

        const form = $(this);
        const name = $('#fullName').val().trim();
        const email = $('#emailAddress').val().trim();
        const department = $('#department').val();
        const message = $('#message').val().trim();
        const alert = $('#formAlert');
        const submitButton = form.find('button[type="submit"]');

        if (!name || !email || !department || !message) {
            alert
                .removeClass('d-none alert-success')
                .addClass('alert-danger')
                .text('Please fill out every field before submitting.');
        } else if (!email.includes('@') || !email.includes('.')) {
            alert
                .removeClass('d-none alert-success')
                .addClass('alert-danger')
                .text('Please enter a valid email address.');
        } else {
            submitButton.prop('disabled', true).text('Sending...');

            $.ajax({
                url: form.data('endpoint'),
                method: 'POST',
                data: {
                    full_name: name,
                    email,
                    department,
                    message,
                },
            })
                .done(function (response) {
                    alert
                        .removeClass('d-none alert-danger')
                        .addClass('alert-success')
                        .text(response.message ?? 'Request received.');
                    form[0].reset();
                })
                .fail(function (xhr) {
                    const errors = xhr.responseJSON?.errors;
                    const firstError = errors ? Object.values(errors).flat()[0] : null;

                    alert
                        .removeClass('d-none alert-success')
                        .addClass('alert-danger')
                        .text(firstError ?? 'Could not submit this request. Please try again.');
                })
                .always(function () {
                    submitButton.prop('disabled', false).text('Submit request');
                });
        }
    });
});
