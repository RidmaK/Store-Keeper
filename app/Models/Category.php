<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $table ='categories';
    protected $guarded =[];

    public function sub_categories()
    {
        return $this->belongsToMany(SubCategory::class);
    }
}
