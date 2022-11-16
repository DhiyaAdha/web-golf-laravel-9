<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportLimit extends Model
{
    use HasFactory;
    protected $table = 'report_limits';

    protected $fillable = [
        'visitor_id',
        'user_id',
        'report_quota',
        // 'fund_limit',
        'status',
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

    public function Limit()
    {
        return $this->hasmany(Limit::class);
    }  

}
