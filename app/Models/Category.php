<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function categoryProducts() {
        return $this->belongsToMany(
            CategoryProduct::class,
            'categories_products',
            'category_id',
            'product_id');
    }

    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
        CategoryProduct::class,
            'category_id',
            'id',
            'id',
            'product_id'
        );
    }
}
