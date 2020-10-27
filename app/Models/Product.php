<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function productCategories() {
        return $this->belongsToMany(
            CategoryProduct::class,
            'categories_products',
            'product_id',
            'category_id');
    }

    public function categories()
    {
        return $this->hasManyThrough(
            Category::class,
            CategoryProduct::class,
            'product_id',
            'id',
            'id',
            'category_id'
        );
    }
}
