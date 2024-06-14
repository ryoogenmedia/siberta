<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $table = 'otp';

    protected $fillable = [
        'user_id',
        'code_otp',
        'date_active',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'code_otp' => 'string',
        'date_active' => 'datetime',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}
