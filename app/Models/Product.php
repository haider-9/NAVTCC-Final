<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'sku',
        'description',
        'category',
        'price',
        'image_url',
        'is_featured',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'is_featured' => 'boolean',
        ];
    }
}
