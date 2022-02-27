<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;
    protected $table = 'invoice_details';

    protected $fillable = [
        'invoice_id',
        'product_id',
        'name',
        'name_az',
        'name_en',
        'name_ru',
        'name_tr',
        'price',
        'discount',
        'qty',
        'units',
        'detail',
        'detail_az',
        'detail_en',
        'detail_ru',
        'detail_tr',
        'image',
    ];
}
