<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDeposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'visitor_id',
        'user_id',
        'report_balance',
        'payment_type',
        'status',
        'created_at',
        'updated_at'
    ];


    public function visitor()
    {
        return $this->hasMany(Visitor::class);
    }   

    public function User()
    {
        return $this->belongsTo(User::class);
    }  

    public function Deposit()
    {
        return $this->hasmany(Deposit::class);
    }  
}