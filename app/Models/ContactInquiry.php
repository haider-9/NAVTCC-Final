<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'full_name',
        'email',
        'department',
        'message',
        'status',
    ];
}
