<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user',
        'priority',
        'category',
        'assign_to',
        'project_id',
        'status',
        'delivered',
        'department_id',
        'in_timeline',
        'start_task',
        'end_task',
        'problem',
        'analyst',
        'solution',
    ];

    public function scopeSearch($quary, $search)
    {
        return $quary->when($search, function ($quary, $search) {
            $quary->where('name', 'like', "%{$search}%");
        });
    }
}
