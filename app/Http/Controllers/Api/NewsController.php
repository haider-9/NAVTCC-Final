<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\NewsItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(): JsonResponse
    {
        $newsItems = NewsItem::query()
            ->where('is_published', true)
            ->latest('published_at')
            ->get();

        return response()->json([
            'data' => $newsItems,
            'meta' => [
                'count' => $newsItems->count(),
            ],
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $newsItem = NewsItem::create($this->validatedNewsData($request));

        return response()->json([
            'message' => 'News item created successfully.',
            'data' => $newsItem,
        ], 201);
    }

    public function show(NewsItem $news): JsonResponse
    {
        return response()->json(['data' => $news]);
    }

    public function update(Request $request, NewsItem $news): JsonResponse
    {
        $news->update($this->validatedNewsData($request, $news));

        return response()->json([
            'message' => 'News item updated successfully.',
            'data' => $news,
        ]);
    }

    public function destroy(NewsItem $news): JsonResponse
    {
        $news->delete();

        return response()->json([
            'message' => 'News item deleted successfully.',
        ]);
    }

    private function validatedNewsData(Request $request, ?NewsItem $news = null): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:120'],
            'summary' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['sometimes', 'boolean'],
        ]);
    }
}
