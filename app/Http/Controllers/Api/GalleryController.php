<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(): JsonResponse
    {
        $galleryItems = GalleryItem::query()
            ->where('is_published', true)
            ->orderBy('sort_order')
            ->orderBy('title')
            ->get();

        return response()->json([
            'data' => $galleryItems,
            'meta' => [
                'count' => $galleryItems->count(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $item = GalleryItem::create($this->validatedGalleryData($request));

        return response()->json([
            'message' => 'Gallery item created successfully.',
            'data' => $item,
        ], 201);
    }

    public function show(GalleryItem $gallery): JsonResponse
    {
        return response()->json(['data' => $gallery]);
    }

    public function update(Request $request, GalleryItem $gallery): JsonResponse
    {
        $gallery->update($this->validatedGalleryData($request, $gallery));

        return response()->json([
            'message' => 'Gallery item updated successfully.',
            'data' => $gallery,
        ]);
    }

    public function destroy(GalleryItem $gallery): JsonResponse
    {
        $gallery->delete();

        return response()->json([
            'message' => 'Gallery item deleted successfully.',
        ]);
    }

    private function validatedGalleryData(Request $request, ?GalleryItem $gallery = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'caption' => ['nullable', 'string'],
            'collection' => ['nullable', 'string', 'max:120'],
            'image_url' => ['nullable', 'url', 'max:2048'],
            'sort_order' => ['nullable', 'integer'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
    }
}
