<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'slug',
        'category',
        'summary',
        'published_at',
        'is_published',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'is_published' => 'boolean',
        ];
    }
}
