<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogLimit extends Model
{
    use Cachable, HasFactory;

    protected $table = 'log_limits';

    protected $fillable = [
        'visitor_id',
        'report_limit_id',
        'quota',
        'created_at',
        'updated_at',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }   

    public function ReportLimit()
    {
        return $this->hasmany(ReportLimit::class);
    }  
}
