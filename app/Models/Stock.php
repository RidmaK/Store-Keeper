<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded =[];
    protected $table = 'stock';
    public function category()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }

}
