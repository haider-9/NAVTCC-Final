@extends('layouts.portal')

@section('title', 'Home | All-in-One Business Portal')

@section('content')
    <section class="workspace-header">
        <div>
            <p class="eyebrow">Control center</p>
            <h1>Operations desk</h1>
            <p>A working view for people records, catalog assets, announcements, and incoming requests.</p>
        </div>
        <div class="header-actions">
            <a class="btn btn-portal" href="{{ route('employees.index') }}">Directory</a>
            <a class="btn btn-soft" href="{{ route('products.index') }}">Catalog</a>
        </div>
    </section>

    <section class="metric-grid">
        <div class="metric-tile">
            <span>Employees</span>
            <strong>{{ $employeeCount }}</strong>
            <p>Stored directory records</p>
        </div>
        <div class="metric-tile">
            <span>Products</span>
            <strong>{{ $productCount }}</strong>
            <p>Database-backed items</p>
        </div>
        <div class="metric-tile">
            <span>Departments</span>
            <strong>{{ $departmentCount }}</strong>
            <p>Teams represented</p>
        </div>
        <div class="metric-tile accent">
            <span>Updates</span>
            <strong>{{ $newsCount }}</strong>
            <p>Published notices</p>
        </div>
    </section>

    <section class="dashboard-grid">
        <div class="panel panel-wide">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Shortcuts</p>
                    <h2>Open a work area</h2>
                </div>
            </div>
            <div class="module-list">
                <a href="{{ route('employees.index') }}">
                    <span>HR</span>
                    <div>
                        <strong>Employee directory</strong>
                        <small>People, roles, status, and team records</small>
                    </div>
                </a>
                <a href="{{ route('products.index') }}">
                    <span>PR</span>
                    <div>
                        <strong>Product catalog</strong>
                        <small>Inventory cards with quick product details</small>
                    </div>
                </a>
                <a href="{{ route('gallery.index') }}">
                    <span>MD</span>
                    <div>
                        <strong>Media gallery</strong>
                        <small>Company image assets and media previews</small>
                    </div>
                </a>
                <a href="{{ route('news.index') }}">
                    <span>NW</span>
                    <div>
                        <strong>Company updates</strong>
                        <small>Announcements for staff and public visitors</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="panel">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Latest</p>
                    <h2>Notice stream</h2>
                </div>
            </div>
            <div class="compact-list">
                @forelse ($latestNews as $item)
                    <div class="compact-row">
                        <div>
                            <strong>{{ $item->title }}</strong>
                            <small>{{ $item->category }} &middot; {{ optional($item->published_at)->format('M j, Y') }}</small>
                        </div>
                        <span>Read</span>
                    </div>
                @empty
                    <div class="empty-panel">No published notices yet.</div>
                @endforelse
            </div>
        </div>
    </section>

    <section class="panel catalog-strip">
        <div class="panel-header">
            <div>
                <p class="eyebrow">Featured inventory</p>
                <h2>Catalog snapshot</h2>
            </div>
            <a class="text-link" href="{{ route('products.index') }}">Open catalog</a>
        </div>
        <div class="compact-list">
            @forelse ($featuredProducts as $product)
                <div class="compact-row">
                    <div>
                        <strong>{{ $product->name }}</strong>
                        <small>{{ $product->category }} &middot; {{ $product->sku }}</small>
                    </div>
                    <span>${{ $product->price }}</span>
                </div>
            @empty
                <div class="empty-panel">No featured products yet.</div>
            @endforelse
        </div>
    </section>
@endsection
