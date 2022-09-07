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
        'type',
        'activities',
        'quota',
        'created_at',
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public $timestamps = false;
    

}
