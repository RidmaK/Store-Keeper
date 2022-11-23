<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

   protected $table = 'customers';

   protected $fillable = [
    'name',
    'address1',
    'address2',
    'city',
    'phone',
    'type',
    'customer_type',
   ];
}
