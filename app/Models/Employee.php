<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * @var list<string>
     */
    protected $fillable = [
        'employee_code',
        'full_name',
        'department',
        'job_title',
        'email',
        'work_status',
    ];
}
