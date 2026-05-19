<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
    'name',
    'username', // Pastikan ini ada
    'kelas',
    'email',    // Pastikan ini juga ada!
    'password',
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
