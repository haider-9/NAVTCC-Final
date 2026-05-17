@extends('layouts.portal')

@section('title', 'News | All-in-One Business Portal')

@section('content')
    <section class="workspace-header">
        <div>
            <p class="eyebrow">News</p>
            <h1>Notice board</h1>
            <p>Published announcements stored in the portal backend.</p>
        </div>
        <div class="header-actions">
            <button id="showNewsForm" class="btn btn-portal">Add Notice</button>
        </div>
    </section>

    <div class="modal fade" id="newsCreateModal" tabindex="-1" aria-labelledby="newsCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="newsCreateModalLabel">Add News Item</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert d-none" id="newsFormAlert" role="alert"></div>
                    <form id="newsForm" data-endpoint="{{ route('api.news.store') }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="newsTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="newsTitle" name="title" required>
                            </div>
                            <div class="col-md-6">
                                <label for="newsSlug" class="form-label">Slug</label>
                                <input type="text" class="form-control" id="newsSlug" name="slug" required>
                            </div>
                            <div class="col-md-6">
                                <label for="newsCategory" class="form-label">Category</label>
                                <input type="text" class="form-control" id="newsCategory" name="category">
                            </div>
                            <div class="col-md-6">
                                <label for="newsPublishedAt" class="form-label">Published Date</label>
                                <input type="date" class="form-control" id="newsPublishedAt" name="published_at">
                            </div>
                            <div class="col-12">
                                <label for="newsSummary" class="form-label">Summary</label>
                                <textarea class="form-control" id="newsSummary" name="summary" rows="4"></textarea>
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="checkbox" id="newsPublished" name="is_published" checked>
                                <label class="form-check-label" for="newsPublished">Published</label>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-portal">Save notice</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="news-list">
        @forelse ($newsItems as $item)
            <article class="news-item">
                <div>
                    <span class="category-chip">{{ $item->category }}</span>
                    <h2>{{ $item->title }}</h2>
                    <p>{{ $item->summary }}</p>
                </div>
                <time datetime="{{ optional($item->published_at)->toDateString() }}">{{ optional($item->published_at)->format('M j, Y') }}</time>
            </article>
        @empty
            <div class="empty-panel">No published notices found.</div>
        @endforelse
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/news.js') }}"></script>
@endpush
