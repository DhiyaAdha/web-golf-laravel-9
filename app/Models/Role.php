<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use Cachable, HasFactory;

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'phone',
    //     'role_id',
    //     // 'status',
    // ];
    public function user()
    {
        return $this->hasOne(User::class, 'role_id');
    }

}
