<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturunProductQuery extends Model
{
    use HasFactory;

    protected $table = 'manager_return';

    protected $fillable = [
    'manager_id',
    'product_id',
    'qty',

    ];
}
