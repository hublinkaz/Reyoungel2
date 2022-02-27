<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorsImages extends Model
{
    use HasFactory;
    protected $table = 'doctors_images';
    protected $fillable = [
        'url',
        'front_doctors_id',

    ];
}