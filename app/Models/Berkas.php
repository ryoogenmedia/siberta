<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';

    protected $fillable = [
        'mahasiswa_id',
        'type_document',
        'name_file',
        'file',
        'status_file',
        'date_upload',
        'time_upload',
        'note_mahasiswa',
        'category',
        'code_document',
        'exam_letter',
    ];

    protected $casts = [
        'mahasiswa_id' => 'integer',
        'type_document' => 'string',
        'name_file' => 'string',
        'file' => 'string',
        'status_file' => 'string',
        'date_upload' => 'datetime:Y-m-d',
        'time_upload' => 'datetime:H:i:s',
        'note_mahasiswa' => 'string',
        'category' => 'string',
        'code_document' => 'string',
        'exam_letter' => 'string',
    ];

    public function revision(){
        return $this->hasOne(Revision::class,'berkas_id','id')->withDefault();
    }

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id','id')->withDefault();
    }
}
