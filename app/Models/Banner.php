<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = 'banner';

    protected $fillable = [
        'image',
        'text_az',
        'text_en',
        'text_ru',
        'text_tr',
        'url',
    ];
}



