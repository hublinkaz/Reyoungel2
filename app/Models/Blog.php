<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'name_tr',
        'desc_az',
        'desc_en',
        'desc_ru',
        'desc_tr',
        'image',
    ];
}
