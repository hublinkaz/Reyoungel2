<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gifts extends Model
{
    use HasFactory;
    protected $table = 'gifts';
    protected $fillable = [
        'order_id',
        'product_id',
        'user_id',
    ];
}
