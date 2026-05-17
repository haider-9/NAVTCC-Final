@extends('layouts.portal')

@section('title', 'Employees | All-in-One Business Portal')

@section('content')
    <section class="workspace-header">
        <div>
            <p class="eyebrow">People</p>
            <h1>Team register</h1>
            <p>Live records for names, teams, roles, email addresses, and current availability.</p>
        </div>
        <div class="header-actions">
            <button id="showEmployeeForm" class="btn btn-portal">Add Employee</button>
            <a class="btn btn-soft" href="{{ route('contact.index') }}">Register</a>
        </div>
    </section>

    <div class="modal fade" id="employeeCreateModal" tabindex="-1" aria-labelledby="employeeCreateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="employeeCreateModalLabel">Add Employee</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert d-none" id="employeeFormAlert" role="alert"></div>
                    <form id="employeeForm" data-endpoint="{{ route('api.employees.store') }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="employeeCode" class="form-label">Employee Code</label>
                                <input type="text" class="form-control" id="employeeCode" name="employee_code" required>
                            </div>
                            <div class="col-md-6">
                                <label for="employeeName" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="employeeName" name="full_name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="employeeDepartment" class="form-label">Department</label>
                                <input type="text" class="form-control" id="employeeDepartment" name="department" required>
                            </div>
                            <div class="col-md-6">
                                <label for="employeeJobTitle" class="form-label">Job Title</label>
                                <input type="text" class="form-control" id="employeeJobTitle" name="job_title">
                            </div>
                            <div class="col-md-6">
                                <label for="employeeEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="employeeEmail" name="email">
                            </div>
                            <div class="col-md-6">
                                <label for="employeeStatus" class="form-label">Work Status</label>
                                <select class="form-select" id="employeeStatus" name="work_status">
                                    <option value="Active" selected>Active</option>
                                    <option value="On leave">On leave</option>
                                    <option value="Paused">Paused</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-portal">Save employee</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Records</p>
                <h2>Directory</h2>
            </div>
            <span class="table-count">{{ count($employees) }} records</span>
        </div>
        <div class="table-responsive portal-table-wrap" id="employee-table">
            <table class="table align-middle portal-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $employee->employee_code }}</td>
                            <td><strong>{{ $employee->full_name }}</strong></td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->job_title }}</td>
                            <td><a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a></td>
                            <td><span
                                    class="status-pill {{ $employee->work_status === 'Active' ? 'is-active' : 'is-paused' }}">{{ $employee->work_status }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">No employee records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/employees.js') }}"></script>
@endpush