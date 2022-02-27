<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorPayments extends Model
{
    use HasFactory;
    protected $table = 'doctors_payments';
    protected $fillable = [
        'order_detail_id',
        'paid',
        'percentage_value',
    ];
}
