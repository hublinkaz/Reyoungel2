<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseQuery extends Model
{
    use HasFactory;
    protected $table = 'warehouse_query';
    protected $fillable = [
        'manager_id',
        'product_id',
        'qty'
    ];
}
