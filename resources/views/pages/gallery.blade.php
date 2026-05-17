@extends('layouts.portal')

@section('title', 'Gallery | All-in-One Business Portal')

@section('content')
    <section class="workspace-header">
        <div>
            <p class="eyebrow">Media</p>
            <h1>Media shelf</h1>
            <p>Published workplace and product visuals pulled from the gallery records.</p>
        </div>
        <div class="header-actions">
            <button id="showGalleryForm" class="btn btn-portal">Add Media</button>
        </div>
    </section>

    <div class="modal fade" id="galleryCreateModal" tabindex="-1" aria-labelledby="galleryCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="galleryCreateModalLabel">Add Gallery Item</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert d-none" id="galleryFormAlert" role="alert"></div>
                    <form id="galleryForm" data-endpoint="{{ route('api.gallery.store') }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="galleryTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="galleryTitle" name="title" required>
                            </div>
                            <div class="col-md-6">
                                <label for="galleryCollection" class="form-label">Collection</label>
                                <input type="text" class="form-control" id="galleryCollection" name="collection">
                            </div>
                            <div class="col-12">
                                <label for="galleryCaption" class="form-label">Caption</label>
                                <textarea class="form-control" id="galleryCaption" name="caption" rows="3"></textarea>
                            </div>
                            <div class="col-md-8">
                                <label for="galleryImageUrl" class="form-label">Image URL</label>
                                <input type="url" class="form-control" id="galleryImageUrl" name="image_url" required>
                            </div>
                            <div class="col-md-4">
                                <label for="gallerySortOrder" class="form-label">Sort Order</label>
                                <input type="number" class="form-control" id="gallerySortOrder" name="sort_order">
                            </div>
                            <div class="col-12 form-check">
                                <input class="form-check-input" type="checkbox" id="galleryPublished" name="is_published" checked>
                                <label class="form-check-label" for="galleryPublished">Published</label>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-portal">Save media</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="media-grid">
        @forelse ($galleryItems as $item)
            <article class="media-card">
                <img src="{{ $item->image_url }}" alt="{{ $item->title }}">
                <div class="media-card-body">
                    <span class="category-chip">{{ $item->collection ?? 'Media' }}</span>
                    <h2>{{ $item->title }}</h2>
                    <p>{{ $item->caption }}</p>
                </div>
            </article>
        @empty
            <div class="empty-panel">No gallery records found.</div>
        @endforelse
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/gallery.js') }}"></script>
@endpush
