<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    use HasFactory;

    protected $table = "order_payments";
    protected $primarykey = "id";

    
    protected $fillable = [
        'unique_number', 'package_default_id', 'package_additional_id', 'price', 'payment_type', 'payment_status', 'created_at', 'updated_at'
        
    ];
}
