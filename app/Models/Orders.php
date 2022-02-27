<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'doctor_id',
        'manager_id',
        'driver_id',
        'create_by',

        'location',
        'is_delivered',

    ];
}
