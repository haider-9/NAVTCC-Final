<?php

namespace Tests\Feature;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_lists_products_as_json(): void
    {
        Product::create([
            'name' => 'Business Pro Laptop',
            'sku' => 'BP-LAPTOP-001',
            'description' => 'A lightweight laptop for office work.',
            'category' => 'Hardware',
            'price' => 1299.00,
            'is_featured' => true,
        ]);

        $response = $this->getJson('/api/products');

        $response
            ->assertOk()
            ->assertJsonPath('meta.count', 1)
            ->assertJsonPath('data.0.name', 'Business Pro Laptop')
            ->assertJsonPath('data.0.sku', 'BP-LAPTOP-001');
    }

    public function test_it_shows_a_single_product(): void
    {
        $product = Product::create([
            'name' => 'Meeting Hub Camera',
            'sku' => 'MEET-HUB-002',
            'category' => 'Media',
            'price' => 249.99,
        ]);

        $response = $this->getJson("/api/products/{$product->id}");

        $response
            ->assertOk()
            ->assertJsonPath('data.name', 'Meeting Hub Camera')
            ->assertJsonPath('data.sku', 'MEET-HUB-002');
    }

    public function test_it_creates_a_product(): void
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Smart Access Badge',
            'sku' => 'SEC-BADGE-003',
            'description' => 'Employee access badge.',
            'category' => 'Security',
            'price' => 19.50,
            'is_featured' => false,
        ]);

        $response
            ->assertCreated()
            ->assertJsonPath('message', 'Product created successfully.')
            ->assertJsonPath('data.name', 'Smart Access Badge');

        $this->assertDatabaseHas('products', [
            'sku' => 'SEC-BADGE-003',
            'name' => 'Smart Access Badge',
        ]);
    }

    public function test_it_updates_a_product(): void
    {
        $product = Product::create([
            'name' => 'Old Product Name',
            'sku' => 'OLD-001',
            'category' => 'Hardware',
            'price' => 10.00,
        ]);

        $response = $this->putJson("/api/products/{$product->id}", [
            'name' => 'Updated Product Name',
            'sku' => 'OLD-001',
            'category' => 'Hardware',
            'price' => 15.75,
            'is_featured' => true,
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('message', 'Product updated successfully.')
            ->assertJsonPath('data.name', 'Updated Product Name')
            ->assertJsonPath('data.is_featured', true);

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Name',
        ]);
    }

    public function test_it_deletes_a_product(): void
    {
        $product = Product::create([
            'name' => 'Temporary Product',
            'sku' => 'TEMP-001',
            'price' => 5.00,
        ]);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response
            ->assertOk()
            ->assertJsonPath('message', 'Product deleted successfully.');

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }
}
