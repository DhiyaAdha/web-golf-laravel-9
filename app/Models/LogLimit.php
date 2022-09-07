<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogLimit extends Model
{
    use HasFactory;

    protected $table = 'log_limits';

    protected $fillable = [
        'visitor_id',
        // 'user_id',`
        'report_limit_id',
        'quota',
        'quota_kupon',
        'status',
        'created_at',
        'updated_at',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }   

    // public function User()
    // {
    //     return $this->belongsTo(User::class);
    // }  

    public function ReportLimit()
    {
        return $this->hasmany(ReportLimit::class);
    }  

    // public $timestamps = false;
    

}
