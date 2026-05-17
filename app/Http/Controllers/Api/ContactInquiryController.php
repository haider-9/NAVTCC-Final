<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactInquiryController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $inquiry = ContactInquiry::create($request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'department' => ['required', 'string', 'max:120'],
            'message' => ['required', 'string', 'min:8', 'max:3000'],
        ]) + ['status' => 'new']);

        return response()->json([
            'message' => 'Request received. The desk team will review it shortly.',
            'data' => $inquiry,
        ], 201);
    }
}
