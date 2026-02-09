<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Projects extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'responsibility_id',
        'client',
        'progress',
        'status',
        'schedule_start',
        'schedule_end',
        'actual_start',
        'actual_end',
        'description',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        });
    }
}
