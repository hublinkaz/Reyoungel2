<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Te7aHoudini\LaravelTrix\Traits\HasTrixRichText;
class Pages extends Model
{
    use HasFactory;
    protected $table = 'pages';

    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'title_tr',

        'body_az',
        'body_en',
        'body_ru',
        'body_tr',

    ];
}
