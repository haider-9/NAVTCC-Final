<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'caption',
        'collection',
        'image_url',
        'sort_order',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_published' => 'boolean',
        ];
    }
}
