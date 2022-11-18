<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogAdmin extends Model
{
    use Cachable, HasFactory;
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
}
