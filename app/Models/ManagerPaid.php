<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerPaid extends Model
{
    use HasFactory;

    protected $table = 'manager_paid';

    protected $fillable = [
        'amount',
        'percent',
        'status',
        'manager_id',
    ];
}
