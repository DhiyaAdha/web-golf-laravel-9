<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'visitor_id',
        'report_deposit_id',
        'balance',
        'activities',
        'created_at',
        'updated_at'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }   

    public function User()
    {
        return $this->belongsTo(User::class);
    }  

    public function ReportDeposit()
    {
        return $this->hasmany(ReportDeposit::class);
    }  

    
}
