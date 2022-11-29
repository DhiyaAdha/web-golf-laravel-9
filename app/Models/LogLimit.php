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
