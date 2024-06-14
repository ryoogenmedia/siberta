<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'name',
        'nim',
        'program_studi',
        'email',
        'phone',
        'address',
        'entry_year',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'nim' => 'string',
        'program_studi' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'address' => 'string',
        'entry_year' => 'string',
    ];

    public function akun(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }

    public function berkas(){
        return $this->hasMany(Berkas::class,'mahasiswa_id','id');
    }
}
