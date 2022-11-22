<?php

namespace App\Models;

use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use Cachable, HasFactory;

    protected $fillable = [
        'id',
        'visitor_id',
        'report_deposit_id',
        'balance',
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

    public function ReportDeposit()
    {
        return $this->hasmany(ReportDeposit::class);
    }
}
