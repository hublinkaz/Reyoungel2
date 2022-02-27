<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagerPayments extends Model
{
    use HasFactory;
    protected $table = 'manager_payments';
    protected $fillable = [
        'order_detail_id',
        'doctor_payment_id',
        'paid',
    ];
}
