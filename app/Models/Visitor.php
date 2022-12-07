<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $table = 'visitors';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id',
        'unique_qr',
        'name',
        'nik',
        'status_nik',
        'email',
        'address',
        'position',
        'company',
        'phone',
        'handicap',
        'code_member',
        'gender',
        'category',
        'tipe_member',
        'status',
        'expired_date',
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

    public function log_transaction()
    {
        return $this->hasOne(LogTransaction::class, 'visitor_id');
    }
}
