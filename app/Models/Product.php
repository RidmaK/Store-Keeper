<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded =[];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function product_sub_categories()
    {
        return $this->belongsToMany(SubCategory::class);
    }
    public function images()
    {
    return $this->hasMany(Image::class, 'pro_id', 'pro_id');
    }
}
