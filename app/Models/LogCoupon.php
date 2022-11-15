<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogCoupon extends Model
{
    use HasFactory;

    protected $table = 'log_coupons';

    protected $fillable = [
        'visitor_id',
        'report_coupon_id',
        'quota_kupon',
        'created_at',
        'updated_at',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }   

    public function ReportLimit()
    {
        return $this->hasmany(ReportCoupon::class);
    }  
}
