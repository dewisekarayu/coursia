<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    protected $table = 'instruktur';
    protected $primaryKey = 'Id_Instruktur';
    public $timestamps = false;

    protected $fillable = [
        'Nama_Instruktur', 'Pengalaman', 'Level_Kelas'
    ];
}
