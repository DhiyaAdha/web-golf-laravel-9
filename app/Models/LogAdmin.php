<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogAdmin extends Model
{
    use HasFactory;
    protected $table = 'log_admins';

    protected $fillable = [
        'user_id',
        'type',
        'activities'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public $timestamps = false;
}
