<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Handovers extends Model
{
    use HasFactory;
    protected $table = 'handovers';

    protected $fillable = [
         'manager_id',
         'url',
    ];
}



