<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_az',
        'name_en',
        'name_ru',
        'name_tr',
        'price',
        'cost',
        'qty',
        'units',
        'detail',
        'detail_az',
        'detail_en',
        'detail_ru',
        'detail_tr',
        'image',
        'discount',
        'status',
    ];
}
