@extends('layouts.portal')

@section('title', 'Contact | All-in-One Business Portal')

@section('content')
    <section class="workspace-header">
        <div>
            <p class="eyebrow">Support</p>
            <h1>Contact desk</h1>
            <p>Send a request to the backend intake queue and route it by department.</p>
        </div>
    </section>

    <section class="contact-grid">
        <form class="panel portal-form" id="contactForm" data-endpoint="{{ route('api.contact-inquiries.store') }}" novalidate>
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Form</p>
                    <h2>Request intake</h2>
                </div>
            </div>
            <div class="mb-3">
                <label for="fullName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Enter your name" autocomplete="name">
            </div>
            <div class="mb-3">
                <label for="emailAddress" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="emailAddress" name="email" placeholder="name@example.com" autocomplete="email">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <select class="form-select" id="department" name="department">
                    <option value="">Choose department</option>
                    <option>Human Resources</option>
                    <option>Engineering</option>
                    <option>Sales</option>
                    <option>Finance</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea class="form-control" id="message" name="message" rows="4" placeholder="How can we help?"></textarea>
            </div>
            <div class="alert d-none" id="formAlert" role="alert"></div>
            <button type="submit" class="btn btn-portal">Submit request</button>
        </form>

        <div class="panel media-panel">
            <div class="panel-header">
                <div>
                    <p class="eyebrow">Media</p>
                    <h2>Location preview</h2>
                </div>
            </div>
            <div class="ratio ratio-16x9 mb-3">
                <iframe src="https://www.openstreetmap.org/export/embed.html?bbox=67.0000%2C24.8300%2C67.0800%2C24.9100&layer=mapnik" title="Office location map"></iframe>
            </div>
            <video class="w-100 mb-3" controls>
                <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-videos/flower.mp4" type="video/mp4">
            </video>
            <audio class="w-100" controls>
                <source src="https://interactive-examples.mdn.mozilla.net/media/cc0-audio/t-rex-roar.mp3" type="audio/mpeg">
            </audio>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/contact.js') }}"></script>
@endpush
