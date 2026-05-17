@extends('layouts.portal')

@section('title', 'Products | All-in-One Business Portal')

@section('content')
    <section class="workspace-header">
        <div>
            <p class="eyebrow">Products</p>
            <h1>Catalog room</h1>
            <p>Browse company products and open details without leaving the page.</p>
        </div>
        <div class="header-actions">
            <button id="showProductForm" class="btn btn-portal">Add Product</button>
        </div>
    </section>

    <div class="modal fade" id="productCreateModal" tabindex="-1" aria-labelledby="productCreateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="productCreateModalLabel">Create Product</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert d-none" id="productFormAlert" role="alert"></div>
                    <form id="productCreateForm" data-endpoint="{{ route('api.products.store') }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="productName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="productName" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="productSku" class="form-label">SKU</label>
                                <input type="text" class="form-control" id="productSku" name="sku" required>
                            </div>
                            <div class="col-md-6">
                                <label for="productPrice" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control" id="productPrice" name="price" required>
                            </div>
                            <div class="col-md-6">
                                <label for="productCategory" class="form-label">Category</label>
                                <input type="text" class="form-control" id="productCategory" name="category">
                            </div>
                            <div class="col-12">
                                <label for="productDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="productDescription" name="description" rows="3"></textarea>
                            </div>
                            <div class="col-md-8">
                                <label for="productImageUrl" class="form-label">Image URL</label>
                                <input type="url" class="form-control" id="productImageUrl" name="image_url">
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="productFeatured" name="is_featured">
                                    <label class="form-check-label" for="productFeatured">Featured</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-portal">Create product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="panel">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Inventory</p>
                <h2>Available items</h2>
            </div>
        </div>
        <div class="product-grid" id="productGrid">
            <div class="empty-panel">Loading catalog items...</div>
        </div>
    </section>

    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title fs-5" id="productModalTitle">Product Details</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="productModalBody"></div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/products.js') }}"></script>
@endpush
