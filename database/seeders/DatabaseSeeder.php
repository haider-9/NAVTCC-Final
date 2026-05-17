<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\GalleryItem;
use App\Models\NewsItem;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::query()->updateOrCreate(
            ['sku' => 'BP-LAPTOP-001'],
            [
                'name' => 'Business Pro Laptop',
                'description' => 'Lightweight workstation issued to managers, analysts, and hybrid team leads.',
                'category' => 'Hardware',
                'price' => 1299.00,
                'image_url' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
            ],
        );

        Product::query()->updateOrCreate(
            ['sku' => 'MEET-HUB-002'],
            [
                'name' => 'Meeting Hub Camera',
                'description' => 'Wide-angle conference camera assigned to hybrid meeting rooms.',
                'category' => 'Media',
                'price' => 249.99,
                'image_url' => 'https://images.unsplash.com/photo-1587825140708-dfaf72ae4b04?auto=format&fit=crop&w=900&q=80',
                'is_featured' => true,
            ],
        );

        Product::query()->updateOrCreate(
            ['sku' => 'SEC-BADGE-003'],
            [
                'name' => 'Smart Access Badge',
                'description' => 'Secure access badge used for attendance and building entry.',
                'category' => 'Security',
                'price' => 19.50,
                'image_url' => 'https://images.unsplash.com/photo-1578574577315-3fbeb0cecdc2?auto=format&fit=crop&w=900&q=80',
                'is_featured' => false,
            ],
        );

        foreach ([
            ['employee_code' => 'EMP-101', 'full_name' => 'Ayesha Khan', 'department' => 'Human Resources', 'job_title' => 'People Operations Lead', 'email' => 'ayesha.khan@a1portal.local', 'work_status' => 'Active'],
            ['employee_code' => 'EMP-102', 'full_name' => 'Hamza Ali', 'department' => 'Engineering', 'job_title' => 'Backend Developer', 'email' => 'hamza.ali@a1portal.local', 'work_status' => 'Active'],
            ['employee_code' => 'EMP-103', 'full_name' => 'Sara Ahmed', 'department' => 'Sales', 'job_title' => 'Account Manager', 'email' => 'sara.ahmed@a1portal.local', 'work_status' => 'On Leave'],
            ['employee_code' => 'EMP-104', 'full_name' => 'Bilal Raza', 'department' => 'Finance', 'job_title' => 'Payroll Analyst', 'email' => 'bilal.raza@a1portal.local', 'work_status' => 'Active'],
            ['employee_code' => 'EMP-105', 'full_name' => 'Mina Farooq', 'department' => 'Support', 'job_title' => 'Customer Desk Coordinator', 'email' => 'mina.farooq@a1portal.local', 'work_status' => 'Active'],
        ] as $employee) {
            Employee::query()->updateOrCreate(
                ['employee_code' => $employee['employee_code']],
                $employee,
            );
        }

        foreach ([
            ['title' => 'Operations portal moved into daily use', 'slug' => 'operations-portal-daily-use', 'category' => 'Operations', 'summary' => 'The shared portal now keeps directory records, product references, media files, and customer requests in one workflow.', 'published_at' => now()->subDay()],
            ['title' => 'Catalog API is ready for internal apps', 'slug' => 'catalog-api-ready-internal-apps', 'category' => 'Technology', 'summary' => 'Teams can now consume product information through JSON endpoints instead of maintaining separate spreadsheets.', 'published_at' => now()->subDays(2)],
            ['title' => 'Onboarding desk adds support intake tracking', 'slug' => 'onboarding-desk-support-intake', 'category' => 'People', 'summary' => 'Contact requests submitted from the portal are now stored for follow-up by the responsible department.', 'published_at' => now()->subDays(5)],
        ] as $newsItem) {
            NewsItem::query()->updateOrCreate(
                ['slug' => $newsItem['slug']],
                $newsItem + ['is_published' => true],
            );
        }

        foreach ([
            ['title' => 'Planning Floor', 'caption' => 'Weekly planning, metrics review, and operational handoffs.', 'collection' => 'Workplace', 'image_url' => 'https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=900&q=80', 'sort_order' => 1],
            ['title' => 'Catalog Review', 'caption' => 'Product data checks before records are sent to internal apps.', 'collection' => 'Products', 'image_url' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80', 'sort_order' => 2],
            ['title' => 'Service Desk', 'caption' => 'Support requests triaged by department and urgency.', 'collection' => 'Support', 'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=900&q=80', 'sort_order' => 3],
        ] as $galleryItem) {
            GalleryItem::query()->updateOrCreate(
                ['title' => $galleryItem['title']],
                $galleryItem + ['is_published' => true],
            );
        }
    }
}
