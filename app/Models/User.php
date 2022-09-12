<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role_id',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function deposit_history()
    // {
    //     return $this->hasMany(DepositHistory::class);
    // }
    
    public function admin()
    {
        return $this->belongsTo(LogAdmin::class);
    }

    // limit
    public function ReportLimit()
    {
        return $this->belongsTo(ReportLimit::class);
    }  

    //Deposit
    public function ReportDeposit()
    {
        return $this->belongsTo(ReportDeposit::class);
    }  
    
    public function logtransaction()
    {
        return $this->hasMany(LogTransaction::class);
    }  

    public function role()
    {
        return $this->hasOne(Role::class, 'id');
    }
}
