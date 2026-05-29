<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
       'name', 'username', 'email', 'password', 'kelas', 'role', 'last_login', 'last_login_ip'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'last_login' => 'datetime',
    ];

    // Relasi ke login histories
    public function loginHistories()
    {
        return $this->hasMany(LoginHistory::class)->orderBy('login_at', 'desc');
    }
}