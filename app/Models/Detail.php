<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $table = "detail_transactions";

    
    protected $fillable = [
        'id','log_transaction_id','package_id','quantity' , 'harga'
        
    ];
}
