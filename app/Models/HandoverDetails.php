<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HandoverDetails extends Model
{
    use HasFactory;
    protected $table = 'handover_details';

    protected $fillable = [
        'handovers_id',
        'name_az',
        'name_en',
        'name_ru',
        'name_tr',
        'price',
        'cost',
        'qty',
        'units',
        'detail_az',
        'detail_en',
        'detail_ru',
        'detail_tr',
        'image',
    ];
}



