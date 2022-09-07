<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Role extends Model
{
    use HasFactory;

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
