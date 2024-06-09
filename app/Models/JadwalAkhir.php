<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalAkhir extends Model
{
    use HasFactory;

    protected $table = 'jadwal_akhir';

    protected $fillable = [
        'mahasiswa_id',
        'date',
        'time',
        'note',
    ];

    protected $casts = [
        'mahasiswa_id' => 'integer',
        'date' => 'datetime:Y-m-d',
        'time' => 'datetime:H:i:s',
        'note' => 'string',
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','id')->withDefault();
    }
}
