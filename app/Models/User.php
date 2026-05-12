<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username', 'password', 'role', 'kelas'
    ];

    protected $hidden = [
        'password',
    ];

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_user');
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
