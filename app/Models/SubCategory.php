<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table ='sub_categories';
    protected $guarded =[];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
}
