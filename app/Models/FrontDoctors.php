<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontDoctors extends Model
{
    use HasFactory;
    protected $table = 'front_doctors';
    protected $fillable = [
        'name',
        'phone',
        'text',
        'location',
        'workplace',
        'images',
        'video_url',

    ];
}
