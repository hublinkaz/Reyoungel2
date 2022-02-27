<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftQuery extends Model
{
    use HasFactory;
    protected $table = 'gift_query';
    protected $fillable = [
        'order_id',
        'product_id',
        'user_id',
        'gift_by',
    ];
}
