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
        'user_id',
        'balance',
        'created_at',
        'updated_at'
    ];

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }   

}
