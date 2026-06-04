<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    protected $table = "produks";
    protected $fillable = [
        "nama",
        "deskripsi"
    ];
}
