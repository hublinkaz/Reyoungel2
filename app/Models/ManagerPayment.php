<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerPayment extends Model
{
    use HasFactory;


    protected $table = 'manager_payment';
    protected $fillable = [
        'date',
        'manager_name',
        'doctor_paid',
        'manager_paid',
        'manager_id',
        'order_id',
    ];
}
