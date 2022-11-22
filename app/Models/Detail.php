<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use Cachable, HasFactory;

    protected $table = 'detail_transactions';

    protected $fillable = [
        'id', 'log_transaction_id', 'package_id', 'quantity', 'harga',

    ];
}
