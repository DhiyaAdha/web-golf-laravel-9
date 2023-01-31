<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogTransaction extends Model
{
    use HasFactory;

    protected $table = 'log_transactions';

    protected $fillable = [
        'id',
        'order_number',
        'visitor_id',
        'user_id',
        'payment_type',
        'payment_status',
        'total',
        'total_gross',
        'jml_default',
        'jml_additional',
        'jml_other',
        'jml_rental',
        'jml_service',
        'cart',
        'created_at',
        'updated_at',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
