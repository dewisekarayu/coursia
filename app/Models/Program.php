<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'id_program';
    public $timestamps = false;

    protected $fillable = [
        'nama_program', 'id_instruktur', 'deskripsi', 'level', 'harga', 'durasi'
    ];

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'id_instruktur', 'Id_Instruktur');
    }
}
