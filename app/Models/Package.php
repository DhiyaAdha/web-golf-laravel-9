<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use Cachable, HasFactory;
    protected $fillable = [
        'id',
        'name',
        'price_weekdays',
        'price_weekend',
        'category',
        'status',
    ];
}

