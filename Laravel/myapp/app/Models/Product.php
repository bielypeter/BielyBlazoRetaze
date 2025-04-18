<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image_path',
        'color',
        'brand',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'products_category');
    }
}
