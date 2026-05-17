<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $products = Product::query()
            ->when($request->filled('category'), fn ($query) => $query->where('category', $request->string('category')))
            ->when($request->boolean('featured'), fn ($query) => $query->where('is_featured', true))
            ->latest()
            ->get();

        return response()->json([
            'data' => $products,
            'meta' => [
                'count' => $products->count(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $product = Product::create($this->validatedProductData($request));

        return response()->json([
            'message' => 'Product created successfully.',
            'data' => $product,
        ], 201);
    }

    public function show(Product $product): JsonResponse
    {
        return response()->json([
            'data' => $product,
        ]);
    }

    public function update(Request $request, Product $product): JsonResponse
    {
        $product->update($this->validatedProductData($request, $product));

        return response()->json([
            'message' => 'Product updated successfully.',
            'data' => $product,
        ]);
    }

    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully.',
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validatedProductData(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => [
                'required',
                'string',
                'max:80',
                Rule::unique('products', 'sku')->ignore($product),
            ],
            'description' => ['nullable', 'string'],
            'category' => ['nullable', 'string', 'max:120'],
            'price' => ['required', 'numeric', 'min:0', 'max:99999999.99'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'is_featured' => ['sometimes', 'boolean'],
        ]);
    }
}
