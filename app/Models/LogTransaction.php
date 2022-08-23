<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LogTransaction extends Model
{
    use HasFactory;

    protected $table = "log_transactions";
    protected $primarykey = "id";

    
    protected $fillable = [
        'visitor_id', 'user_id', 'payment_type', 'payment_status', 'total', 'status', 'created_at'
        
    ];
}
