<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogTransaction extends Model
{
    use Cachable, HasFactory;

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
        'cart',
        'created_at',
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
