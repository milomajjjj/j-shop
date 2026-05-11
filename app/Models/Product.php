<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name',
    'description',
    'price',
    'image',
    'category_id',
    'stock',
    'is_active',
    'sale_percent',
    'best_seller'
];

public function category(){
    return $this->belongsTo(Category::class);
}
}
