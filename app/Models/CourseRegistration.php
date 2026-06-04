<?php

namespace App\Models;

use App\Models\Pembayaran;


use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CourseRegistration extends Model
{
    protected $table = 'course_registrations';

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'program',
        'jadwal',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'course_registration_id');
    }
}


