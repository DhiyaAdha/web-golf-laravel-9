<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'price_weekdays',
        'price_weekend',
        'category',
        'status',
    ];
}
