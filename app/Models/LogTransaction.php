<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LogTransaction extends Model
{
    use HasFactory;

    protected $table = "log_transactions";

    
    protected $fillable = [
        'id','visitor_id','total','tipe_member', 'created_at'
        
    ];
    
    public function visitor() {
        return $this->belongsTo(Visitor::class);
    }
}
