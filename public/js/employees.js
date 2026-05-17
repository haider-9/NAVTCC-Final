$(function () {
    const employeeModal = new bootstrap.Modal(document.getElementById('employeeCreateModal'));
    const form = $('#employeeForm');
    const alertBox = $('#employeeFormAlert');
    const tableBody = $('#employee-table tbody');
    const countLabel = $('.table-count');

    function showMessage(type, message) {
        alertBox
            .removeClass('d-none alert-danger alert-success')
            .addClass(type === 'success' ? 'alert-success' : 'alert-danger')
            .text(message);
    }

    form.on('submit', function (event) {
        event.preventDefault();

        const data = {
            employee_code: $('#employeeCode').val().trim(),
            full_name: $('#employeeName').val().trim(),
            department: $('#employeeDepartment').val().trim(),
            job_title: $('#employeeJobTitle').val().trim(),
            email: $('#employeeEmail').val().trim(),
            work_status: $('#employeeStatus').val().trim(),
        };

        if (!data.employee_code || !data.full_name || !data.department) {
            showMessage('error', 'Employee code, name, and department are required.');
            return;
        }

        $.ajax({
            url: form.data('endpoint'),
            method: 'POST',
            data: data,
        })
            .done(function (response) {
                showMessage('success', response.message ?? 'Employee added successfully.');
                tableBody.append(`
                    <tr>
                        <td>${escapeHtml(data.employee_code)}</td>
                        <td><strong>${escapeHtml(data.full_name)}</strong></td>
                        <td>${escapeHtml(data.department)}</td>
                        <td>${escapeHtml(data.job_title)}</td>
                        <td><a href="mailto:${escapeHtml(data.email)}">${escapeHtml(data.email)}</a></td>
                        <td><span class="status-pill ${escapeHtml(data.work_status) === 'Active' ? 'is-active' : 'is-paused'}">${escapeHtml(data.work_status)}</span></td>
                    </tr>
                `);
                const currentCount = Number(countLabel.text().split(' ')[0] || 0);
                countLabel.text(`${currentCount + 1} records`);
                form[0].reset();
                employeeModal.hide();
            })
            .fail(function (xhr) {
                const errors = xhr.responseJSON?.errors;
                const firstError = errors ? Object.values(errors).flat()[0] : null;
                showMessage('error', firstError ?? 'Could not add employee.');
            });
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

    $('#showEmployeeForm').on('click', function () {
        alertBox.addClass('d-none');
        form[0].reset();
        employeeModal.show();
    });
});