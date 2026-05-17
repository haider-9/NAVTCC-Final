<?php

namespace Tests\Feature;

use App\Models\ContactInquiry;
use App\Models\Employee;
use App\Models\GalleryItem;
use App\Models\NewsItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PortalApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_employees_as_json(): void
    {
        Employee::create([
            'employee_code' => 'EMP-201',
            'full_name' => 'Nida Malik',
            'department' => 'Operations',
            'job_title' => 'Workflow Coordinator',
            'email' => 'nida.malik@example.test',
            'work_status' => 'Active',
        ]);

        $response = $this->getJson('/api/employees');

        $response
            ->assertOk()
            ->assertJsonPath('meta.count', 1)
            ->assertJsonPath('data.0.full_name', 'Nida Malik');
    }

    public function test_it_lists_published_news_items(): void
    {
        NewsItem::create([
            'title' => 'Portal backend connected',
            'slug' => 'portal-backend-connected',
            'category' => 'Technology',
            'summary' => 'The notice board is now backed by database records.',
            'published_at' => now(),
            'is_published' => true,
        ]);

        NewsItem::create([
            'title' => 'Draft note',
            'slug' => 'draft-note',
            'category' => 'Internal',
            'summary' => 'This should not be public.',
            'published_at' => now(),
            'is_published' => false,
        ]);

        $response = $this->getJson('/api/news');

        $response
            ->assertOk()
            ->assertJsonPath('meta.count', 1)
            ->assertJsonPath('data.0.title', 'Portal backend connected');
    }

    public function test_it_lists_published_gallery_items(): void
    {
        GalleryItem::create([
            'title' => 'Support Desk',
            'caption' => 'Requests routed by department.',
            'collection' => 'Support',
            'image_url' => 'https://example.test/support-desk.jpg',
            'is_published' => true,
        ]);

        $response = $this->getJson('/api/gallery');

        $response
            ->assertOk()
            ->assertJsonPath('meta.count', 1)
            ->assertJsonPath('data.0.title', 'Support Desk');
    }

    public function test_it_stores_contact_inquiries(): void
    {
        $response = $this->postJson('/api/contact-inquiries', [
            'full_name' => 'Raza Shah',
            'email' => 'raza.shah@example.test',
            'department' => 'Finance',
            'message' => 'Please route this invoice question to the finance desk.',
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('data.status', 'new');

        $this->assertDatabaseHas(ContactInquiry::class, [
            'email' => 'raza.shah@example.test',
            'department' => 'Finance',
            'status' => 'new',
        ]);
    }
}
