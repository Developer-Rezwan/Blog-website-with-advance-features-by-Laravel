<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'slug', 'status'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}