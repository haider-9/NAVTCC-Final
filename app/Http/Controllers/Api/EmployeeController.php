<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(): JsonResponse
    {
        $employees = Employee::query()
            ->orderBy('department')
            ->orderBy('full_name')
            ->get();

        return response()->json([
            'data' => $employees,
            'meta' => [
                'count' => $employees->count(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $employee = Employee::create($this->validatedEmployeeData($request));

        return response()->json([
            'message' => 'Employee created successfully.',
            'data' => $employee,
        ], 201);
    }

    public function show(Employee $employee): JsonResponse
    {
        return response()->json(['data' => $employee]);
    }

    public function update(Request $request, Employee $employee): JsonResponse
    {
        $employee->update($this->validatedEmployeeData($request, $employee));

        return response()->json([
            'message' => 'Employee updated successfully.',
            'data' => $employee,
        ]);
    }

    public function destroy(Employee $employee): JsonResponse
    {
        $employee->delete();

        return response()->json([
            'message' => 'Employee deleted successfully.',
        ]);
    }

    private function validatedEmployeeData(Request $request, ?Employee $employee = null): array
    {
        return $request->validate([
            'employee_code' => ['required', 'string', 'max:80'],
            'full_name' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:120'],
            'job_title' => ['nullable', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:255'],
            'work_status' => ['nullable', 'string', 'max:80'],
        ]);
    }
}
