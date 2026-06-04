<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    protected $primaryKey = 'id';

    public $timestamps = false; // created_at dipakai sebagai kolom biasa, sesuai migration

    protected $fillable = [
        'from_user_id',
        'to_admin_id',
        'id_program',
        'user_id',
        'aksi',
        'deskripsi',
        'ip_address',
        'created_at',
    ];

    public function adminFrom(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'from_user_id', 'id_admin');
    }

    public function adminTo(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'to_admin_id', 'id_admin');
    }
}


