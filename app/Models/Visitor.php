<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';
    protected $dates = ['deleted_at'];

    // protected $guarded = [];
    protected $fillable = [
        'id',
        'unique_qr',
        'name',
        'email',
        'address',
        'position',
        'company',
        'phone',
        'gender',
        'category',
        'tipe_member',
        'created_at',
        'updated_at',
    ];

    public function logtransaction()
    {
        return $this->hasMany(LogTransaction::class);
    }
    
    // deposit
    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }
    
    public function repordtdeposit()
    {
        return $this->hasMany(ReportDeposit::class);
    }
    
    // limit
    public function loglimit()
    {
        return $this->hasMany(LogLimit::class);
    }
    public function ReportLimit()
    {
        return $this->hasMany(ReportLimit::class);
    }  
    
    public function transaction($visitorId)
    {
        return LogTransaction::where('visitor_id', $visitorId)
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function orders()
    {
        return $this->hasMany(LogTransaction::class);
    }
    
}
