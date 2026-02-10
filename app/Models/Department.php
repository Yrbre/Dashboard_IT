<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'code',
    ];

    public function scopeSearch($quary, $search)
    {
        return $quary->when($search, function ($quary, $search) {
            $quary->where('name', 'like', "%{$search}%");
        });
    }
}
