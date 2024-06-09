<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory;

    protected $table = 'revision';

    protected $fillable = [
        'berkas_id',
        'mahasiswa_id',
        'user_id',
        'date_revision',
        'gathering_limit_date',
        'note_revision',
        'provider_name',
    ];

    protected $casts = [
        'berkas_id' => 'integer',
        'mahasiswa_id' => 'integer',
        'user_id' => 'integer',
        'date_revision' => 'datetime:Y-m-d H:i:s',
        'gathering_limit_date' => 'datetime:Y-m-d H:i:s',
        'note_revision' => 'string',
        'provider_name' => 'string',
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id','id')->withDefault();
    }

    public function berkas(){
        return $this->belongsTo(Berkas::class,'berkas_id','id')->withDefault();
    }

    public function provider(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}
