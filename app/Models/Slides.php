<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'text_az',
        'text_en',
        'text_ru',
        'text_tr',
        'button_text_az',
        'button_text_en',
        'button_text_ru',
        'button_text_tr',
        'button_link',
    ];
}
