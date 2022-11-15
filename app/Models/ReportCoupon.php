<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportCoupon extends Model
{
    use HasFactory;

    protected $table = 'report_coupons';

    protected $fillable = [
        'visitor_id',
        'user_id',
        'report_quota_kupon',
        // 'fund_limit',
        'status',
        // 'activities',
        'created_at',
        'updated_at', 
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }   

    public function User()
    {
        return $this->belongsTo(User::class);
    }  

    public function Coupon()
    {
        return $this->hasmany(Coupon::class);
    }  
}
