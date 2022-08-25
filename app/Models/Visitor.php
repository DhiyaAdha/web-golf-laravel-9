<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "visitors";
    protected $dates = ['deleted_at'];

    // protected $guarded = [];
    protected $fillable = [
        'id','name', 'email', 'phone', 'gender', 'tipe_member', 'created_at', 'updated_at'
        
    ];
    
    public function logtransaction() {
        return $this->hasMany(LogTransaction::class);
    }
}
